<?php
// NO HTML5 validation attributes (required/min/max/minlength) — validation done server-side in PHP
$niveaux = ['debutant' => 'Débutant', 'intermediaire' => 'Intermédiaire', 'avance' => 'Avancé'];
$sports  = ['Course à pied','Musculation','Yoga','HIIT','Cyclisme','Natation','Football','Basketball','Tennis','Boxe','Pilates','Autre'];
?>

<div class="form-group">
    <label for="nom">Nom de l'entraînement <span class="text-danger">*</span></label>
    <input type="text" name="nom" id="nom"
           class="form-control <?= isset($errors['nom']) ? 'field-error' : '' ?>"
           value="<?= htmlspecialchars($entrainement['nom'] ?? '') ?>"
           placeholder="Ex: Course matinale">
    <?php if (isset($errors['nom'])): ?>
        <span class="error-msg"><?= htmlspecialchars($errors['nom']) ?></span>
    <?php endif; ?>
</div>

<div class="form-group">
    <label for="description">Description</label>
    <textarea name="description" id="description" rows="3" class="form-control"
              placeholder="Décrivez votre séance..."><?= htmlspecialchars($entrainement['description'] ?? '') ?></textarea>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="type_sport">Type de sport <span class="text-danger">*</span></label>
            <select name="type_sport" id="type_sport"
                    class="form-control <?= isset($errors['type_sport']) ? 'field-error' : '' ?>">
                <option value="">-- Sélectionner --</option>
                <?php foreach ($sports as $s): ?>
                    <option value="<?= htmlspecialchars($s) ?>"
                        <?= ($entrainement['type_sport'] ?? '') === $s ? 'selected' : '' ?>>
                        <?= htmlspecialchars($s) ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <?php if (isset($errors['type_sport'])): ?>
                <span class="error-msg"><?= htmlspecialchars($errors['type_sport']) ?></span>
            <?php endif; ?>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="duree">Durée (minutes) <span class="text-danger">*</span></label>
            <input type="number" name="duree" id="duree"
                   class="form-control <?= isset($errors['duree']) ? 'field-error' : '' ?>"
                   value="<?= htmlspecialchars($entrainement['duree'] ?? '') ?>"
                   placeholder="Ex: 45">
            <?php if (isset($errors['duree'])): ?>
                <span class="error-msg"><?= htmlspecialchars($errors['duree']) ?></span>
            <?php endif; ?>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="niveau">Niveau <span class="text-danger">*</span></label>
            <select name="niveau" id="niveau"
                    class="form-control <?= isset($errors['niveau']) ? 'field-error' : '' ?>">
                <option value="">-- Sélectionner --</option>
                <?php foreach ($niveaux as $val => $label): ?>
                    <option value="<?= $val ?>" <?= ($entrainement['niveau'] ?? '') === $val ? 'selected' : '' ?>>
                        <?= $label ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <?php if (isset($errors['niveau'])): ?>
                <span class="error-msg"><?= htmlspecialchars($errors['niveau']) ?></span>
            <?php endif; ?>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="date_entrainement">Date de l'entraînement <span class="text-danger">*</span></label>
            <input type="date" name="date_entrainement" id="date_entrainement"
                   class="form-control <?= isset($errors['date_entrainement']) ? 'field-error' : '' ?>"
                   value="<?= htmlspecialchars($entrainement['date_entrainement'] ?? date('Y-m-d')) ?>">
            <?php if (isset($errors['date_entrainement'])): ?>
                <span class="error-msg"><?= htmlspecialchars($errors['date_entrainement']) ?></span>
            <?php endif; ?>
        </div>
    </div>
</div>
