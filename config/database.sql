-- Base de données: gestion_fitness
CREATE DATABASE IF NOT EXISTS gestion_fitness CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE gestion_fitness;

-- Table entrainements
CREATE TABLE IF NOT EXISTS entrainements (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL,
    description TEXT,
    duree INT NOT NULL COMMENT 'durée en minutes',
    type_sport VARCHAR(50) NOT NULL,
    niveau ENUM('debutant','intermediaire','avance') NOT NULL DEFAULT 'debutant',
    date_entrainement DATE NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Table depenses_energetiques (liée à entrainements, 1:N)
CREATE TABLE IF NOT EXISTS depenses_energetiques (
    id INT AUTO_INCREMENT PRIMARY KEY,
    entrainement_id INT NOT NULL,
    calories_brulees DECIMAL(8,2) NOT NULL,
    frequence_cardiaque_moy INT,
    intensite ENUM('faible','moderee','elevee','maximale') NOT NULL DEFAULT 'moderee',
    remarques TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT fk_entrainement
        FOREIGN KEY (entrainement_id) REFERENCES entrainements(id)
        ON DELETE CASCADE ON UPDATE CASCADE
);

-- Données de test
INSERT INTO entrainements (nom, description, duree, type_sport, niveau, date_entrainement) VALUES
('Course matinale', 'Jogging léger en plein air', 45, 'Course à pied', 'debutant', '2026-04-01'),
('Musculation haut du corps', 'Exercices pour pectoraux, épaules et bras', 60, 'Musculation', 'intermediaire', '2026-04-03'),
('Yoga relaxation', 'Séance de yoga pour débutants', 30, 'Yoga', 'debutant', '2026-04-05'),
('HIIT intensif', 'Intervalle haute intensité 20/40', 35, 'HIIT', 'avance', '2026-04-07'),
('Vélo spinning', 'Cours de spinning en salle', 50, 'Cyclisme', 'intermediaire', '2026-04-09');

INSERT INTO depenses_energetiques (entrainement_id, calories_brulees, frequence_cardiaque_moy, intensite, remarques) VALUES
(1, 320.50, 135, 'moderee', 'Bonne séance, météo agréable'),
(1, 310.00, 130, 'faible', 'Légèrement fatigué'),
(2, 450.75, 150, 'elevee', 'Progression notable sur le développé couché'),
(3, 150.25, 95, 'faible', 'Très relaxant'),
(4, 520.00, 175, 'maximale', 'Effort maximal, excellente séance'),
(4, 510.50, 170, 'maximale', 'Second essai HIIT'),
(5, 400.00, 145, 'elevee', 'Spinning de 50 min très efficace');
