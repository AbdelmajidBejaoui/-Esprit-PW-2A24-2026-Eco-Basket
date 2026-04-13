<?php
// NO HTML5 required/min/max/minlength — validation is 100% PHP server-side
$sports  = ['Course à pied','Musculation','Yoga','HIIT','Cyclisme','Natation','Football','Basketball','Tennis','Boxe','Pilates','Autre'];
$niveaux = ['debutant'=>'Débutant','intermediaire'=>'Intermédiaire','avance'=>'Avancé'];
?>

<?php if (!empty($errors)): ?>
<div class="alert alert-danger">
    <i class="fas fa-exclamation-triangle mr-2"></i>
    <strong>Veuillez corriger les erreurs suivantes :</strong>
    <ul class="mb-0 mt-1">
        <?php foreach ($errors as $err): ?>
            <li><?= htmlspecialchars($err) ?></li>
        <?php endforeach; ?>
    </ul>
</div>
<?php endif; ?>

<div class="form-group">
    <label style="font-weight:600; color:#333;">Nom de l'entraînement <span class="text-danger">*</span></label>
    <input type="text" name="nom"
           class="form-control <?= isset($errors['nom']) ? 'is-invalid' : '' ?>"
           value="<?= htmlspecialchars($data['nom'] ?? $entrainement['nom'] ?? '') ?>"
           placeholder="Ex: Course matinale"
           style="border-radius:8px; height:48px;">
    <?php if (isset($errors['nom'])): ?><div class="text-danger small mt-1"><?= htmlspecialchars($errors['nom']) ?></div><?php endif; ?>
</div>

<div class="form-group">
    <label style="font-weight:600; color:#333;">Description</label>
    <textarea name="description" rows="3" class="form-control"
              placeholder="Décrivez votre séance..."
              style="border-radius:8px;"><?= htmlspecialchars($data['description'] ?? $entrainement['description'] ?? '') ?></textarea>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label style="font-weight:600; color:#333;">Type de sport <span class="text-danger">*</span></label>
            <select name="type_sport" class="form-control <?= isset($errors['type_sport']) ? 'is-invalid' : '' ?>"
                    style="border-radius:8px; height:48px;">
                <option value="">-- Sélectionner --</option>
                <?php foreach ($sports as $s):
                    $val = $data['type_sport'] ?? $entrainement['type_sport'] ?? '';
                ?>
                    <option value="<?= htmlspecialchars($s) ?>" <?= $val === $s ? 'selected' : '' ?>>
                        <?= htmlspecialchars($s) ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <?php if (isset($errors['type_sport'])): ?><div class="text-danger small mt-1"><?= htmlspecialchars($errors['type_sport']) ?></div><?php endif; ?>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label style="font-weight:600; color:#333;">Durée (minutes) <span class="text-danger">*</span></label>
            <input type="number" name="duree"
                   class="form-control <?= isset($errors['duree']) ? 'is-invalid' : '' ?>"
                   value="<?= htmlspecialchars($data['duree'] ?? $entrainement['duree'] ?? '') ?>"
                   placeholder="Ex: 45"
                   style="border-radius:8px; height:48px;">
            <?php if (isset($errors['duree'])): ?><div class="text-danger small mt-1"><?= htmlspecialchars($errors['duree']) ?></div><?php endif; ?>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label style="font-weight:600; color:#333;">Niveau <span class="text-danger">*</span></label>
            <select name="niveau" class="form-control <?= isset($errors['niveau']) ? 'is-invalid' : '' ?>"
                    style="border-radius:8px; height:48px;">
                <option value="">-- Sélectionner --</option>
                <?php foreach ($niveaux as $val => $label):
                    $cur = $data['niveau'] ?? $entrainement['niveau'] ?? '';
                ?>
                    <option value="<?= $val ?>" <?= $cur === $val ? 'selected' : '' ?>><?= $label ?></option>
                <?php endforeach; ?>
            </select>
            <?php if (isset($errors['niveau'])): ?><div class="text-danger small mt-1"><?= htmlspecialchars($errors['niveau']) ?></div><?php endif; ?>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label style="font-weight:600; color:#333;">Date <span class="text-danger">*</span></label>
            <input type="date" name="date_entrainement"
                   class="form-control <?= isset($errors['date_entrainement']) ? 'is-invalid' : '' ?>"
                   value="<?= htmlspecialchars($data['date_entrainement'] ?? $entrainement['date_entrainement'] ?? date('Y-m-d')) ?>"
                   style="border-radius:8px; height:48px;">
            <?php if (isset($errors['date_entrainement'])): ?><div class="text-danger small mt-1"><?= htmlspecialchars($errors['date_entrainement']) ?></div><?php endif; ?>
        </div>
    </div>
</div>
