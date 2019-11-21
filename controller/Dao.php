<?php
class Dao
{
    private static $serveur='mysql:host=localhost';
    private static $bdd='dbname=gsbv2';
    //Pour la securite ne pas utiliser le super-administrateur
    private static $visiteur='root' ;
    private static $mdp='' ;
    private static $monPdo;
    private static $monPdoGsb=null;
    
    /**
     * @return string
     */

    //Pour utiliser le pattern singleton on défini le constructeur comme private
    //COmme cela on ne l'utilise pas dans une autre classe.
    private function __construct()
    {
        Dao::$monPdo = new PDO(Dao::$serveur.';'.Dao::$bdd, Dao::$visiteur, Dao::$mdp);
    }

    //Design pattern singleton
    public static function getPdoGsb()
    {
        //On verifie que la connection n'a pas ete ouverte une premiere fois
        if (Dao::$monPdoGsb==null) {
            Dao::$monPdoGsb= new Dao();
        }
        return Dao::$monPdoGsb;
    }

    public function _destruct()
    {
        Dao::$monPdoGsb = null;
    }

    // pour la connexion
    public function getInfosVisiteur($login1, $mdp1)
    {
        $visiteur=null;
        $req = "select login,mdp,id,nom,prenom,adresse,cp,ville,dateEmbauche from Visiteur
       where login=:login";
        try {
            $res=Dao::$monPdo->prepare($req);
            $res->bindParam(':login', $login1);
            $res->execute();
        } catch (Exception $e) {
            $this->ecrirefichier("Erreur!".$e->getMessage());
        }
        $laLigne = $res->fetch();
        while ($laLigne != null) {
            $login=$laLigne['login'];
            $password= $laLigne['mdp'];
            $id=$laLigne['id'];
            $nom= $laLigne['nom'];
            $prenom= $laLigne['prenom'];
            $adresse= $laLigne['adresse'];
            $cp= $laLigne['cp'];
            $ville= $laLigne['ville'];
            $dateEmbauche= $laLigne['dateEmbauche'];
            $is_match = password_verify($mdp1, $password);
            $laLigne = $res->fetch();
            $visiteur=new
       Visiteur($nom, $prenom, $login, $password, $adresse, $cp, $ville, $dateEmbauche);
            $visiteur->setId($id);
        }
        if (isset($is_match) && ($is_match) &&$login1==$login) {
            return $visiteur;
        }
    }


    // ajouter ligne frais forfait nuit, repas, etape, et km
    public function ajouterLignefraisforfait(array $lignefraisforfait)
    {
        $req = "insert into lignefraisforfait (idVisiteur,mois,idFraisForfait,quantite) values (:idVisiteur,:mois,:idFraisForfait,:quantite)";
        //Le try permet de gerer les exceptions si erreur dans le bloc try, alors catch se declenche.
        try {
            for ($i = 0; $i < sizeof($lignefraisforfait);$i++) {
                $idVisiteur =$lignefraisforfait[$i]->getIdVisiteur();
                $mois=$lignefraisforfait[$i]->getMois();
                $idFraisForfait=$lignefraisforfait[$i]->getIdFraisForfait();
                $quantite=$lignefraisforfait[$i]->getQuantite();

                $stmt=Dao::$monPdo->prepare($req);
                $stmt->bindParam(':idVisiteur', $idVisiteur);
                $stmt->bindParam(':mois', $mois);
                $stmt->bindParam(':idFraisForfait', $idFraisForfait);
                $stmt->bindParam(':quantite', $quantite);
                $stmt->execute();
            }
        } catch (Exception $e) {
            echo "Erreur!".$e->getMessage();
        }
    }

