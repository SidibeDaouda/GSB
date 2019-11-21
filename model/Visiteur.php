<?php 
class Visiteur{
    
    private $id;
    private $nom;
    private $prenom;
    private $login;
    private $mdp;
    private $adresse;
    private $cp;
    private $ville;
    private $dateEmbauche;
    private $statut;

    public function __construct($id,$nom,$prenom,$login,$mdp,$adresse,$cp,$ville,$dateEmbauche,$statut){
        $this->id=$id;
        $this->nom=$nom;
        $this->prenom=$prenom;
        $this->login=$login;
        $this->mdp=$mdp;
        $this->adresse=$adresse;
        $this->cp=$cp;
        $this->ville=$ville;
        $this->dateEmbauche=$dateEmbauche;
        $this->statut=$statut;  
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
     * @return Visiteur{
     */
    public function setId($id){
        $this->id = $id;
        return $this;
    }

    /**
     * nom
     * @return string
     */
    public function getNom(){
        return $this->nom;
    }

    /**
     * nom
     * @param string $nom
     * @return Visiteur{
     */
    public function setNom($nom){
        $this->nom = $nom;
        return $this;
    }

    /**
     * prenom
     * @return string
     */
    public function getPrenom(){
        return $this->prenom;
    }

    /**
     * prenom
     * @param string $prenom
     * @return Visiteur{
     */
    public function setPrenom($prenom){
        $this->prenom = $prenom;
        return $this;
    }

    /**
     * login
     * @return string
     */
    public function getLogin(){
        return $this->login;
    }

    /**
     * login
     * @param string $login
     * @return Visiteur{
     */
    public function setLogin($login){
        $this->login = $login;
        return $this;
    }

    /**
     * mdp
     * @return string
     */
    public function getMdp(){
        return $this->mdp;
    }

    /**
     * mdp
     * @param string $mdp
     * @return Visiteur{
     */
    public function setMdp($mdp){
        $this->mdp = $mdp;
        return $this;
    }

    /**
     * adresse
     * @return string
     */
    public function getAdresse(){
        return $this->adresse;
    }

    /**
     * adresse
     * @param string $adresse
     * @return Visiteur{
     */
    public function setAdresse($adresse){
        $this->adresse = $adresse;
        return $this;
    }

    /**
     * cp
     * @return int
     */
    public function getCp(){
        return $this->cp;
    }

    /**
     * cp
     * @param int $cp
     * @return Visiteur{
     */
    public function setCp($cp){
        $this->cp = $cp;
        return $this;
    }

    /**
     * ville
     * @return string
     */
    public function getVille(){
        return $this->ville;
    }

    /**
     * ville
     * @param string $ville
     * @return Visiteur{
     */
    public function setVille($ville){
        $this->ville = $ville;
        return $this;
    }

    /**
     * dateEmbauche
     * @return 
     */
    public function getDateEmbauche(){
        return $this->dateEmbauche;
    }

    /**
     * dateEmbauche
     * @param  $dateEmbauche
     * @return Visiteur{
     */
    public function setDateEmbauche($dateEmbauche){
        $this->dateEmbauche = $dateEmbauche;
        return $this;
    }

    /**
     * statut
     * @return string
     */
    public function getStatut(){
        return $this->statut;
    }

    /**
     * statut
     * @param string $statut
     * @return Visiteur{
     */
    public function setStatut($statut){
        $this->statut = $statut;
        return $this;
    }

}
?>