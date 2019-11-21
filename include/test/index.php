<?php
class Humain
{
    private $nom;
    private $prenom;
    private $dateNaiss;

    public function __construct($nom, $prenom, $dateNaiss)
    {
        $this->nom=$nom;
        $this->prenom=$prenom;
        $this->dateNaiss=$dateNaiss;
    }
}
