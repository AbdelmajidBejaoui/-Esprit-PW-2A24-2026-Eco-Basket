<?php $pageTitle = htmlspecialchars($entrainement['nom']) . ' – FitTrack'; $controller = 'front_entrainement'; ?>
<?php require __DIR__ . '/../../layouts/front_header.php'; ?>

<?php
$sportImages = ['Course à pied'=>'image_1.jpg','Musculation'=>'bg_3.jpg','HIIT'=>'bg_1.jpg',
                'Yoga'=>'about.jpg','Cyclisme'=>'image_2.jpg','Natation'=>'image_3.jpg',
                'Football'=>'image_4.jpg','Basketball'=>'image_5.jpg','Tennis'=>'image_6.jpg',
                'Boxe'=>'bg_2.jpg','Pilates'=>'category-1.jpg','Autre'=>'category-2.jpg'];
$img = $sportImages[$entrainement['type_sport']] ?? 'bg_1.jpg';
$niveauColors = ['debutant'=>['bg'=>'#28a745','txt'=>'#fff'],
                 'intermediaire'=>['bg'=>'#ffc107','txt'=>'#000'],
                 'avance'=>['bg'=>'#dc3545','txt'=>'#fff']];
$nc = $niveauColors[$entrainement['niveau']] ?? ['bg'=>'#6c757d','txt'=>'#fff'];
$intensiteColors = ['faible'=>['bg'=>'#17a2b8','txt'=>'#fff'],'moderee'=>['bg'=>'#28a745','txt'=>'#fff'],
                    'elevee'=>['bg'=>'#ffc107','txt'=>'#000'],'maximale'=>['bg'=>'#dc3545','txt'=>'#fff']];
?>

<!-- HERO -->
<section class="hero-wrap hero-wrap-2" style="background-image: url('<?= ASSETS_FRONT ?>/images/<?= $img ?>');" data-stellar-background-ratio="0.5">
    <div class="overlay"></div>
    <div class="container">
        <div class="row no-gutters slider-text align-items-end justify-content-center">
            <div class="col-md-9 pb-5 text-center">
                <p class="breadcrumbs">
                    <span class="mr-2"><a href="<?= BASE_PATH ?>/index.php?controller=front_entrainement">Entraînements</a></span>
                    <span><?= htmlspecialchars($entrainement['nom']) ?></span>
                </p>
                <h1 class="mb-3 bread"><?= htmlspecialchars($entrainement['nom']) ?></h1>
            </div>
        </div>
    </div>
</section>

<!-- FLASH -->
<?php if (!empty($_SESSION['flash'])): ?>
<div class="container mt-3">
    <div class="alert alert-<?= $_SESSION['flash']['type'] === 'success' ? 'success' : 'warning' ?> alert-dismissible">
        <?= htmlspecialchars($_SESSION['flash']['msg']) ?>
        <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
    </div>
</div>
<?php unset($_SESSION['flash']); endif; ?>

