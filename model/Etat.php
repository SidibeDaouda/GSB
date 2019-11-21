<?php 
class Etat{
    private $id;
    private $libelle;
    
    public function __construct($id,$libelle) {
        $this->id=$id;
        $this->libelle=$libelle;
    }

    /**
     * id
     * @return
     */
    public function getId(){
        return $this->id;
    }

    /**
     * id
     * @param $id
     * @return Etat{
     */
    public function setId($id){
        $this->id = $id;
        return $this;
    }

    /**
     * libelle
     * @return
     */
    public function getLibelle(){
        return $this->libelle;
    }

    /**
     * libelle
     * @param $libelle
     * @return Etat{
     */
    public function setLibelle($libelle){
        $this->libelle = $libelle;
        return $this;
    }

}
?>