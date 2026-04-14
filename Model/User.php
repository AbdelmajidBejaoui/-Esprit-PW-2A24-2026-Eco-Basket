<?php
class User
{
    private $id;
    private $nom;
    private $email;
    private $password;
    private $role;
    private $preference_alimentaire;
    private $date_inscription;
    private $statut_compte;

    public function __construct(
        $id,
        $nom,
        $email,
        $password,
        $role,
        $preference_alimentaire,
        $date_inscription,
        $statut_compte
    ) {
        $this->id = $id;
        $this->nom = $nom;
        $this->email = $email;
        $this->password = $password;
        $this->role = $role;
        $this->preference_alimentaire = $preference_alimentaire;
        $this->date_inscription = $date_inscription;
        $this->statut_compte = $statut_compte;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getNom()
    {
        return $this->nom;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function getRole()
    {
        return $this->role;
    }

    public function getPreferenceAlimentaire()
    {
        return $this->preference_alimentaire;
    }

    public function getDateInscription()
    {
        return $this->date_inscription;
    }

    public function getStatutCompte()
    {
        return $this->statut_compte;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function setNom($nom)
    {
        $this->nom = $nom;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }

    public function setRole($role)
    {
        $this->role = $role;
    }

    public function setPreferenceAlimentaire($preference_alimentaire)
    {
        $this->preference_alimentaire = $preference_alimentaire;
    }

    public function setDateInscription($date_inscription)
    {
        $this->date_inscription = $date_inscription;
    }

    public function setStatutCompte($statut_compte)
    {
        $this->statut_compte = $statut_compte;
    }
}
?>
