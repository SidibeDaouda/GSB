<?
class Fraisforfait
{
    private $id;
    private $libelle;
    private $montant;

    public function __construct($id, $libelle, $montant)
    {
        $this->$id = $$id;
        $this->libelle = $libelle;
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
     * @return Fraisforfait
     */
    public function setId($id){
        $this->id = $id;
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
     * @return Fraisforfait
     */
    public function setLibelle($libelle){
        $this->libelle = $libelle;
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
     * @return Fraisforfait
     */
    public function setMontant($montant){
        $this->montant = $montant;
        return $this;
    }

}

?>