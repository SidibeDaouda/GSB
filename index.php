<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8" />
    <link rel="apple-toactionh-icon" sizes="76x76" href="/GsbGreta/assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="/GsbGreta/assets/img/favicon.png">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>GSB</title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, visiteur-scalable=0, shrink-to-fit=no' name='viewport' />
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />   -->
    <!-- CSS Files -->
    <link href="/GsbGreta/assets/css/bootstrap.min.css" rel="stylesheet" />
    <link href="/GsbGreta/assets/css/paper-dashboard.css?v=2.0.0" rel="stylesheet" />
</head>

<body onload="getAnnee()">
    
    <div class="wrapper">
        <div class="sidebar" data-color="white" data-active-color="danger">
            <div class="logo">
                <div class="logo-image-big">
                    <img src="/GsbGreta/images/gsb.png">
                </div>
            </div>
        </div>

        <?php
            //Demarrage de session permet de passer des variables dans des superglobales d'une page a l'autre
            session_start();
            // require("model/Visiteur.php");
            require("autoloader.php");
            require("controller/Dao.php");

            //verifie la connexion a la bdd
            $dao=Dao::getPdoGsb();

            //action (attribut qu'on mettra dans nos liens pour qu'on puisse recuperer ce que l'on veut)
            // on va recuprer dans le switch le action connexion qi va nous mener sur la page de connexion
            $action = explode ("/",parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
            $action=end($action);
            $existe=1;

            if(empty($action)){
                $action = "index.php";
            }

            // On recupere le action dans le lien des Vue
            switch ($action) {
                case 'index.php':{
                    $existe=1;
                    include("view/login.php");
                    break;
                }

                case 'connexion':{
                    $dao=Dao::getPdoGsb();
                    $login=$_POST["login"];
                    $mdp=$_POST["mdp"];
                    $visiteur=$dao->getInfosVsiteur($login, $mdp);
                   
                    if ($visiteur!=null) {
                        //on stock l'id utilisateur et le statut pour le recuperer a fin de le traiter ulterieurement
                        $_SESSION["idVisiteur"]=$visiteur->getId();
                        $statut = $_SESSION["statut"]=$visiteur->getStatut();
                        if($statut == "visiteur"){
                            include("view/gestionFrais.php");
                        }else {
                            $lesVisiteurs = $dao->getLesVisiteurs();
                            include("view/validerFrais.php");
                        }
                    } else {
                        $existe=0;
                        include("view/login.php");
                    }
                    break;
                }

                //visiteur redirecrtion des menus
                case "nouveau":{
                    include("view/gestionFrais.php");
                    break;
                }
                case "consulterFicheFrais":{
                    $idVisiteur = $_SESSION["idVisiteur"];
                    $moisFicheFrais = $dao->afficherFicheFraisByVisiteur($idVisiteur);

                    if(isset($_POST["anneeMois"])){
                        $mois = $_POST["anneeMois"];
                        $fichefrais = $dao->afficherFicheFraisByIdMois($mois,$idVisiteur);
                        $ligneFraisF = $dao->afficherLigneFraisFt($mois,$idVisiteur);                        
                        $lignefraisHF = $dao->afficherLigneFraisHorsForfait($mois,$idVisiteur);
                    }
                    include("view/consulter.php");                    
                    break;
                }
                //comptable redirecrtion des menus
                case "voirFicheFraisComptable":{   
                    $lesVisiteurs = $dao->getLesVisiteurs();

                    if(isset($_POST["moisAnneeFiche"]) && isset($_POST["visiteur"])){
                        $mois = $_POST["moisAnneeFiche"];
                        $idVisiteur = $_POST["visiteur"];

                        // $prenomVisiteur1 = $_POST["prenomVisiteur"];
                        // $nomVisiteur1 = $_GET["nomVisiteur"];

                        $fichefrais = $dao->afficherFicheFraisByIdMois($mois,$idVisiteur);                       
                        $ligneFraisF = $dao->afficherLigneFraisFt($mois,$idVisiteur);                        
                        $lignefraisHF = $dao->afficherLigneFraisHorsForfait($mois,$idVisiteur);
                    }

                    include("view/validerFrais.php");
                    break;
                }

                case "majFiche":{
                    $idVisiteur = $_POST["idVisiteur"];
                    $mois = $_POST["mois"];
                    //ligne frais forfait
                    $ligneFraisFQuantites = $_POST["quantite"];
                    $idLignefraisHF = $_POST['idLignefraisHF'];
                   
                    //hors classification
                    $nbjustificatifs = $_POST["nbjustificatifs"];
                    $montantValide = $_POST["montantValide"];
                    $idEtat = $_POST["situation"];
                    $dateModif = Date ("Y-m-d");

                    $tab= array();
                    $etape = new Lignefraisforfait($idVisiteur,$mois,"ETP",$ligneFraisFQuantites[0]);
                    $km = new Lignefraisforfait($idVisiteur,$mois,"KM",$ligneFraisFQuantites[1]);                   
                    $nuit = new Lignefraisforfait($idVisiteur,$mois,"NUI",$ligneFraisFQuantites[2]);
                    $repas = new Lignefraisforfait($idVisiteur,$mois,"REP",$ligneFraisFQuantites[3]);
                    
                    $tab[]= $repas;
                    $tab[]= $nuit;
                    $tab[]= $etape;
                    $tab[]= $km;

                    
                    //ligne frais hors forfait
                    $dateligneFraisHF = $_POST["dateligneFraisHF"];
                    $libelleLigneFH = $_POST["libelleLigneFH"];
                    $montantLigneFH = $_POST["montantLigneFH"];
                    $lignefraisHF =null;
                    for ($i=0; $i <sizeof($dateligneFraisHF); $i++) { 
                        $lignefraisHF[] = new Lignefraishorsforfait($idVisiteur, $mois, $libelleLigneFH[$i], $dateligneFraisHF[$i], $montantLigneFH[$i]);
                    }
                   
                    $ficheFrais = new FichesFrais ($idVisiteur, $mois, $nbjustificatifs, $montantValide, $dateModif, $idEtat);

                    $dao->majFiche($tab, $lignefraisHF,$ficheFrais );
                    
                    $lesVisiteurs = $dao->getLesVisiteurs();
                    include("view/validerFrais.php");
                    break;
                }
                case "operation":{
                    include("view/operation.php");
                    break;
                }
                // deconnexion
                case "deconnexion":{
                    function deconnecter(){
                        session_destroy();
                    }
                    deconnecter();
                    include("view/login.php");
                    break;
                }

                case"ajouterFrais":{                    
                    $idVisiteur = $_SESSION["idVisiteur"];
                    $mois = $_POST["mois"];
                    //frais au forfait
                    $repasQte = $_POST["repasmidi"];
                    $nuiteesQte = $_POST["nuitees"];
                    $etapeQte = $_POST["etape"];
                    $nbKm = $_POST["km"];
         
                    //hors classification
                    $nbJustificatifs = $_POST["nbJustificatifs"];
                    $montantValide = $_POST["montantTotal"];
                    $dateModif = Date ("Y-m-d");
                    $idEtat = "CR";

                    $dao=Dao::getPdoGsb();
                    //frais au Forfait
                    $tab= array();
                    $repas = new Lignefraisforfait($idVisiteur,$mois,"REP",$repasQte);                   
                    $nuit = new Lignefraisforfait($idVisiteur,$mois,"NUI",$nuiteesQte);
                    $etape = new Lignefraisforfait($idVisiteur,$mois,"ETP",$etapeQte);
                    $km = new Lignefraisforfait($idVisiteur,$mois,"KM",$nbKm);
                    
                    $tab[]= $repas;
                    $tab[]= $nuit;
                    $tab[]= $etape;
                    $tab[]= $km;

                    $dao->ajouterLignefraisforfait($tab);

                    // frais HF
                    $number = count($_POST["laDate"]);  
                    if($number > 0)
                    {
                        for($i=0; $i<$number; $i++)
                        {
                            //frais hors forfait
                            $laDate = $_POST["laDate"][$i];
                            $libelle = $_POST["libelle"][$i];
                            $montant = $_POST["montant"][$i];
                            $fraisHF = new Lignefraishorsforfait($idVisiteur, $mois, $libelle, $laDate, $montant);
                            $dao->ajouterLignefraisHorsforfait($fraisHF);
                        }
                    }

                    // ajouter la fiche frais
                    $enregistrerFicheFrais = new FichesFrais ($idVisiteur, $mois, $nbJustificatifs, $montantValide, $dateModif, $idEtat);
                    $dao->ajouterFichefrais($enregistrerFicheFrais);

                    include("view/gestionFrais.php");
                    break;
                }

            }
        ?>
            <footer class='footer footer-default'>
                <div class='container text-center'>
                    &copy;
                    <script>
                        document.write(new Date().getFullYear())
                    </script>
                    by Daouda
                </div>
            </footer>

    </div>
    <!--   Core JS Files   -->
    <script src="/GsbGreta/assets/js/core/jquery.min.js"></script>
    <script src="/GsbGreta/assets/js/core/popper.min.js"></script>
    <script src="/GsbGreta/assets/js/core/bootstrap.min.js"></script>
    <script src="/GsbGreta/assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
    <!--  Google Maps Plugin    -->
    <!-- <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script> -->
    <!-- Chart JS -->
    <script src="/GsbGreta/assets/js/plugins/chartjs.min.js"></script>
    <!--  Notifications Plugin    -->
    <script src="/GsbGreta/assets/js/plugins/bootstrap-notify.js"></script>
    <!-- Control Center for Now Ui Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="/GsbGreta/assets/js/paper-dashboard.min.js?v=2.0.0" type="text/javascript"></script>

    <!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>   -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <!-- mes scripts -->
    <script src="/GsbGreta/js/script.js" type="text/javascript"></script>
</body>
</html>