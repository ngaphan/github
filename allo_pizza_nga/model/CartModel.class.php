<?php

// model/cartModel.class.php

/**
 * Classe permettant de gérer le panier de produits
 */
class CartModel extends Model
{
  protected $table = 'carts';
  protected $tableIdColumn = 'cartId';

  public function initialize()
  {
    $valuesArray = [
      'sessionId' => session_id()
    ];

    return $this->SQLQueryManager->insert($this->table, $valuesArray);
  }

  public function listAll()
  {
    // On prépare la requête SQL
    $query = "SELECT *
              FROM carts_products AS c, products AS p
              WHERE p.productId = c.productId AND c.cartId = :cartId";

    // On prépare le tableau faisant le "binding" entre les valeurs de nos variables
    // et celles qui sont envoyées dans la requête SQL (pour éviter les injections)
    $boundValues = [
      'cartId' => $_SESSION['cartId']
    ];

    // On demande l'exécution de la requête SQL
    // ainsi que la récupération des résultats (listes de produits du panier)
    // sous la formes d'un tableau à deux dimensions
    return $this->SQLQueryManager->query($query, $boundValues, true);
  }

  public function exists($n)
  {
    $whereArray = [
      'n' => $n
    ];

    $queryResults = $this->SQLQueryManager->select('carts_products', $whereArray);

    // S'il n'y a aucun enregistrement dans la BDD
    if (count($queryResults) === 0)
    {
      // On retourne la valeur FALSE
      return false;
    }
    // Sinon (s'il n'y aucun enregistrement)
    else
    {
      // On retourne la valeur TRUE
      return true;
    }
  }

  public function add($productId)
  {
    $whereArray = [
      'productId' => $productId,
      'cartId' => $_SESSION['cartId']
    ];

    $queryResults = $this->SQLQueryManager->select('carts_products', $whereArray);

    if (count($queryResults) === 1)
    {
      $this->increase($queryResults[0]['n']);
    }
    else
    {
      $valuesArray = [
        'productId' => $productId,
        'cartProductQuantity' => 1,
        'cartId' => $_SESSION['cartId']
      ];

      $products = $this->SQLQueryManager->insert('carts_products', $valuesArray);
    }
  }

  /**
   * Supprime le produit du panier de la BDD
   * 
   * @param  int  $n Identifiant de la ligne de panier
   * @return void
   */
  public function remove($n)
  {
    $this->SQLQueryManager->delete('carts_products', ['n' => $n]);
  }

  /**
   * 
   * 
   * @param  int  $n Identifiant de la ligne de panier
   * @return void
   */
  public function increase($n)
  {
    // On prépare la requête SQL
    $query = "UPDATE carts_products SET cartProductQuantity = (cartProductQuantity + 1) WHERE n = :n";

    // On prépare le tableau faisant le "binding" entre les valeurs de nos variables
    // et celles qui sont envoyées dans la requête SQL (pour éviter les injections)
    $boundValues = [
      'n' => $n
    ];
    
    // On demande l'exécution de la requête SQL
    $this->SQLQueryManager->query($query, $boundValues);
  }

  /**
   * 
   * 
   * @param  int  $n Identifiant de la ligne de panier
   * @return void
   */
  public function decrease($n)
  {
    // On prépare la requête SQL
    $query = "SELECT cartProductQuantity FROM carts_products WHERE n = :n";

    // On prépare le tableau faisant le "binding" entre les valeurs de nos variables
    // et celles qui sont envoyées dans la requête SQL (pour éviter les injections)
    $boundValues = [
      'n' => $n
    ];

    // On demande l'exécution de la requête SQL
    // ainsi que la récupération des résultats (listes de produits du panier)
    // sous la formes d'un tableau à deux dimensions
    $queryResults = $this->SQLQueryManager->query($query, $boundValues, true);

    if ($queryResults[0]['cartProductQuantity'] <= 1)
    {
      $this->remove($n);
    }
    else
    {
      // On prépare la requête SQL
      $query = "UPDATE carts_products SET cartProductQuantity = (cartProductQuantity - 1) WHERE n = :n";

      // On prépare le tableau faisant le "binding" entre les valeurs de nos variables
      // et celles qui sont envoyées dans la requête SQL (pour éviter les injections)
      $boundValues = [
        'n' => $n
      ];

      // On demande l'exécution de la requête SQL
      $this->SQLQueryManager->query($query, $boundValues);
    }
  }
}