    // ajouter les lignes hors frait forfait
    public function ajouterLignefraisHorsforfait(Lignefraishorsforfait $lignefraisHF)
    {
        $idVisiteur =$lignefraisHF->getIdVisiteur();
        $mois=$lignefraisHF->getMois();
        $libelle=$lignefraisHF->getLibelle();
        $date=$lignefraisHF->getDate();
        $montant=$lignefraisHF->getMontant();
        $req = "insert into lignefraishorsforfait(idVisiteur,mois,libelle,date,montant) values (:idVisiteur,:mois,:libelle,:date,:montant)";
        //Le try permet de gerer les exceptions si erreur dans le bloc try, alors catch se declenche.
        try {
            $stmt=Dao::$monPdo->prepare($req);
            $stmt->bindParam(':idVisiteur', $idVisiteur);
            $stmt->bindParam(':mois', $mois);
            $stmt->bindParam(':libelle', $libelle);
            $stmt->bindParam(':date', $date);
            $stmt->bindParam(':montant', $montant);
            $stmt->execute();
        } catch (Exception $e) {
            echo "Erreur!".$e->getMessage();
        }
    }

    // ajouter les fiche frait
    public function ajouterFichefrais(FichesFrais $fichefrais)
    {
        $idVisiteur =$fichefrais->getIdVisiteur();
        $mois=$fichefrais->getMois();
        $nbJustificatifs=$fichefrais->getNbJustificatifs();
        $montantValide=$fichefrais->getMontantValide();
        $dateModif=$fichefrais->getDateModif();
        $idEtat=$fichefrais->getIdEtat();
        $req = "insert into fichefrais (idVisiteur, mois, nbJustificatifs,montantValide,dateModif,idEtat) values (:idVisiteur, :mois, :nbJustificatifs,:montantValide,:dateModif,:idEtat)";
        //Le try permet de gerer les exceptions si erreur dans le bloc try, alors catch se declenche.
        try {
            $stmt=Dao::$monPdo->prepare($req);
            $stmt->bindParam(':idVisiteur', $idVisiteur);
            $stmt->bindParam(':mois', $mois);
            $stmt->bindParam(':nbJustificatifs', $nbJustificatifs);
            $stmt->bindParam(':montantValide', $montantValide);
            $stmt->bindParam(':dateModif', $dateModif);
            $stmt->bindParam(':idEtat', $idEtat);
            $stmt->execute();
        } catch (Exception $e) {
            echo "Erreur!".$e->getMessage();
        }
    }

    public function afficherFicheFraisByVisiteur($idVisiteur)
    {
        $ficheFrais=null;
        $liste=array();
        $req = "select * FROM fichefrais WHERE idVisiteur ='$idVisiteur' order by mois desc";
        $stmt = Dao::$monPdo->prepare($req);
        $res=$stmt->execute();
        while ($laLigne = $stmt->fetch(PDO::FETCH_NUM, PDO::FETCH_ORI_NEXT)) {
            $idVisiteur=$laLigne[0];
            $mois= $laLigne[1];
            $nbJustificatifs= $laLigne[2];
            $montantValide= $laLigne[3];
            $dateModif =$laLigne[4];
            $idEtat= $laLigne[5];
            $ficheFrais = new FichesFrais($idVisiteur, $mois, $nbJustificatifs, $montantValide, $dateModif, $idEtat);
            $ficheFrais->setIdVisiteur($idVisiteur);
            $liste[]=$ficheFrais;
        }
        return $liste;
    }


    public function afficherFicheFraisByIdMois($mois, $idVisiteur)
    {
        $ficheFrais=null;
        $req = "select * FROM fichefrais WHERE mois = '$mois' and idVisiteur = '$idVisiteur'";
        $stmt = Dao::$monPdo->prepare($req);
        $res=$stmt->execute();
        while ($laLigne = $stmt->fetch(PDO::FETCH_NUM, PDO::FETCH_ORI_NEXT)) {
            $idVisiteur=$laLigne[0];
            $mois= $laLigne[1];
            $nbJustificatifs= $laLigne[2];
            $montantValide= $laLigne[3];
            $dateModif =$laLigne[4];
            $idEtat= $laLigne[5];
            $ficheFrais = new FichesFrais($idVisiteur, $mois, $nbJustificatifs, $montantValide, $dateModif, $idEtat);
            $ficheFrais->setIdVisiteur($idVisiteur);
        }
        return $ficheFrais;
    }

