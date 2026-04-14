<?php
require_once __DIR__ . '/../../../controllers/ProduitController.php';

$controller = new ProduitController();
$errors = [];
$values = [
    'nom' => '',
    'prix' => '',
    'description' => '',
    'stock' => '0',
    'categorie' => '',
    'image_url' => null,
];

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $values['nom'] = trim($_POST['nom'] ?? '');
    $values['prix'] = $_POST['prix'] ?? '';
    $values['description'] = trim($_POST['description'] ?? '');
    $values['stock'] = $_POST['stock'] ?? '';
    $values['categorie'] = $_POST['categorie'] ?? '';

    if($controller->validateData($values, $errors)) {
        $upload = $controller->saveImage($_FILES['image'] ?? []);
        if($upload === false) {
            $errors['image'] = 'Format de fichier non pris en charge. Utilisez JPG, PNG ou WEBP.';
        } else {
            $values['image_url'] = $upload;
        }
    }

    if(empty($errors)) {
        $produit = new Produit(
            $values['nom'],
            floatval($values['prix']),
            $values['description'],
            intval($values['stock']),
            $values['categorie'],
            $values['image_url']
        );

        if($controller->add($produit)) {
            header('Location: liste.php?success=1');
            exit();
        }

        $errors['general'] = 'Une erreur est survenue lors de l’ajout du produit.';
    }
}

$title = "Ajouter un produit - Stabilis™";
require_once __DIR__ . '/../../partials/header.php';
?>

<div class="form-card" style="max-width: 700px; margin: 0 auto;">
    <div style="padding: 24px; border-bottom: 1px solid var(--border-light);">
        <h3 style="margin: 0;">Nouveau produit</h3>
        <p class="text-muted" style="margin-top: 8px;">Ajoutez un produit à votre catalogue.</p>
    </div>
    
    <div style="padding: 32px;">
        <?php if(!empty($errors['general'])): ?>
            <div class="alert"><?php echo $errors['general']; ?></div>
        <?php endif; ?>

        <form method="POST" id="productForm" enctype="multipart/form-data" novalidate>
            <div class="form-group">
                <label for="nom">Nom du produit</label>
                <input type="text" name="nom" id="nom" class="form-control" placeholder="Whey Protein Isolat" value="<?php echo htmlspecialchars($values['nom']); ?>">
                <div id="nomError" class="error-message"><?php echo $errors['nom'] ?? ''; ?></div>
            </div>
            
            <div class="form-group">
                <label for="prix">Prix (€)</label>
                <input type="number" step="0.01" name="prix" id="prix" class="form-control" placeholder="49.99" value="<?php echo htmlspecialchars($values['prix']); ?>">
                <div id="prixError" class="error-message"><?php echo $errors['prix'] ?? ''; ?></div>
            </div>
            
            <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description" id="description" class="form-control" rows="3" placeholder="Description du produit..."><?php echo htmlspecialchars($values['description']); ?></textarea>
                <div class="hint">Décrivez les bénéfices du produit.</div>
                <div class="error-message"><?php echo $errors['description'] ?? ''; ?></div>
            </div>
            
            <div class="form-group">
                <label for="stock">Stock</label>
                <input type="number" name="stock" id="stock" class="form-control" value="<?php echo htmlspecialchars($values['stock']); ?>">
                <div id="stockError" class="error-message"><?php echo $errors['stock'] ?? ''; ?></div>
            </div>
            
            <div class="form-group">
                <label for="categorie">Catégorie</label>
                <select name="categorie" id="categorie" class="form-control">
                    <option value="">Sélectionner</option>
                    <option value="Protéines" <?php echo $values['categorie'] === 'Protéines' ? 'selected' : ''; ?>>Protéines</option>
                    <option value="Acides Aminés" <?php echo $values['categorie'] === 'Acides Aminés' ? 'selected' : ''; ?>>Acides Aminés</option>
                    <option value="Pré-workout" <?php echo $values['categorie'] === 'Pré-workout' ? 'selected' : ''; ?>>Pré-workout</option>
                    <option value="Vitamines" <?php echo $values['categorie'] === 'Vitamines' ? 'selected' : ''; ?>>Vitamines</option>
                    <option value="Snacks" <?php echo $values['categorie'] === 'Snacks' ? 'selected' : ''; ?>>Snacks</option>
                    <option value="Accessoires" <?php echo $values['categorie'] === 'Accessoires' ? 'selected' : ''; ?>>Accessoires</option>
                </select>
                <div id="categorieError" class="error-message"><?php echo $errors['categorie'] ?? ''; ?></div>
            </div>
            
            <div class="form-group">
                <label for="image">Image du produit</label>
                <input type="file" accept="image/png,image/jpeg,image/webp" name="image" id="image" class="form-control">
                <div class="hint">Choisissez une image au format JPG, PNG ou WEBP. Le système se charge du stockage.</div>
                <div class="error-message"><?php echo $errors['image'] ?? ''; ?></div>
            </div>
            
            <div style="display: flex; gap: 12px; margin-top: 32px;">
                <button type="submit" id="submitBtn" class="btn-primary">
                    <span id="btnText">Ajouter le produit</span>
                </button>
                <a href="liste.php" class="btn-secondary">
                    Annuler
                </a>
            </div>
        </form>
    </div>
</div>

<script>
document.getElementById('productForm').addEventListener('submit', function(e) {
    let isValid = true;
    
    const nom = document.getElementById('nom').value.trim();
    const nomError = document.getElementById('nomError');
    if(nom.length < 3) {
        nomError.textContent = 'Le nom doit contenir au moins 3 caractères';
        document.getElementById('nom').classList.add('input-error');
        isValid = false;
    } else {
        nomError.textContent = '';
        document.getElementById('nom').classList.remove('input-error');
    }
    
    const prix = parseFloat(document.getElementById('prix').value);
    const prixError = document.getElementById('prixError');
    if(isNaN(prix) || prix <= 0) {
        prixError.textContent = 'Le prix doit être positif';
        document.getElementById('prix').classList.add('input-error');
        isValid = false;
    } else {
        prixError.textContent = '';
        document.getElementById('prix').classList.remove('input-error');
    }
    
    const stock = parseInt(document.getElementById('stock').value, 10);
    const stockError = document.getElementById('stockError');
    if(isNaN(stock) || stock < 0) {
        stockError.textContent = 'Le stock doit être un entier positif ou zéro';
        document.getElementById('stock').classList.add('input-error');
        isValid = false;
    } else {
        stockError.textContent = '';
        document.getElementById('stock').classList.remove('input-error');
    }
    
    const categorie = document.getElementById('categorie').value;
    const categorieError = document.getElementById('categorieError');
    if(categorie === '') {
        categorieError.textContent = 'Sélectionnez une catégorie';
        document.getElementById('categorie').classList.add('input-error');
        isValid = false;
    } else {
        categorieError.textContent = '';
        document.getElementById('categorie').classList.remove('input-error');
    }
    
    if(isValid) {
        // Show loading state
        const btn = document.getElementById('submitBtn');
        const btnText = document.getElementById('btnText');
        btn.disabled = true;
        btnText.innerHTML = '<span class="loading-spinner-custom"></span> Chargement...';
    } else {
        e.preventDefault();
    }
});
</script>

<?php require_once __DIR__ . '/../../partials/footer.php'; ?>