<?php
class FichesFrais
{
    
    private $idVisiteur;
    private $mois;
    private $nbJustificatifs;
    private $montantValide;
    private $dateModif;
    private $idEtat;

    public function __construct($idVisiteur, $mois, $nbJustificatifs, $montantValide, $dateModif, $idEtat)
    {
        $this->idVisiteur = $idVisiteur;
        $this->mois = $mois;
        $this->nbJustificatifs = $nbJustificatifs;
        $this->montantValide = $montantValide;
        $this->dateModif = $dateModif;
        $this->idEtat = $idEtat;
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
     * @return Fichefrais
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
     * @return Fichefrais
     */
    public function setMois($mois){
        $this->mois = $mois;
        return $this;
    }

    /**
     * nbJustificatifs
     * @return int
     */
    public function getNbJustificatifs(){
        return $this->nbJustificatifs;
    }

    /**
     * nbJustificatifs
     * @param int $nbJustificatifs
     * @return Fichefrais
     */
    public function setNbJustificatifs($nbJustificatifs){
        $this->nbJustificatifs = $nbJustificatifs;
        return $this;
    }

    /**
     * montantValide
     * @return int
     */
    public function getMontantValide(){
        return $this->montantValide;
    }

    /**
     * montantValide
     * @param int $montantValide
     * @return Fichefrais
     */
    public function setMontantValide($montantValide){
        $this->montantValide = $montantValide;
        return $this;
    }

    /**
     * dateModif
     * @return date
     */
    public function getDateModif(){
        return $this->dateModif;
    }

    /**
     * dateModif
     * @param date $dateModif
     * @return Fichefrais
     */
    public function setDateModif($dateModif){
        $this->dateModif = $dateModif;
        return $this;
    }

    /**
     * idEtat
     * @return strinf
     */
    public function getIdEtat(){
        return $this->idEtat;
    }

    /**
     * idEtat
     * @param strinf $idEtat
     * @return Fichefrais
     */
    public function setIdEtat($idEtat){
        $this->idEtat = $idEtat;
        return $this;
    }

}
