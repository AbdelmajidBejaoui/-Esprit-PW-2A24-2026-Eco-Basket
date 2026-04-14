<?php
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../Model/User.php';

class UserC
{
    public function listUsers()
    {
        $sql = 'SELECT * FROM `user` ORDER BY id DESC';
        $db = config::getConnexion();

        try {
            $list = $db->query($sql);
            return $list->fetchAll();
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }

    public function getUserById($id)
    {
        $sql = 'SELECT * FROM `user` WHERE id = :id';
        $db = config::getConnexion();

        try {
            $query = $db->prepare($sql);
            $query->execute(['id' => $id]);
            return $query->fetch();
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }

    public function insertUser($user)
    {
        $sql = 'INSERT INTO `user` (nom, email, password, role, preference_alimentaire, date_inscription, statut_compte)
                VALUES (:nom, :email, :password, :role, :preference_alimentaire, :date_inscription, :statut_compte)';
        $db = config::getConnexion();

        try {
            $query = $db->prepare($sql);
            $query->execute([
                'nom' => $user->getNom(),
                'email' => $user->getEmail(),
                'password' => password_hash($user->getPassword(), PASSWORD_DEFAULT),
                'role' => $user->getRole(),
                'preference_alimentaire' => $user->getPreferenceAlimentaire(),
                'date_inscription' => $user->getDateInscription(),
                'statut_compte' => $user->getStatutCompte()
            ]);
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }

    public function updateUser($user, $id, $updatePassword = false)
    {
        $db = config::getConnexion();

        try {
            if ($updatePassword) {
                $sql = 'UPDATE `user`
                        SET nom = :nom,
                            email = :email,
                            password = :password,
                            role = :role,
                            preference_alimentaire = :preference_alimentaire,
                            date_inscription = :date_inscription,
                            statut_compte = :statut_compte
                        WHERE id = :id';

                $query = $db->prepare($sql);
                $query->execute([
                    'nom' => $user->getNom(),
                    'email' => $user->getEmail(),
                    'password' => password_hash($user->getPassword(), PASSWORD_DEFAULT),
                    'role' => $user->getRole(),
                    'preference_alimentaire' => $user->getPreferenceAlimentaire(),
                    'date_inscription' => $user->getDateInscription(),
                    'statut_compte' => $user->getStatutCompte(),
                    'id' => $id
                ]);
                return;
            }

            $sql = 'UPDATE `user`
                    SET nom = :nom,
                        email = :email,
                        role = :role,
                        preference_alimentaire = :preference_alimentaire,
                        date_inscription = :date_inscription,
                        statut_compte = :statut_compte
                    WHERE id = :id';

            $query = $db->prepare($sql);
            $query->execute([
                'nom' => $user->getNom(),
                'email' => $user->getEmail(),
                'role' => $user->getRole(),
                'preference_alimentaire' => $user->getPreferenceAlimentaire(),
                'date_inscription' => $user->getDateInscription(),
                'statut_compte' => $user->getStatutCompte(),
                'id' => $id
            ]);
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }

    public function deleteUser($id)
    {
        $sql = 'DELETE FROM `user` WHERE id = :id';
        $db = config::getConnexion();

        try {
            $query = $db->prepare($sql);
            $query->execute(['id' => $id]);
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }

    public function validateUserData($data, $passwordRequired = true)
    {
        $errors = [];

        $nom = trim($data['nom'] ?? '');
        $email = trim($data['email'] ?? '');
        $password = $data['password'] ?? '';
        $role = trim($data['role'] ?? 'client');
        $preference = trim($data['preference_alimentaire'] ?? '');
        $dateInscription = trim($data['date_inscription'] ?? '');
        $statutCompte = isset($data['statut_compte']) ? (int) $data['statut_compte'] : 1;

        if ($nom === '' || !preg_match('/^[a-zA-Z\s\-]{2,100}$/', $nom)) {
            $errors[] = 'Nom invalide (lettres, espaces, tirets, min 2 caracteres).';
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = 'Email invalide.';
        }

        if ($passwordRequired) {
            if (strlen($password) < 8 || !preg_match('/[A-Za-z]/', $password) || !preg_match('/\d/', $password)) {
                $errors[] = 'Mot de passe invalide (min 8 caracteres avec lettres et chiffres).';
            }
        }

        if (!in_array($role, ['admin', 'client'], true)) {
            $errors[] = 'Role invalide (admin ou client).';
        }

        if ($preference === '' || strlen($preference) > 50) {
            $errors[] = 'Preference alimentaire invalide (obligatoire, max 50 caracteres).';
        }

        if ($dateInscription === '') {
            $errors[] = 'Date inscription obligatoire.';
        } else {
            $date = DateTime::createFromFormat('Y-m-d H:i:s', $dateInscription);
            if (!$date || $date->format('Y-m-d H:i:s') !== $dateInscription) {
                $errors[] = 'Date inscription invalide (format: YYYY-MM-DD HH:MM:SS).';
            }
        }

        if (!in_array($statutCompte, [0, 1], true)) {
            $errors[] = 'Statut compte invalide (0 ou 1).';
        }

        return $errors;
    }
}
?>