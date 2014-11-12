<?php

// model/user.class.php

/**
 * Classe représentant le "modèle" d'un utilisateur,
 * héritant de la classe Entity
 */
class User extends Entity
{
  // Attributs de la classe User
  private $email;

  public function __construct($id, $name, $email)
  {
    $this->setId($id);
    $this->setEmail($email);
    $this->setName($name);
  }

  // Liste des accesseurs (getters) pour les attributs protégés ou privés
  // (protégé = accessible seulement au sein de cette classe et des classes qui en sont héritées)
  // (privé = accessible seulement au sein de cette classe)
  public function getEmail() { return $this->email; }

  // Mutateur (setter) pour l'attribut privé $email
  public function setEmail($email)
  {
    // Si le format de cet email n'est pas valide
    if(!filter_var($email, FILTER_VALIDATE_EMAIL))
    {
      echo 'Class ' . get_class($this) . ': $email doit être un e-mail valide.';
    }
    // Sinon (s'il est valide)
    else
    {
      // On assigne la valeur de $email à la propriété "email" de l'objet en cours
      $this->email = $email;
    }
  }
}
