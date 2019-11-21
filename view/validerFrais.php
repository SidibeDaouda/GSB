
    <div class="wrapper">
        <div class="sidebar" data-color="white" data-active-color="danger">
            <div class="logo">
                <div class="logo-image-big">
                    <img src="../images/gsb.png">
                </div>
            </div>
            <div class="sidebar-wrapper">
                <ul class="nav">
                    <li><a href="/GsbGreta/index.php/voirFicheFraisComptable"><i class="nc-icon nc-check-2"></i> <p>Enregistrer</p></a></li>
                    <li><a href="/GsbGreta/index.php/operation"><i class="nc-icon nc-ruler-pencil"></i><p>Opération</p></a></li>
                </ul>
            </div>
        </div>
        <div class="main-panel">
            <!-- Navbar -->
            <nav class="navbar navbar-expand-lg navbar-absolute fixed-top navbar-transparent">
                <div class="container-fluid">
                    <div class="navbar-wrapper">
                        <div class="navbar-toggle">
                            <button type="button" class="navbar-toggler">
                                <span class="navbar-toggler-bar bar1"></span>
                                <span class="navbar-toggler-bar bar2"></span>
                                <span class="navbar-toggler-bar bar3"></span>
                            </button>
                        </div>
                        <a class="navbar-brand" href="#pablo">Validation des frais</a>
                    </div>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-bar navbar-kebab"></span>
                        <span class="navbar-toggler-bar navbar-kebab"></span>
                        <span class="navbar-toggler-bar navbar-kebab"></span>
                    </button>
                    <div class="collapse navbar-collapse justify-content-end" id="navigation">
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a class="nav-link btn-rotate" href="/GsbGreta/index.php/deconnexion">
                                    <p><span class="d-lg-none d-md-block"></span></p><i class="nc-icon nc-button-power"></i> Déconnexion </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
            <!-- End Navbar -->
            <div class="content">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card ">
                            <div class="card-header ">
                                <h4 class="card-title">Validation des frais par visiteur</h4>
                            </div>
                            <div class="card-body ">
                                <form action="/GsbGreta/index.php/voirFicheFraisComptable" method="post">
                                    <div class="mx-auto form-row col-12">
                                        <div class="col-3 ml-auto">
                                            <label for="visiteur">Choisir le visiteur</label>
                                            <select name="visiteur" class="form-control" id="fichefraisVisiteur" required>
                                            <option value="" disabled selected>selectionner le visiteur</option>
                                            <?php 
                                                foreach($lesVisiteurs as $visiteur){
                                                    $idVisiteur = $visiteur->getId();
                                                    $nomVisiteur = $visiteur->getNom();
                                                    $prenomVisiteur = $visiteur->getPrenom();
                                                    
                                                    echo"<option value='$idVisiteur'>$nomVisiteur $prenomVisiteur</option>";
                                                }
                                            ?>
                                            </select>
                                        </div>
                                        <div class="col-3 mr-auto">
                                            <label for="moisAnneeFiche">Date</label>
                                            <input type="text" id="moisAnneeFiche" name=moisAnneeFiche class="form-control text-center pt-2 pb-2" placeholder="exemple : 6-2019" maxlength="6" minlength="6" required>
                                        </div>

                                    </div>
                                    <div class="col-2 pt-3 mx-auto">
                                        <button type="submit" id="btn222" class="btn btn-info btn-sm pt-2 pb-2">Rechercher</button>
                                    </div>
                                </form>
                                
                                <form action="/GsbGreta/index.php/majFiche" method="POST">
                                    <?php 
                                        if(!empty($_POST["moisAnneeFiche"])){
                                            if($fichefrais != null){
                                            $idVisiteur = $fichefrais->getIdVisiteur();
                                            $mois= $fichefrais->getMois();
                                            $nbJustificatifs= $fichefrais->getNbJustificatifs();
                                            $montantValide= $fichefrais->getMontantValide();
                                            $dateModif =$fichefrais->getDateModif();
                                            $idEtat= $fichefrais->getIdEtat();
                                                                                        
                                    ?>
                                    
                                        <p class="text-center pt-2">ID Visiteur : <?php echo $idVisiteur //." ".$prenomVisiteur1." ".$nomVisiteur1;?></p>
                                        
                                        <h1 class="card-category">Frais au forfait</h1>

                                        <input type="hidden" name="idVisiteur" value="<?php echo $idVisiteur;?>">
                                        <input type="hidden" name="mois" value="<?php echo $mois;?>">

                                        <table class="table table-bordered mx-auto">
                                            <thead class=" text-primary">
                                                <tr>                                                
                                                    <th>Repas midi</th>
                                                    <th>Nuitée</th>
                                                    <th>Etape</th>
                                                    <th>Km</th>
                                                    <th>Situation</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                <?php foreach ($ligneFraisF as $uneLigneFraisF) {
                            
                                                $idFraisForfait= $uneLigneFraisF->getIdFraisForfait();
                                                $quantite = $uneLigneFraisF->getQuantite();
                                                echo"
                                                    <td><input type='text' name='quantite[]' value='$quantite'></td>
                                                    ";
                                                }?>
                                                    <td>                                                       
                                                        <input type="text" value="<?php echo $idEtat;?>">
                                                    </td> 
                                                </tr>
                                            </tbody>
                                        </table>
                                        <br></br>

                                        <h1 class="card-category">Hors forfait</h1>
                                        <table class="table table-bordered mx-auto">
                                            <thead class=" text-primary">
                                                <tr>                                                
                                                    <th>Date</th>
                                                    <th>Libellé</th>
                                                    <th>Montant</th>
                                                    <th>Situation</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                <?php 
                                                    foreach ($lignefraisHF as $uneLigneFraisHF) {
                                                
                                                    $id = $uneLigneFraisHF->getId();
                                                    $idVisiteur=$uneLigneFraisHF->getIdVisiteur();
                                                    $mois= $uneLigneFraisHF->getMois();
                                                    $libelle= $uneLigneFraisHF->getLibelle();
                                                    $date= $uneLigneFraisHF->getDate();
                                                    $montant=$uneLigneFraisHF->getMontant();
                                                ?>                                                    
                                                   <tr>
                                                        <td><input type="text" name="dateligneFraisHF[]" value="<?php echo $date ?>"></td>
                                                        <td><input type="text" name="libelleLigneFH[]" value="<?php echo $libelle ?>"></td>
                                                        <td><input type="text" name="montantLigneFH[]" value="<?php echo $montant ?>"></td>
                                                        <td><input type="text" value="<?php echo $idEtat;?>"></td>
                                                        <input type="hidden" name="idLignefraisHF" value="<?php echo $id;?>" >
                                                    </tr>
                                                <?php }?>
                                                </tr>
                                            </tbody>
                                        </table>
                                        </br><br>

                                        <h1 class="card-category">Hors classification</h1>
                                        <table class="table table-bordered mx-auto">
                                            <thead class=" text-primary">
                                                <tr>                                                
                                                    <th>Nb justificatifs</th>
                                                    <th>Montant Total</th>
                                                    <th>Situation</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td><input type="text" name="nbjustificatifs" value="<?php echo $nbJustificatifs;?>"></td>
                                                    <td><input type="text" name="montantValide" value="<?php echo $montantValide;?>"></td>
                                                    <td>
                                                        <input type="text" name="situation" value="<?php echo $idEtat;?>">
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        
                                        <div class="row">
                                            <button type="reset" class="btn btn-danger ml-auto">Ancienne valeur</button>
                                            <button type="submit" class="btn btn-info mr-auto">Enregistrer</button>                                   
                                        </div>
                                    </form> 
                                    <?php }
                                    else{
                                        echo '<p class="text-center pt-2">Aucune fiche n\'a été saisie au  '.$mois.' pour le visiteur : '.$_POST["visiteur"].'</p>';
                                    }
                                }?>
                                                              
                            </div>
                        </div>
                    </div>
                </div>
