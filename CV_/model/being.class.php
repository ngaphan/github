<?php

// model/being.class.php

/**
 * Classe mère représentant le "modèle" d'un être vivant,
 * héritant de la classe Entity
 *
 * Cette classe est déclarée en tant que classe abstraite (abstract)
 * pour éviter qu'on puisse l'instancier directement (= créer un objet type Model)
 *
 * @abstract
 */
abstract class Being extends Entity
{
  // Attributs de la classe Being
  protected $life;
  protected $lifeMax;

  // Liste des accesseurs (getters) pour les attributs protégés ou privés
  // (protégé = accessible seulement au sein de cette classe et des classes qui en sont héritées)
  // (privé = accessible seulement au sein de cette classe)
  public function getLife() { return $this->life; }
  public function getLifeMax() { return $this->lifeMax; }

  // Mutateur (setter) pour l'attribut protégé $life
  public function setLife($life)
  {
    // On transtype (cast) le paramètre $lifeMax en nombre flottant (à virgule)
    $life = (float) $life;

    // Si la valeur de $life est négative
    if ($life < 0)
    {
      echo 'Class ' . get_class($this) . ': $life doit être un nombre positif.';
    }
    // Sinon (si elle est positive ou égale à 0)
    else
    {
      // On assigne la valeur de $life à la propriété "life" de l'objet en cours
      $this->life = $life;
    }
  }

  // Mutateur (setter) pour l'attribut protégé $lifeMax
  public function setLifeMax($lifeMax)
  {
    // On transtype (cast) le paramètre $lifeMax en nombre flottant (à virgule)
    $lifeMax = (float) $lifeMax;

    // Si la valeur de $lifeMax est négative
    if ($lifeMax < 0)
    {
      echo 'Class ' . get_class($this) . ': $lifeMax doit être un nombre positif.';
    }
    // Sinon (si elle est positive ou égale à 0)
    else
    {
      // On assigne la valeur de $lifeMax à la propriété "lifeMax" de l'objet en cours
      $this->lifeMax = $lifeMax;
    }
  }
}