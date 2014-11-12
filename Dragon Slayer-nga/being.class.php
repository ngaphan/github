<?php
class Being extends Element
{
    protected $life ;
    protected $lifeMax ;

    public function getLife()  { return $this->life ;    }
    public function getLifeMax(){ return $this->lifeMax ;  }

    public function __construct( $life ,$lifeMax)
    {
        $this->setLife($life);
        $this->setLifeMax($lifeMax);
    }

    public   function setLife($life)
    {
        $life = (float) $life ;

        if( $life < 0 )
        {
           echo 'Class ' . get_class($this) . ': $life doit être un nombre positif.';//get_class — Returns the name of the class of an object
        }
        else
        {
            $this->life = $life ;
        }
    }

    public   function setLifeMax($lifeMax)
    {
        $lifeMax = (float) $lifeMax ;

        if($lifeMax < 0 )
        {
            echo 'Class ' . get_class($this) . ': $lifeMax doit être un nombre positif.';
        }
        else
        {
            $this->lifeMax =  $lifeMax;
        }
    } 

}

