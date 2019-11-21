<?php
class Lignefraisforfait{

    private $idVisiteur;
    private $mois;
    private $idFraisForfait;
    private $quantite;

    public function __construct($idVisiteur, $mois, $idFraisForfait, $quantite)
    {
        $this->idVisiteur = $idVisiteur;
        $this->mois = $mois;
        $this->idFraisForfait = $idFraisForfait;
        $this->quantite = $quantite;
    }

    /**
     * idVisiteur
     * @return String
     */
    public function getIdVisiteur(){
        return $this->idVisiteur;
    }

    /**
     * idVisiteur
     * @param String $idVisiteur
     * @return Lignefraisforfait{
     */
    public function setIdVisiteur($idVisiteur){
        $this->idVisiteur = $idVisiteur;
        return $this;
    }

    /**
     * mois
     * @return date
     */
    public function getMois(){
        return $this->mois;
    }

    /**
     * mois
     * @param date $mois
     * @return Lignefraisforfait{
     */
    public function setMois($mois){
        $this->mois = $mois;
        return $this;
    }

    /**
     * idFraisForfait
     * @return int
     */
    public function getIdFraisForfait(){
        return $this->idFraisForfait;
    }

    /**
     * idFraisForfait
     * @param int $idFraisForfait
     * @return Lignefraisforfait{
     */
    public function setIdFraisForfait($idFraisForfait){
        $this->idFraisForfait = $idFraisForfait;
        return $this;
    }

    /**
     * quantite
     * @return int
     */
    public function getQuantite(){
        return $this->quantite;
    }

    /**
     * quantite
     * @param int $quantite
     * @return Lignefraisforfait{
     */
    public function setQuantite($quantite){
        $this->quantite = $quantite;
        return $this;
    }

}
?>