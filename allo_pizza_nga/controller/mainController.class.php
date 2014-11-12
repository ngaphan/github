<?php

// controller/mainController.class.php

/**
 * 
 */
class mainController
{
  /**
   * ...
   * 
   * @param string $menu Nom de la rubrique dont on se sert comme nom de méthode
   */
  public function __construct($menu)
  {
    require_once 'view/top.phtml';
    
    // On construit le nom de la méthode en concaténant le nom de la rubrique
    // et la chaîne de caractère "Menu"
    $method = $menu . 'Menu';

    // Si la méthode $method existe bien dans cette classe
    if (method_exists($this, $method))
    {
      // On appelle cette méthode
      call_user_func(array($this, $method));
    }
    else
    {
      throw new Exception('Class ' . get_class($this) . ': la méthode ' . $method . ' n\'existe pas.');
    }

    require_once 'view/bottom.phtml';
  }

  /**
   * ...
   * 
   * @return void
   */
  public function homeMenu()
  {
    $categoryModel = new CategoryModel($this->PDO);
    $categoryModel->listAll();

    require_once 'view/home.phtml';
  }
}