    public function afficherLigneFraisFt($mois, $idVisiteur)
    {
        $lignefraisforfait=null;
        $liste=array();
        $req = "select * FROM lignefraisforfait where idVisiteur =:idVisiteur and mois =:mois";
        try {
            $stmt=Dao::$monPdo->prepare($req);
            $stmt->bindParam(':idVisiteur', $idVisiteur);
            $stmt->bindParam(':mois', $mois);
            $stmt->execute();
        } catch (Exception $e) {
            echo "Erreur!".$e->getMessage();
        }

        while ($laLigne = $stmt->fetch(PDO::FETCH_NUM, PDO::FETCH_ORI_NEXT)) {
            $idVisiteur=$laLigne[0];
            $mois= $laLigne[1];
            $idFraisForfait= $laLigne[2];
            $quantite= $laLigne[3];
            $lignefraisforfait = new Lignefraisforfait($idVisiteur, $mois, $idFraisForfait, $quantite);
            $lignefraisforfait->setIdVisiteur($idVisiteur);
            $liste[]=$lignefraisforfait;
        }
        return $liste;
    }

    public function afficherLigneFraisHorsForfait($mois, $idVisiteur)
    {
        $lignefraishorsforfait=null;
        $liste=array();
        $req = "select * FROM lignefraishorsforfait where idVisiteur =:idVisiteur and mois =:mois";
        try {
            $stmt=Dao::$monPdo->prepare($req);
            $stmt->bindParam(':idVisiteur', $idVisiteur);
            $stmt->bindParam(':mois', $mois);
            $stmt->execute();
        } catch (Exception $e) {
            echo "Erreur!".$e->getMessage();
        }

        while ($laLigne = $stmt->fetch(PDO::FETCH_NUM, PDO::FETCH_ORI_NEXT)) {
            $id = $laLigne[0];
            $idVisiteur=$laLigne[1];
            $mois= $laLigne[2];
            $libelle= $laLigne[3];
            $date= $laLigne[4];
            $montant= $laLigne[5];
            $lignefraisforfait = new Lignefraishorsforfait($idVisiteur, $mois, $libelle, $date, $montant);
            $lignefraisforfait->setIdVisiteur($idVisiteur);
            $lignefraisforfait->setId($id);
            $liste[]=$lignefraisforfait;
        }
        return $liste;
    }

    // me retourne la liste des visiteur
    public function getLesVisiteurs()
    {
        $liste=array();
        $req = "select * from visiteur";
        $stmt = Dao::$monPdo->prepare($req);
        $res=$stmt->execute();
        while ($laLigne = $stmt->fetch(PDO::FETCH_NUM, PDO::FETCH_ORI_NEXT)) {
            $id = $laLigne[0];
            $nom = $laLigne[1];
            $prenom = $laLigne[2];
            $login = $laLigne[3];
            $mdp = $laLigne[4];
            $adresse = $laLigne[5];
            $cp = $laLigne[6];
            $ville = $laLigne[7];
            $dateEmbauche = $laLigne[8];
            $statut = $laLigne[9];
            $visiteur=new Visiteur($id, $nom, $prenom, $login, $mdp, $adresse, $cp, $ville, $dateEmbauche, $statut);
            $visiteur->setId($id);
            $visiteur->setNom($nom);
            $liste[]=$visiteur;
        }
        return $liste;
    }

