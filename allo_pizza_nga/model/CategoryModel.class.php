<?php

// model/categoryModel.class.php

/**
 * Classe permettant de gérer les catégories
 */
class CategoryModel extends Model
{
  protected $table = 'categories';
  protected $tableIdColumn = 'categoryId';

  public function add()
  {
    $valuesArray = [
      'categoryName' => $_POST['categoryName']
    ];

    $products = $this->SQLQueryManager->insert($this->table, $valuesArray);
  }

  public function getName($categoryId)
  {
    $valuesArray = [
      'categoryId' => $categoryId
    ];

    $categoriesArray = $this->SQLQueryManager->select($this->table, $valuesArray);

    return $categoriesArray[0]['categoryName'];
  }
}
