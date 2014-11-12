<?php

class Character
{
    protected $armor;
    protected $life;
    protected $lifeMax;
    protected $name;

    public function __construct($name, $lifeMax, $armor)
    {
        $this->setArmor($armor);
        $this->setLife($lifeMax);
        $this->setLifeMax($lifeMax);
        $this->setName($name);
    }

    public function getArmor() { return $this->armor; }
    public function getLife() { return $this->life; }
    public function getLifeMax() { return $this->lifeMax; }
    public function getName() { return $this->name; }

    public function setArmor($armor)
    {
        if (!is_int($armor) || $armor < 0)
        {
            echo 'Class Character : $armor doit être un nombre entier positif.';
        }
        else
        {
            $this->armor = $armor;
        }
    }

    public function setLife($life)
    {
        if (!is_numeric($life) || $life < 0)
        {
            echo 'Class Character : $life doit être un nombre positif.';
        }
        else
        {
            $this->life = (float) $life;
        }
    }

    public function setLifeMax($lifeMax)
    {
        if (!is_numeric($lifeMax) || $lifeMax < 0)
        {
            echo 'Class Character : $lifeMax doit être un nombre positif.';
        }
        else
        {
            $this->lifeMax = (float) $lifeMax;
        }
    }

    protected function setName($name)
    {
        if (!is_string($name))
        {
            echo 'Class Character : $name doit être une chaîne de caractères.';
        }
        else
        {
            $this->name = $name;
        }
    }
}

//  Weapon


<?php

class Weapon
{
    protected $force;
    protected $name;

    public function __construct($name, $force)
    {
        $this->setForce($force);
        $this->setName($name);
    }

    public function getForce() { return $this->force; }
    public function getName() { return $this->name; }

    public function setForce($force)
    {
        if (!is_int($force))
        {
            echo 'Class Weapon : $force n\'est pas un nombre entier.';
        }
        else
        {
            $this->force = $force;
        }
    }

    public function setName($name)
    {
        if (!is_string($name))
        {
            echo 'Class Weapon : $name n\'est pas une chaîne de caractères.';
        }
        else
        {
            $this->name = $name;
        }
    }
}


//  à coller après bottom.phtml dans l'index.php

<?php

$nightFury = new Dragon('Night Fury', 100, 10);
$sword = new Weapon('Sword', 10);
$hiccup = new Character('Hiccup', 100, 5, $sword);

echo '<p><b>' . $hiccup->getName() . '</b>, equipped with a <b>' . $hiccup->getWeapon()->getName() . '</b>, has a life level of ' . $hiccup->getLife() . '.<br><b>' . $hiccup->getName() . '</b> has <b>' . $nightFury->getLife() . '</b> points of life.</p>';

while ($hiccup->getLife() > 0 && $nightFury->getLife() > 0)
{
    $injuries = $hiccup->attack($nightFury);

    echo '<p><b>' . $hiccup->getName() . '</b> attacks <b>' . $nightFury->getName() . '</b>, who losts <b>' . $injuries . '</b> points of life.<br><b>' . $hiccup->getName() . '</b> has now <b>' . $nightFury->getLife() . '</b> points of life.<br>';

    if ($nightFury->getLife() == 0) break;

    $injuries = $nightFury->attack($hiccup);

    echo '<p><b>' . $nightFury->getName() . '</b> attacks <b>' . $hiccup->getName() . '</b>, who losts <b>' . $injuries . '</b> points of life.<br><b>' . $hiccup->getName() . '</b> has now <b>' . $hiccup->getLife() . '</b> points of life.</p>';
}

if ($nightFury->getLife() == 0)
{
    echo '<p><b>' . $nightFury->getName() . '</b> est mort.<p>';
}
else
{
    echo '<p><b>' . $hiccup->getName() . '</b> est mort.<p>';
}
