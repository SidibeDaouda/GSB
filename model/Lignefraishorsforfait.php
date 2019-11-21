<?php
class Lignefraishorsforfait{

    private $id;
    private $idVisiteur;
    private $mois;
    private $libelle;
    private $date;
    private $montant;

    public function __construct($idVisiteur, $mois, $libelle, $date, $montant)
    {
        $this->idVisiteur = $idVisiteur;
        $this->mois = $mois;
        $this->libelle = $libelle;
        $this->date = $date;
        $this->montant = $montant;
    }

    /**
     * id
     * @return int
     */
    public function getId(){
        return $this->id;
    }

    /**
     * id
     * @param int $id
     * @return Lignefraishorsforfait{
     */
    public function setId($id){
        $this->id = $id;
        return $this;
    }

    /**
     * idVisiteur
     * @return string
     */
    public function getIdVisiteur(){
        return $this->idVisiteur;
    }

    /**
     * idVisiteur
     * @param string $idVisiteur
     * @return Lignefraishorsforfait{
     */
    public function setIdVisiteur($idVisiteur){
        $this->idVisiteur = $idVisiteur;
        return $this;
    }

    /**
     * mois
     * @return date(mois)
     */
    public function getMois(){
        return $this->mois;
    }

    /**
     * mois
     * @param date(mois) $mois
     * @return Lignefraishorsforfait{
     */
    public function setMois($mois){
        $this->mois = $mois;
        return $this;
    }

    /**
     * libelle
     * @return string
     */
    public function getLibelle(){
        return $this->libelle;
    }

    /**
     * libelle
     * @param string $libelle
     * @return Lignefraishorsforfait{
     */
    public function setLibelle($libelle){
        $this->libelle = $libelle;
        return $this;
    }

    /**
     * date
     * @return int
     */
    public function getDate(){
        return $this->date;
    }

    /**
     * date
     * @param int $date
     * @return Lignefraishorsforfait{
     */
    public function setDate($date){
        $this->date = $date;
        return $this;
    }

    /**
     * montant
     * @return int
     */
    public function getMontant(){
        return $this->montant;
    }

    /**
     * montant
     * @param int $montant
     * @return Lignefraishorsforfait{
     */
    public function setMontant($montant){
        $this->montant = $montant;
        return $this;
    }

}
?>