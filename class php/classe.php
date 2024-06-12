<?php

class Connexion {
  private $pdo;

  public function __construct(string $dsn, string $user, string $password) {
    $this->pdo = new PDO($dsn, $user, $password);
  }

  public function countTable(string $sql): int {
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute();
    return $stmt->rowCount();
  }
}
$connexion = new Connexion('mysql:host=localhost;dbname=data', 'username', 'password');
$count = $connexion->countTable('SELECT * FROM ');
echo "Nombre de lignes dans la table : " . $count;

?>
<?php
class Point2D{
    private $x;
    private $y;
    public function __construct($x, $y){
        $this->x = $x;
        $this->y = $y;
    }
    public function getX(){
        return $this->x;
    }
    public function getY(){
        return $this->y;
    }
    public function setX($x){
        $this->x = $x;
    }
    public function setY($y){
        $this->y = $y;
    }
    public function bouger($dx, $dy){
        $this->x += $dx;
        $this->y += $dy;
    }
    public function __toString(){
        return "Point(x=$this->x, y=$this->y)";
    }
}
abstract class Forme {
    private static $id = 0;
    protected $centre; // Point2D

    public function __construct() {
        $this->id = self::$id++;
        $this->centre = new Point2D(0, 0); // Initialisation par défaut
    }

    public abstract function surface();

    public abstract function perimetre();

    public function bouger(int $dx, int $dy) {
        $this->centre->x += $dx;
        $this->centre->y += $dy;
    }
}

class Point2D {
    public $x;
    public $y;

    public function __construct(int $x, int $y) {
        $this->x = $x;
        $this->y = $y;
    }
}

class Rectangle extends Forme {
    private $largeur;
    private $longueur;

    public function __construct(int $largeur, int $longueur) {
        parent::__construct();
        $this->largeur = $largeur;
        $this->longueur = $longueur;
    }

    public function getLargeur() : int {
        return $this->largeur;
    }

    public function setLargeur(int $largeur) {
        $this->largeur = $largeur;
    }

    public function getLongueur() : int {
        return $this->longueur;
    }

    public function setLongueur(int $longueur) {
        $this->longueur = $longueur;
    }

    public function surface() : int {
        return $this->largeur * $this->longueur;
    }

    public function perimetre() : int {
        return 2 * ($this->largeur + $this->longueur);
    }

    public function __toString() : string {
        return "{Rectangle : $this->id // $this->id est l'id de la forme\n" .
                "Centre:Point(x=" . $this->centre->x . ", y=" . $this->centre->y . ")\n" .
                "Largeur:$this->largeur\n" .
                "Longueur:$this->longueur\n" .
                "surface:" . $this->surface() . "\n" .
                "perimetre:" . $this->perimetre() . "\n}";
    }
}


class Cercle extends Forme {
    private $rayon;
    private $centre;

    public function __construct($rayon, $centre) {
        $this->rayon = $rayon;
        $this->centre = $centre;
    }

    public function getRayon() {
        return $this->rayon;
    }

    public function setRayon($rayon) {
        $this->rayon = $rayon;
    }

    public function getCentre() {
        return $this->centre;
    }

    public function setCentre($centre) {
        $this->centre = $centre;
    }

    public function surface() {
        return pi() * pow($this->rayon, 2);
    }

    public function perimetre() {
        return 2 * pi() * $this->rayon;
    }

    public function __toString() {
        return "{Cercle : Centre:{$this->centre}, Rayon:{$this->rayon}}";
    }
}

$cercle = new Cercle(2, new Point(3, 3));

echo "surface: " . $cercle->surface() . PHP_EOL;
echo "perimetre: " . $cercle->perimetre() . PHP_EOL;
echo $cercle . PHP_EOL;


class Carre extends Rectangle {
  public function __construct($cote) {
    parent::__construct($cote, $cote);
  }

  public function __toString() {
    return "{Carre :" . $this->getCote() . 
    "\nCentre:Point(x=" . $this->getX() . ", y=" . $this->getY() . ")" .
    "\nLongueur:" . $this->getCote() . 
    "\nsurface:" . $this->surface() . 
    "\nperimetre:" . $this->perimetre() . 
    "}";
  }
}
?>