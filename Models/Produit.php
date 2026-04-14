<?php

class Produit {
    public $nom, $prix, $description, $stock, $categorie, $image_url;

    public function __construct($nom, $prix, $description, $stock, $categorie, $image_url) {
        $this->nom = $nom;
        $this->prix = $prix;
        $this->description = $description;
        $this->stock = $stock;
        $this->categorie = $categorie;
        $this->image_url = $image_url;
    }
}