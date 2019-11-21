<div class="wrapper">
<div class="sidebar" data-color="white" data-active-color="danger">
    <div class="logo">
        <div class="logo-image-big">
            <img src="../images/gsb.png">
        </div>
    </div>
    <div class="sidebar-wrapper">
        <ul class="nav">
            <li><a href="/GsbGreta/index.php/nouveau"><i class="nc-icon nc-simple-add"></i> <p>Nouveau</p></a></li>
            <li><a href="/GsbGreta/index.php/consulterFicheFrais"><i class="nc-icon nc-paper"></i><p>Consulter</p></a></li>
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
                <a class="navbar-brand" href="#pablo">Consulter</a>
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
                        <h4 class="card-title">Suivi de remboursement des frais<?php ?></h4>
                    </div>
                    <div class="card-body" id="card-body">
                        <section>
                            <h1 class="card-category">Période</h1>
                            <form method="post" action="/GsbGreta/index.php/consulterFicheFrais" class="row">
                                <div class="ml-auto">
                                    <label>Mois/Année</label>
                                    <select name="anneeMois" class="form-control text-center pb-2" id="anneeMois">
                                        <option selected disabled>Selectionner date</option>
                                    <?php                   
                                        foreach ($moisFicheFrais as $lesMois) {
                                            $mois = $lesMois->getMois();                                
                                            echo "<option value='$mois'>$mois</option>";                                
                                        }
                                    ?>                               
                                    </select>
                                </div>&nbsp;
                                <div class="mr-auto pt-3">
                                    <button type="submit" class="btn btn-info pb-2">Rechercher</button>
                                <div>
                            </form>
                        </section>
                        
                        

                        <?php 
                            if(!empty($_POST["anneeMois"])){
                                            
                                $idVisiteur = $fichefrais->getIdVisiteur();
                                $mois= $fichefrais->getMois();
                                $nbJustificatifs= $fichefrais->getNbJustificatifs();
                                $montantValide= $fichefrais->getMontantValide();
                                $dateModif =$fichefrais->getDateModif();
                                $idEtat= $fichefrais->getIdEtat();
                        ?>
                        <br>
                        <p class="text-center"><?php echo"Votre fiche du : ".$mois?></p>
                        <h1 class="card-category">Frais au forfait</h1>
                        <table class="table table-bordered mx-auto">
                            <thead class=" text-primary">
                                <tr>                                                
                                    <th>Repas midi</th>
                                    <th>Nuitée</th>
                                    <th>Etape</th>
                                    <th>Km</th>
                                    <th>Situation</th>
                                    <th>Date opération</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <?php foreach ($ligneFraisF as $uneLigneFraisF) {
                            
                                    $idFraisForfait= $uneLigneFraisF->getIdFraisForfait();
                                    $quantite = $uneLigneFraisF->getQuantite();
                                    echo"
                                        <td>$quantite</td>
                                        ";
                                    }?>
                                    <td><?php echo $idEtat?></td>
                                    <td><?php echo $dateModif?></td>
                                </tr>
                            </tbody>
                        </table>
                        <br/>

                        <h1 class="card-category">Hors forfait</h1>
                        <table class="table table-bordered mx-auto">
                            <thead class=" text-primary">
                                <tr>                                                
                                    <th>Date</th>
                                    <th>Libellé</th>
                                    <th>Montant</th>
                                    <th>Situation</th>
                                    <th>Date opération</th>
                                </tr>
                            </thead>
                            <tbody>                                        
                                <?php 
                                    foreach ($lignefraisHF as $uneLigneFraisHF) {
                                
                                    $id = $uneLigneFraisHF->getId();
                                    $idVisiteur=$uneLigneFraisHF->getIdVisiteur();
                                    $mois= $uneLigneFraisHF->getMois();
                                    $libelle= $uneLigneFraisHF->getLibelle();
                                    $date= $uneLigneFraisHF->getDate();
                                    $montant=$uneLigneFraisHF->getMontant();
                                    
                                    echo"<tr>
                                        <td>$date</td>
                                        <td>$libelle</td>
                                        <td>$montant</td>
                                        <td>$idEtat</td>
                                        <td>$dateModif</td>
                                        
                                    </tr>";
                                    }
                                ?>                                        
                            </tbody>
                        </table>
                        <br/>

                        <h1 class="card-category">Hors classification</h1>
                        <table class="table table-bordered mx-auto">
                            <thead class=" text-primary">
                                <tr>
                                    <th>Votre ID</th>
                                    <th>date</th>
                                    <th>Nb justificatifs</th>
                                    <th>Montant</th>
                                    <th>Situation</th>
                                    <th>Date opération</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><?php echo $idVisiteur?></td>
                                    <td><?php echo $mois?></td>
                                    <td><?php echo $nbJustificatifs?></td>
                                    <td><?php echo $montantValide?></td>
                                    <td><?php echo $idEtat?></td>
                                    <td><?php echo $dateModif?></td>
                                </tr>
                            </tbody>
                        </table>
                        <?php }?>
                    </div>
                </div>
            </div>
        </div>