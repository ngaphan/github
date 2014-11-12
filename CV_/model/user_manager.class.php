<?php

// model/user_manager.class.php

/**
 * Classe permettant de gérer les utilisateurs
 */
class UserManager extends Model
{
  /**
   * Récupère la liste des utilisateurs sous la forme d'un tableau à deux dimensions
   * 
   * @return array Tableau à deux dimensions listant les utilisateurs
   */
  public function listAll()
  {
    // On prépare notre requête SQL
    $query = "SELECT * FROM users ORDER BY userName";
    
    // On charge notre requête SQL dans la couche d'abstraction PDO
    $statement = $this->PDO->prepare($query);

    // On exécute notre requête SQL
    $statement->execute();

    // On retourne nos résultats SQL (liste des utilisateurs)
    // sous la forme d'un tableau à deux dimensions
    return $statement->fetchAll();
  }

  /**
   * Ajoute un nouvel utilisateur dans la BDD
   * @param  string $userName     Nom de l'utilisateur
   * @param  string $userEmail    E-mail de l'utilisateur
   * @param  string $userPassword Mot de passe de l'utilisateur (paramètre optionnel)
   * @return void
   */
  public function add($userName, $userEmail, $userPassword)
  {
    // On passe la casse de l'email en minuscules pour éviter toute confusion dans les contrôles
    $userEmail = strtolower($userEmail);

    // On crypte le mot de passe en SHA512
    // en lui ajoutant la constante représentant la passphrase,
    // cette passphrase servant à rendre unique le résultat du cryptage
    $userEncryptedPassword = hash('SHA512', $userPassword . PASS_PHRASE);

    // On prépare notre requête SQL
    $query = "INSERT INTO users (userName, userEmail, userPassword) VALUES (:userName, :userEmail, :userPassword)";
    
    // On prépare notre tableau faisant le "binding" entre les valeurs de nos variables
    // et celles qui sont envoyées dans la requête SQL (pour éviter les injections)
    $boundValues = [
      'userName' => $userName,
      'userEmail' => $userEmail,
      'userPassword' => $userEncryptedPassword,
    ];

    // On charge notre requête SQL dans la couche d'abstraction PDO
    $statement = $this->PDO->prepare($query);

    // On exécute notre requête SQL (en liant notre tableau de "binding")
    $statement->execute($boundValues);
  }

  /**
   * Supprime un utilisateur de la BDD à partir de son identifiant
   * 
   * @param  int    $userId     Identifiant de l'utilisateur
   * @return void
   */
  public function delete($userId)
  {
    // On prépare notre requête SQL
    $query = "DELETE FROM users WHERE userId = :userId";
    
    // On prépare notre tableau faisant le "binding" entre les valeurs de nos variables
    // et celles qui sont envoyées dans la requête SQL (pour éviter les injections)
    $boundValues = [
      'userId' => $userId
    ];

    // On charge notre requête SQL dans la couche d'abstraction PDO
    $statement = $this->PDO->prepare($query);
    
    // On exécute notre requête SQL (en liant notre tableau de "binding")
    $statement->execute($boundValues);
  }

  /**
   * Crée un objet User en récupérant ses propriétés à partir de la BDD
   * 
   * @param  int    $userEmail Email de l'utilisateur
   * @return mixed             Renvoie un objet Character si le personnage existe, FALSE sinon
   */
  public function create($userEmail)
  {
    // On prépare notre requête SQL
    $query = "SELECT * FROM users WHERE userEmail = :userEmail";
    
    // On prépare notre tableau faisant le "binding" entre les valeurs de nos variables
    // et celles qui sont envoyées dans la requête SQL (pour éviter les injections)
    $boundValues = [
      'userEmail' => $userEmail
    ];

    // On charge notre requête SQL dans la couche d'abstraction PDO
    $statement = $this->PDO->prepare($query);

    // On exécute notre requête SQL (en liant notre tableau de "binding")
    $statement->execute($boundValues);
    
    // On récupère la ligne correspondante de la table "users" sous la forme d'un tableau
    $userArray = $statement->fetch();

    // On instancie notre classe Character pour créer un objet Character
    // avec pour propriétés les données récupérées à partir de la BDD
    $userObject = new User($userArray['userId'], $userArray['userName'], $userArray['userEmail']);

    // On retourne notre objet Character
    return $userObject;
  }

  /**
   * Contrôle si l'utilisateur existe à partir de son email
   * Si le mot de passe est précisé : contrôle aussi si le mot de passe (crypté) correspond
   * 
   * @param  string $userEmail    E-mail de l'utilisateur
   * @param  string $userPassword Mot de passe de l'utilisateur (paramètre optionnel)
   * @return bool                 Renvoie TRUE si c'est le cas, FALSE sinon
   */
  public function check($userEmail, $userPassword = null)
  {
    // On prépare notre requête SQL
    $query = "SELECT * FROM users WHERE userEmail = :userEmail";
    
    // On prépare notre tableau faisant le "binding" entre les valeurs de nos variables
    // et celles qui sont envoyées dans la requête SQL (pour éviter les injections)
    $boundValues = [
      'userEmail' => strtolower($userEmail)
    ];

    // Si $userPassword, le second paramètre optionnel, a été renseigné
    if (!is_null($userPassword))
    {
      // On crypte le mot de passe en SHA512
      // en lui ajoutant la constante représentant la passphrase,
      // cette passphrase servant à rendre unique le résultat du cryptage
      $userEncryptedPassword = hash('SHA512', $userPassword . PASS_PHRASE);
      
      // On complète la requête SQL
      $query .= " AND userPassword = :userPassword";

      // On complète notre "binding"
      $boundValues['userPassword'] = $userEncryptedPassword;
    }

    // On charge notre requête SQL dans la couche d'abstraction PDO
    $statement = $this->PDO->prepare($query);
    
    // On exécute notre requête SQL (en liant notre tableau de "binding")
    $statement->execute($boundValues);
    
    // S'il n'y a aucun enregistrement dans la BDD
    if ($statement->rowCount() === 0)
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

  /**
   * Contrôle si l'utilisateur existe à partir de son identifiant
   * 
   * @param  int   $userId    Identifiant de l'utilisateur
   * @return bool             Renvoie TRUE s'il existe, FALSE sinon
   */
  public function exists($userId)
  {
    // On prépare notre requête SQL
    $query = "SELECT * FROM users WHERE userId = :userId";
    
    // On prépare notre tableau faisant le "binding" entre les valeurs de nos variables
    // et celles qui sont envoyées dans la requête SQL (pour éviter les injections)
    $boundValues = [
      'userId' => strtolower($userId)
    ];

    // On charge notre requête SQL dans la couche d'abstraction PDO
    $statement = $this->PDO->prepare($query);
    
    // On exécute notre requête SQL (en liant notre tableau de "binding")
    $statement->execute($boundValues);
    
    // S'il n'y a aucun enregistrement dans la BDD
    if ($statement->rowCount() === 0)
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
}
