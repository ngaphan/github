<?php

abstract class Element
{
  protected $id;
  protected $name;

  public function getId() { return $this->id; }
  public function getName() { return $this->name; }

  public function setId($id)
  {
    $id = (int) $id;

    if ($id <= 0)
    {
      echo 'Class ' . get_class($this) . ': $id doit être un nombre entier positif différent de 0.';
    }
    else
    {
      $this->id = $id;
    }
  }

  public function setName($name)
  {
    if (!is_string($name))
    {
      echo 'Class ' . get_class($this) . ': $name doit être une chaîne de caractères.';
    }
    else
    {
      $this->name = $name;
    }
  }
}