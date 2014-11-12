<?php

class User
{

    protected $userId;
    protected $username;
    protected $mdp;
    protected $nom;
    protected $prenom;
    protected $email;

    public function __construct($userId , $username , $mdp , $nom ,$prenom ,$email)
    {
        $this->setUserId($userId);
        $this->setUsername($username);
        $this->setMdp($mdp);
        $this->setNom($nom);
        $this->setPrenom($prenom);
        $this->setEmail($email);
    }

    public function getUserId()     {  return $this->userId ;    }
    public function getUsername()   {  return $this->username ;    }
    public function getMdp()        {  return $this->mdp ;    }
    public function getNom()        {  return $this->nom ;    }
    public function getPrenom()     {  return $this->prenom ;    }
    public function getEmail()      {  return $this->email ;    }

    public   function setUserId($userId)
    {
        $userId = (int) $userId ;

        if($userId < 0)
        {
            echo $userId . ' doit être un nombre entier positif.';
        }
        else
        {
            $this->userId = $userId;
        }
    }
    public function setUsername($username)
    {
        $username = (string) $username ;

        $this->username = $username;
    }
    public function setMdp($mdp)
    {
        $mdp = (string) $mdp ;

        $mdp->mdp = $mdp;
    }
    public function setNom($nom)
    {
        $nom = (string) $nom ;

        $nom->nom = $nom;
    }
    public function setPrenom($prenom)
    {
        $prenom = (string) $prenom ;

        $prenom->prenom = $prenom;
    }
    public function setEmail($email)
    {
        $email = (string) $email ;

        $email->email = $email;
    }

}