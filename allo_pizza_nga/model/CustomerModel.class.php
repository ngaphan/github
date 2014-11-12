<?php

// model/CustomerModel.class.php

/**
 * Classe permettant de gérer les clients
 */
class CustomerModel extends Model
{
  protected $table = 'customers';
  protected $tableIdColumn = 'customerId';

  public function add()
  {
    $valuesArray = [
      'customerCivility' => $_POST['customerCivility'],
      'customerLastName' => $_POST['customerLastName'],
      'customerFirstName' => $_POST['customerFirstName'],
      'customerEmail' => $_POST['customerEmail'],
      'customerPassword' => hash('SHA512', $_POST['customerPassword']),
      'customerAddress' => $_POST['customerAddress'],
      'customerZipCode' => $_POST['customerZipCode'],
      'customerCity' => $_POST['customerCity']
    ];

    $products = $this->SQLQueryManager->insert($this->table, $valuesArray);
  }

  public function connect()
  {
    // On prépare la requête SQL
    $query = "SELECT * FROM customers WHERE customerEmail = :customerEmail AND customerPassword = :customerPassword";

    // On prépare le tableau faisant le "binding" entre les valeurs de nos variables
    // et celles qui sont envoyées dans la requête SQL (pour éviter les injections)
    $boundValues = [
      'customerEmail' => $_POST['customerEmail'],
      'customerPassword' => hash('SHA512', $_POST['customerPassword'])
    ];

    // On demande l'exécution de la requête SQL
    // ainsi que la récupération des résultats (listes de produits du panier)
    // sous la formes d'un tableau à deux dimensions
    $customerArray = $this->SQLQueryManager->query($query, $boundValues, true);

    if (count($customerArray) === 0)
    {
      return false;
    }
    else
    {
      return $customerArray[0];
    }
  }
}