<section class="ftco-section">
    <div class="container">
        <div class="row">

            <!-- FICHE ENTRAÎNEMENT -->
            <div class="col-lg-4 mb-5">
                <div style="border-radius:16px; overflow:hidden; box-shadow:0 8px 30px rgba(0,0,0,.1);">
                    <!-- Header -->
                    <div style="background:linear-gradient(135deg,#82ae46,#4a7c20); color:white; padding:24px;">
                        <span style="background:<?= $nc['bg'] ?>; color:<?= $nc['txt'] ?>; padding:3px 12px; border-radius:20px; font-size:.8rem; font-weight:600;">
                            <?= ucfirst($entrainement['niveau']) ?>
                        </span>
                        <h4 class="mt-2 mb-0" style="font-size:1.3rem;"><?= htmlspecialchars($entrainement['nom']) ?></h4>
                    </div>
                    <!-- Infos -->
                    <div style="background:#fff; padding:24px;">
                        <div class="d-flex align-items-center mb-3">
                            <div style="width:40px; height:40px; background:#f0f8e8; border-radius:50%; display:flex; align-items:center; justify-content:center; margin-right:14px;">
                                <i class="fas fa-dumbbell" style="color:#82ae46;"></i>
                            </div>
                            <div><small class="text-muted d-block">Type de sport</small><strong><?= htmlspecialchars($entrainement['type_sport']) ?></strong></div>
                        </div>
                        <div class="d-flex align-items-center mb-3">
                            <div style="width:40px; height:40px; background:#f0f8e8; border-radius:50%; display:flex; align-items:center; justify-content:center; margin-right:14px;">
                                <i class="fas fa-clock" style="color:#82ae46;"></i>
                            </div>
                            <div><small class="text-muted d-block">Durée</small><strong><?= $entrainement['duree'] ?> minutes</strong></div>
                        </div>
                        <div class="d-flex align-items-center mb-3">
                            <div style="width:40px; height:40px; background:#f0f8e8; border-radius:50%; display:flex; align-items:center; justify-content:center; margin-right:14px;">
                                <i class="fas fa-calendar-alt" style="color:#82ae46;"></i>
                            </div>
                            <div><small class="text-muted d-block">Date</small><strong><?= date('d/m/Y', strtotime($entrainement['date_entrainement'])) ?></strong></div>
                        </div>
                        <?php if ($entrainement['description']): ?>
                        <hr>
                        <p class="text-muted" style="font-size:.9rem;"><?= nl2br(htmlspecialchars($entrainement['description'])) ?></p>
                        <?php endif; ?>
                    </div>
                    <!-- Actions CRUD -->
                    <div style="background:#f9f9f9; padding:16px 24px; border-top:1px solid #eee;">
                        <div class="row" style="gap:0;">
                            <div class="col-6 pr-1">
                                <a href="<?= BASE_PATH ?>/index.php?controller=front_entrainement&action=edit&id=<?= $entrainement['id'] ?>"
                                   class="btn btn-warning btn-block" style="border-radius:20px; font-size:.85rem;">
                                    <i class="fas fa-edit mr-1"></i>Modifier
                                </a>
                            </div>
                            <div class="col-6 pl-1">
                                <a href="<?= BASE_PATH ?>/index.php?controller=front_entrainement&action=delete&id=<?= $entrainement['id'] ?>"
                                   class="btn btn-danger btn-block" style="border-radius:20px; font-size:.85rem;"
                                   onclick="return confirm('Supprimer cet entraînement ?')">
                                    <i class="fas fa-trash mr-1"></i>Supprimer
                                </a>
                            </div>
                        </div>
                        <a href="<?= BASE_PATH ?>/index.php?controller=front_entrainement"
                           class="btn btn-block mt-2" style="border-radius:20px; border:1px solid #ccc; font-size:.85rem; color:#666;">
                            <i class="fas fa-arrow-left mr-1"></i>Retour à la liste
                        </a>
                    </div>
                </div>
            </div>

            <!-- DÉPENSES ÉNERGÉTIQUES -->
            <div class="col-lg-8">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div class="heading-section">
                        <span class="subheading">Mesures</span>
                        <h3 class="mb-0">Dépenses Énergétiques <small class="text-muted" style="font-size:.7em;">(<?= count($depenses) ?>)</small></h3>
                    </div>
                    <a href="<?= BASE_PATH ?>/index.php?controller=front_entrainement&action=add_depense&id=<?= $entrainement['id'] ?>"
                       class="btn btn-sm px-3" style="background:#82ae46; color:#fff; border-radius:20px;">
                        <i class="fas fa-plus mr-1"></i>Ajouter
                    </a>
                </div>

                <?php if (empty($depenses)): ?>
                    <div style="background:#fff; border-radius:12px; box-shadow:0 4px 20px rgba(0,0,0,.06); padding:40px; text-align:center;">
                        <i class="fas fa-fire fa-3x mb-3" style="color:#ccc;"></i>
                        <p class="text-muted">Aucune dépense énergétique enregistrée.</p>
                        <a href="<?= BASE_PATH ?>/index.php?controller=front_entrainement&action=add_depense&id=<?= $entrainement['id'] ?>"
                           class="btn btn-sm px-4" style="background:#82ae46; color:#fff; border-radius:20px;">
                            Ajouter la première dépense
                        </a>
                    </div>
                <?php else: ?>
                    <?php
                    $totalCal = array_sum(array_column($depenses, 'calories_brulees'));
                    $fcValues = array_filter(array_column($depenses, 'frequence_cardiaque_moy'));
                    $avgFC    = count($fcValues) > 0 ? round(array_sum($fcValues) / count($fcValues)) : 0;
                    ?>
                    <!-- Stats résumé -->
                    <div class="row mb-4">
                        <div class="col-4">
                            <div style="background:linear-gradient(135deg,#f093fb,#f5576c); color:white; border-radius:12px; padding:18px; text-align:center;">
                                <h4 style="font-weight:700; margin:0;"><?= number_format($totalCal, 0) ?></h4>
                                <small>Total kcal</small>
                            </div>
                        </div>
                        <div class="col-4">
                            <div style="background:linear-gradient(135deg,#4facfe,#00f2fe); color:white; border-radius:12px; padding:18px; text-align:center;">
                                <h4 style="font-weight:700; margin:0;"><?= $avgFC ?: '—' ?></h4>
                                <small>FC moy. bpm</small>
                            </div>
                        </div>
                        <div class="col-4">
                            <div style="background:linear-gradient(135deg,#43e97b,#38f9d7); color:white; border-radius:12px; padding:18px; text-align:center;">
                                <h4 style="font-weight:700; margin:0;"><?= count($depenses) ?></h4>
                                <small>Séances</small>
                            </div>
                        </div>
                    </div>

                    <!-- Liste des dépenses -->
                    <?php foreach ($depenses as $d): ?>
                    <?php $ic = $intensiteColors[$d['intensite']] ?? ['bg'=>'#6c757d','txt'=>'#fff']; ?>
                    <div style="background:#fff; border-radius:12px; box-shadow:0 2px 12px rgba(0,0,0,.06); padding:20px; margin-bottom:16px;">
                        <div class="row align-items-center">
                            <div class="col-3 text-center" style="border-right:1px solid #f0f0f0;">
                                <div style="font-size:1.5rem; font-weight:700; color:#f5576c; line-height:1;"><?= number_format($d['calories_brulees'], 0) ?></div>
                                <small class="text-muted">kcal</small>
                            </div>
                            <div class="col-3 text-center" style="border-right:1px solid #f0f0f0;">
                                <div style="font-size:1.3rem; font-weight:600; color:#333; line-height:1;"><?= $d['frequence_cardiaque_moy'] ?? '—' ?></div>
                                <small class="text-muted">bpm</small>
                            </div>
                            <div class="col-3 text-center" style="border-right:1px solid #f0f0f0;">
                                <span style="background:<?= $ic['bg'] ?>; color:<?= $ic['txt'] ?>; padding:4px 12px; border-radius:20px; font-size:.78rem; font-weight:600;">
                                    <?= ucfirst($d['intensite']) ?>
                                </span>
                            </div>
                            <div class="col-3">
                                <?php if ($d['remarques']): ?>
                                    <small style="color:#888; font-style:italic; display:block;">"<?= htmlspecialchars(mb_substr($d['remarques'],0,40)) ?>"</small>
                                <?php endif; ?>
                                <small class="text-muted"><?= date('d/m/Y', strtotime($d['created_at'])) ?></small>
                                <div class="mt-1">
                                    <a href="<?= BASE_PATH ?>/index.php?controller=front_entrainement&action=del_depense&id=<?= $d['id'] ?>"
                                       style="color:#dc3545; font-size:.78rem;"
                                       onclick="return confirm('Supprimer cette dépense ?')">
                                        <i class="fas fa-trash mr-1"></i>Supprimer
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>

        </div>
    </div>
</section>

<?php require __DIR__ . '/../../layouts/front_footer.php'; ?>
