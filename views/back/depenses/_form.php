<?php
// NO HTML5 validation attributes — all validation done server-side in PHP controller
$intensites = ['faible' => 'Faible', 'moderee' => 'Modérée', 'elevee' => 'Élevée', 'maximale' => 'Maximale'];
?>

<div class="form-group">
    <label for="entrainement_id">Entraînement associé <span class="text-danger">*</span></label>
    <select name="entrainement_id" id="entrainement_id"
            class="form-control <?= isset($errors['entrainement_id']) ? 'field-error' : '' ?>">
        <option value="">-- Sélectionner un entraînement --</option>
        <?php foreach ($entrainements as $e): ?>
            <option value="<?= $e['id'] ?>"
                <?= (string)($depense['entrainement_id'] ?? '') === (string)$e['id'] ? 'selected' : '' ?>>
                <?= htmlspecialchars($e['nom']) ?> – <?= date('d/m/Y', strtotime($e['date_entrainement'])) ?>
            </option>
        <?php endforeach; ?>
    </select>
    <?php if (isset($errors['entrainement_id'])): ?>
        <span class="error-msg"><?= htmlspecialchars($errors['entrainement_id']) ?></span>
    <?php endif; ?>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="calories_brulees">Calories brûlées (kcal) <span class="text-danger">*</span></label>
            <input type="number" name="calories_brulees" id="calories_brulees"
                   class="form-control <?= isset($errors['calories_brulees']) ? 'field-error' : '' ?>"
                   value="<?= htmlspecialchars($depense['calories_brulees'] ?? '') ?>"
                   placeholder="Ex: 350">
            <?php if (isset($errors['calories_brulees'])): ?>
                <span class="error-msg"><?= htmlspecialchars($errors['calories_brulees']) ?></span>
            <?php endif; ?>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="frequence_cardiaque_moy">Fréquence cardiaque moyenne (bpm)</label>
            <input type="number" name="frequence_cardiaque_moy" id="frequence_cardiaque_moy"
                   class="form-control <?= isset($errors['frequence_cardiaque_moy']) ? 'field-error' : '' ?>"
                   value="<?= htmlspecialchars($depense['frequence_cardiaque_moy'] ?? '') ?>"
                   placeholder="Ex: 145">
            <small class="form-text text-muted">Entre 40 et 250 bpm. Optionnel.</small>
            <?php if (isset($errors['frequence_cardiaque_moy'])): ?>
                <span class="error-msg"><?= htmlspecialchars($errors['frequence_cardiaque_moy']) ?></span>
            <?php endif; ?>
        </div>
    </div>
</div>

<div class="form-group">
    <label for="intensite">Intensité <span class="text-danger">*</span></label>
    <select name="intensite" id="intensite"
            class="form-control <?= isset($errors['intensite']) ? 'field-error' : '' ?>">
        <option value="">-- Sélectionner --</option>
        <?php foreach ($intensites as $val => $label): ?>
            <option value="<?= $val ?>" <?= ($depense['intensite'] ?? '') === $val ? 'selected' : '' ?>>
                <?= $label ?>
            </option>
        <?php endforeach; ?>
    </select>
    <?php if (isset($errors['intensite'])): ?>
        <span class="error-msg"><?= htmlspecialchars($errors['intensite']) ?></span>
    <?php endif; ?>
</div>

<div class="form-group">
    <label for="remarques">Remarques</label>
    <textarea name="remarques" id="remarques" rows="3" class="form-control"
              placeholder="Notes sur la séance..."><?= htmlspecialchars($depense['remarques'] ?? '') ?></textarea>
</div>
