<?php

// model/productModel.class.php

/**
 * Classe permettant de gérer les produits
 */
class ProductModel extends Model
{
    protected $table = 'products';
    protected $tableIdColumn = 'productId';

    public function listAll($categoryId = null)
    {
        if (!is_null($categoryId))
        {
            $whereArray = [
                'categoryId' => $categoryId
            ];

            return $this->SQLQueryManager->select($this->table, $whereArray);
        }
        else
        {
            // On prépare la requête SQL
            $query = "SELECT *
                FROM products AS p, categories AS c
                WHERE p.categoryId = c.categoryId
                ORDER BY c.categoryName, p.productName";

            // On demande l'exécution de la requête SQL
            // ainsi que la récupération des résultats (listes de produits du panier)
            // sous la formes d'un tableau à deux dimensions
            return $this->SQLQueryManager->query($query, [], true);
        }
    }

    /**
     * Ajoute un nouveau produit dans la BDD
     *
     * @return int L'identifiant du dernier produit inséré
     */
    public function add()
    {
        // On prépare le tableau faisant le lien entre les noms de colonnes
        // de la table "products" et les données envoyées via le formulaire
        $valuesArray = [
            'productName' => $_POST['productName'],
            'productDescription' => $_POST['productDescription'],
            'productPrice' => $_POST['productPrice'],
            'categoryId' => $_POST['categoryId']
        ];

        // On demande l'exécution de notre insertion dans la BDD
        // et on retourne l'identifiant du dernier produit inséré
        return $this->SQLQueryManager->insert($this->table, $valuesArray);
    }
}