    public function majFiche(array $lignefraisforfait, array $lignefraisHF, FichesFrais $fichefrais)
    {
        // pour la Fiche frais car elle correponds a une seule ligne
        $idVisiteur =$fichefrais->getIdVisiteur();
        $mois=$fichefrais->getMois();
        $nbJustificatifs=$fichefrais->getNbJustificatifs();
        $montantValide=$fichefrais->getMontantValide();
        $dateModif=$fichefrais->getDateModif();
        $idEtat=$fichefrais->getIdEtat();

        $req1= "update lignefraisforfait set quantite = :quantite where idVisiteur = :idVisiteur and mois = :mois and idFraisForfait = :idFraisForfait";
        $req2 = "update lignefraishorsforfait set libelle = :libelle ,date = :date, montant = :montant where idVisiteur = :idVisiteur and libelle = :libelle and mois=:mois";
        $req3 = "update fichefrais set nbJustificatifs = :nbJustificatifs, montantValide = :montantValide, dateModif = :dateModif, idEtat = :idEtat where mois = :mois and idVisiteur = :idVisiteur";
        //Le try permet de gerer les exceptions si erreur dans le bloc try, alors catch se declenche.
        try {
            Dao::$monPdo->beginTransaction();            
            for ($i = 0; $i < sizeof($lignefraisforfait);$i++) {
                $idVisiteur =$lignefraisforfait[$i]->getIdVisiteur();
                $mois=$lignefraisforfait[$i]->getMois();
                $idFraisForfait=$lignefraisforfait[$i]->getIdFraisForfait();
                $quantite=$lignefraisforfait[$i]->getQuantite();

                $stmt1=Dao::$monPdo->prepare($req1);
                $stmt1->bindParam(':idVisiteur', $idVisiteur);
                $stmt1->bindParam(':mois', $mois);
                $stmt1->bindParam(':idFraisForfait', $idFraisForfait);
                $stmt1->bindParam(':quantite', $quantite);
                if (!$stmt1->execute()) {
                    throw new PDOexception("erreur requete 1");
                }
            }
            for ($i=0; $i < sizeof($lignefraisHF); $i++) {
                $idVisiteur =$lignefraisHF[$i]->getIdVisiteur();
                $mois=$lignefraisHF[$i]->getMois();
                $libelle=$lignefraisHF[$i]->getLibelle();
                $date=$lignefraisHF[$i]->getDate();
                $montant=$lignefraisHF[$i]->getMontant();

                $stmt2=Dao::$monPdo->prepare($req2);
                $stmt2->bindParam(':idVisiteur', $idVisiteur);
                $stmt2->bindParam(':mois', $mois);
                $stmt2->bindParam(':libelle', $libelle);
                $stmt2->bindParam(':date', $date);
                $stmt2->bindParam(':montant', $montant);
                if (!$stmt2->execute()) {
                    throw new PDOexception("erreur requete 2");
                }
            }
            $stmt3=Dao::$monPdo->prepare($req3);
            $stmt3->bindParam(':idVisiteur', $idVisiteur);
            $stmt3->bindParam(':mois', $mois);
            $stmt3->bindParam(':nbJustificatifs', $nbJustificatifs);
            $stmt3->bindParam(':montantValide', $montantValide);
            $stmt3->bindParam(':dateModif', $dateModif);
            $stmt3->bindParam(':idEtat', $idEtat);
            if (!$stmt3->execute()) {
                throw new PDOexception("erreur requete 3");
            }
            //on valide les transaction
            Dao::$monPdo->commit();
        } catch (Exception $e) {
            echo "Erreur!".$e->getMessage();
            Dao::$monPdo->rollback();
        }
    }


    //  public function getLesVisiteursById($id){

//     $req = "select * from visiteur where id = :id";
//     try {
//         $stmt=Dao::$monPdo->prepare($req);
//         $stmt->bindParam(':id', $id);
//         $stmt->execute();
//     } catch (Exception $e) {
//         echo "Erreur!".$e->getMessage();
//     }
//     $stmt = Dao::$monPdo->prepare($req);
//     $res=$stmt->execute();
//     while ($laLigne = $stmt->fetch(PDO::FETCH_NUM, PDO::FETCH_ORI_NEXT)) {
//         $id = $laLigne[0];
//         $nom = $laLigne[1];
//         $prenom = $laLigne[2];
//         $login = $laLigne[3];
//         $mdp = $laLigne[4];
//         $adresse = $laLigne[5];
//         $cp = $laLigne[6];
//         $ville = $laLigne[7];
//         $dateEmbauche = $laLigne[8];
//         $statut = $laLigne[9];
//         $visiteur=new Visiteur($id, $nom, $prenom, $login, $mdp, $adresse, $cp, $ville, $dateEmbauche, $statut);
//         $visiteur->setId($id);
//         $visiteur->setNom($nom);
//     }
//     return $visiteur;
    // }


    public function log($chaine)
    {
        $monfichier = fopen('compteur.txt', '+');
        fputs($monfichier, $chaine);
        fclose($monfichier);
    }
}
