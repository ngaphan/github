<?php

// model/entity.class.php

/**
 * Classe mère représentant le "modèle" d'un entité
 *
 * Cette classe est déclarée en tant que classe abstraite (abstract)
 * pour éviter qu'on puisse l'instancier directement (= créer un objet type Model)
 *
 * @abstract
 */
abstract class Entity
{
  // Attributs de la classe Entity
  protected $id;

  // Liste des accesseurs (getters) pour les attributs protégés ou privés
  // (protégé = accessible seulement au sein de cette classe et des classes qui en sont héritées)
  // (privé = accessible seulement au sein de cette classe)
  public function getId() { return $this->id; }


  // Mutateur (setter) pour l'attribut protégé $id
  public function setId($id)
  {
    // On transtype (cast) le paramètre $lifeMax en nombre entier
    $id = (int) $id;

    // Si la valeur de $id est négative ou égale à 0
    if ($id <= 0)
    {
      echo 'Class ' . get_class($this) . ': $id doit être un nombre entier positif différent de 0.';
    }
    // Sinon (si elle positive et différente de 0)
    else
    {
      // On assigne la valeur de $id à la propriété "id" de l'objet en cours
      $this->id = $id;
    }
  }
}


