<?php
require_once 'config.php';
try {
    $conn = config::getConnexion();
    echo "Connexion réussie à Nutrismart !";
} catch (Exception $e) {
    echo "Erreur : " . $e->getMessage();
}
?>








