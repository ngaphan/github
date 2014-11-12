<?php

class UserManager
{
    protected $DBConnection;

    public function __construct($DBConnection)
    {
        $this->setDBConnection($DBConnection);
    }

    public function setDBConnection(PDO $DBConnectionObject)
    {
        $this->DBConnection = $DBConnectionObject;
    }


    public function listAll()
    {
        $query = " SELECT * FROM users ORDER BY userId ";
        $statement = $this->DBConnection->prepare($query);
        $statement->execute();

        return $statement->fetchAll();
    }

    public function add($username , $mdp, $nom , $prenom , $email )
    // ces variables vont à droite de $bound
    {
        $query =" INSERT INTO users (username, mdp, nom ,prenom , email)
                 VALUES(:username, :mdp, :nom ,:prenom , :email ) ";
                 // ces valeurs vont à gauche de $boundBD
        $boundBD = [
                        "username" => $username,
                        "mdp" => hash("sha512",$mdp.PASS_PHRASE),
                        "nom" => $nom ,
                        "prenom" => $prenom ,
                        "email" => $email
                    ];

        $statement = $this->DBConnection->prepare($query);
        $statement->execute($boundBD);
    }

    public function delete($userId)
    {
        $query ="DELETE FROM users WHERE userId = :userId "  ;
        $boundBD = ["userId" => $userId ];

        $statement = $this->DBConnection->prepare($query);
        $statement->execute($boundBD);
    }

    public function disconnect($userId)
    {
        session_start() ;
        $_SESSION['userId'] = $userId ;
        $_SESSION['userId'] = [] ;
        session_destroy() ;
    }


    // Pierre

    public function exists($userId)
    {
        $query = "SELECT * FROM users WHERE userId = :userId";

        $boundBD = [
                        'userId' => $userId
                    ];

        $statement = $this->DBConnection->prepare($query);
        $statement->execute($boundBD);

        if ($statement->rowCount() === 0)
        {
            return false;            
        }
        else
        {
            return true;
        }
    }

    public function existsUserNamePassword($username, $mdp )
    {
        $query = " SELECT * FROM users WHERE username = :username
        AND mdp = :mdp " ;

        $boundBD = [
                'username' => $username,
                "mdp" => hash("sha512",$mdp.PASS_PHRASE)
        ];

        $statement = $this->DBConnection->prepare($query);
        $statement->execute($boundBD);

        if ($statement->rowCount() === 0)
        {
            echo "FALSE"  ;
            return false;
        }
        else
        {
            echo "TRUE"  ;
            return true ;
        }
    }

    public function create($userId )
    {
        if (!$this->exists($userId))
        {           
            return false;
        }
        else
        {
        	echo " création" ;
            $query = "SELECT * FROM users WHERE userId = :userId ";

            $boundBD = [
                'userId' => $userId
            ];

            $statement = $this->DBConnection->prepare($query);
            $statement->execute($boundBD);

            $userArray = $statement->fetch();
            $userObj = new User($userArray['userId'],$userArray['username'],$userArray['mdp'],$userArray['nom'],$userArray['prenom'],$userArray['email'] );

            return $userObj;
        }
    }

}