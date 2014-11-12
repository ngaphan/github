<?php

// model/OrderModel.class.php

/**
 * Classe permettant de gérer le panier de produits
 */
/* on a dejà hérieté chez l class mère , mais ici on cré un autre listAll car la classe mère n'eest pas efficace , CONVIENT PAS, je veux un autre listall -> SURCHARGE , la nouvelle listall qui adapte à ce su'on veut
*/
class OrderModel extends Model
{
  protected $table = 'orders';
  protected $tableIdColumn = 'orderId';

  public function listAll()
  {
    // On prépare la requête SQL
    $query = "SELECT o.*, c.*, sum(op.orderProductPrice * op.orderProductQuantity) AS orderTotalPrice
              FROM orders AS o
              LEFT JOIN orders_products AS op
              ON o.orderId = op.orderId
              LEFT JOIN customers AS c
              ON o.customerId = c.customerId
              GROUP BY o.orderId
              ORDER BY o.orderDate DESC";

    // On demande l'exécution de la requête SQL
    // ainsi que la récupération des résultats (listes de produits du panier)
    // sous la formes d'un tableau à deux dimensions
    return $this->SQLQueryManager->query($query, [], true);
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

  public function add()
  {
    $whereArray = [
      'cartId' => $_SESSION['cartId']
    ];

    $queryResults = $this->SQLQueryManager->select('carts_products', $whereArray);

    // S'il n'y a aucun produit dans le panier
    if (count($queryResults) === 0)
    {
      return false;
    }
    // Sinon (s'il y a bien des produits dans le panier)
    else
    {
      // -------------------------------------------------------
      // Etape 1 : on initialise (= crée) la commande
      
      // On prépare le tableau faisant le "binding" entre les valeurs de nos variables
      // et celles qui sont envoyées dans la requête SQL (pour éviter les injections)
      $valuesArray = [
        'customerId' => $_SESSION['customerArray']['customerId']
      ];

      // On demande l'insertion des valeurs dans la BDD
      // (et on récupère l'identifiant de la commande)
      $orderId = $this->SQLQueryManager->insert($this->table, $valuesArray);

      // -------------------------------------------------------
      // Etape 2 : on récupère l'ensemble de lignes du panier
      // (qu'on complète des informations produits grâce au JOIN)

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
      $cartArray = $this->SQLQueryManager->query($query, $boundValues, true);

      foreach ($cartArray as $cartRow)
      {
        $valuesArray = [
          'orderProductName' => $cartRow['productName'],
          'orderProductPrice' => $cartRow['productPrice'],
          'orderProductQuantity' => $cartRow['cartProductQuantity'],
          'productId' => $cartRow['productId'],
          'orderId' => $orderId
        ];
        
        $this->SQLQueryManager->insert('orders_products', $valuesArray);
      }

      return $orderId;
    }
  }
}
