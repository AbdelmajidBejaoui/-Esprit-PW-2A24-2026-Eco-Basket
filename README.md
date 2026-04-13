# FitTrack – Gestion des Entraînements
**Projet Technologies Web – ESPRIT 2025-2026**

---

## 📁 Structure du projet (MVC)

```
entrainements_project/
├── index.php                          ← Router / point d'entrée unique
├── config/
│   ├── Database.php                   ← Connexion PDO (Singleton)
│   └── database.sql                   ← Script création BDD + données test
├── models/
│   ├── Entrainement.php               ← Modèle entraînements (CRUD + jointure)
│   └── DepenseEnergetique.php         ← Modèle dépenses (CRUD + jointure)
├── controllers/
│   ├── EntrainementFrontController.php
│   ├── EntrainementBackController.php ← CRUD + validation PHP
│   └── DepenseBackController.php      ← CRUD + validation PHP
├── views/
│   ├── layouts/
│   │   ├── front_header.php           ← Entête VegeFood
│   │   ├── front_footer.php
│   │   ├── back_header.php            ← Entête AdminLTE
│   │   └── back_footer.php
│   ├── front/
│   │   └── entrainements/
│   │       ├── index.php              ← Liste publique
│   │       └── show.php               ← Détail + dépenses
│   └── back/
│       ├── dashboard.php              ← Tableau de bord admin
│       ├── entrainements/
│       │   ├── index.php              ← Liste CRUD
│       │   ├── create.php
│       │   ├── edit.php
│       │   ├── show.php               ← Détail + dépenses liées
│       │   └── _form.php              ← Formulaire partagé
│       └── depenses/
│           ├── index.php
│           ├── create.php
│           ├── edit.php
│           └── _form.php
└── public/
    ├── vegefoods/                     ← Template Front Office
    └── adminlte/                      ← Template Back Office
```

---

## ⚙️ Installation

### 1. Base de données
```sql
-- Dans phpMyAdmin ou MySQL :
SOURCE config/database.sql;
```

### 2. Configuration BDD
Ouvrir `config/Database.php` et modifier si besoin :
```php
$host   = 'localhost';
$dbname = 'gestion_fitness';
$user   = 'root';
$pass   = '';        // mettre votre mot de passe
```

### 3. Serveur local
Placer le dossier dans `htdocs/` (XAMPP) ou `www/` (WAMP), puis accéder à :
```
http://localhost/entrainements_project/
```

---

## 🔗 URLs principales

| Page | URL |
|------|-----|
| Front Office – Liste | `index.php` ou `index.php?controller=front_entrainement` |
| Front Office – Détail | `index.php?controller=front_entrainement&action=show&id=1` |
| Dashboard Admin | `index.php?controller=dashboard` |
| Back – Entraînements | `index.php?controller=back_entrainement&action=index` |
| Back – Dépenses | `index.php?controller=back_depense&action=index` |

---

## ✅ Contraintes respectées

- ✅ **MVC** : Models / Views / Controllers séparés
- ✅ **PDO** uniquement (pas de MySQLi)
- ✅ **POO** : Classes avec méthodes, constructeurs, pas de fonctions globales
- ✅ **Validation PHP** côté serveur (pas de validation HTML5 seule)
- ✅ **Jointure 1:N** : `entrainements` ↔ `depenses_energetiques`
- ✅ **CRUD complet** : Créer, Lire, Modifier, Supprimer sur les 2 entités
- ✅ **Front Office** (VegeFood) + **Back Office** (AdminLTE)
- ✅ **Requêtes préparées** PDO sur toutes les opérations

---

## 🗃️ Modèle de données

```
entrainements (1) ──────────────────── (N) depenses_energetiques
  id PK                                      id PK
  nom                                         entrainement_id FK
  description                                 calories_brulees
  duree (minutes)                             frequence_cardiaque_moy
  type_sport                                  intensite (ENUM)
  niveau (ENUM)                               remarques
  date_entrainement                           created_at
  created_at
```
