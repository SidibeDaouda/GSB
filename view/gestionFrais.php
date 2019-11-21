
    
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
                        <a class="navbar-brand">Gestion des frais</a>
                    </div>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-bar navbar-kebab"></span>
                        <span class="navbar-toggler-bar navbar-kebab"></span>
                        <span class="navbar-toggler-bar navbar-kebab"></span>
                    </button>
                    <div class="collapse navbar-collapse justify-content-end" id="navigation">
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a class="nav-link btn-rotate" href="/GsbGreta/index.php/deconnexion"><p><span class="d-lg-none d-md-block"></span></p><i class="nc-icon nc-button-power"></i> Déconnexion </a>
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
                                <h4 class="card-title">Saisie</h4>                               
                            </div>
                            <div class="card-body">

                            <form method="post" action="/GsbGreta/index.php/ajouterFrais">
                                <h1 class="card-category">Periode d'engagement</h1>
                                
                                <div class="row col-12">
                                    <table class="mx-auto">
                                        <tr>
                                            <td><label for="mois">Date</label></td>
                                        </tr>  
                                        <tr>  
                                            <td><input type="text" class="form-control" name="mois" id="mois" style="text-align:center;" ></td>
                                        </tr>  
                                    </table>
                                </div><br/>

                                <h1 class="card-category">Frais au forfait</h1>
                                <div class="row col-12">                                   
                                    <table class="col-6 mx-auto">
                                        <tr>
                                            <td><label for="repasmidi">Repas midi</label></td>
                                            <td><label for="nuitees">Nuitées</label></td>
                                            <td><label for="etape">Etape</label></td>
                                            <td><label for="km">Kilomètre</label></td>
                                        </tr>  
                                        <tr>  
                                            <td><input type="number" min="0" class="form-control" name="repasmidi" id="repasmidi"></td>
                                            <td><input type="number" min="0" class="form-control" name="nuitees" id="nuitees"></td>
                                            <td><input type="number" min="0" class="form-control" name="etape" id="etape"></td>
                                            <td><input type="number" min="0" class="form-control" name="km" id="km"></td>
                                        </tr>  
                                    </table>
                                </div><br/>

                                <h1 class="card-category">Hors forfait</h1>                          
                                <div class="form-group">  
                                <!-- <div class="table-responsive">   -->
                                    <table class="mx-auto" id="fraisHF">  
                                            <tr>  
                                                <td><input type="date" name="laDate[]" class="form-control name_list" /></td>
                                                <td><input type="text" name="libelle[]" placeholder="Libelle" class="form-control name_list" /></td>  
                                                <td><input type="number" name="montant[]" placeholder="Montant" min="0" class="form-control name_list" /></td>
                                                <td><button type="button" name="add" id="add" class="btn btn-success">+</button></td>  
                                            </tr>  
                                    </table>  
                                <!-- </div>   -->
                                </div>  
                                   
                                <h1 class="card-category">Hors classification</h1>
                                <div class="row col-12">
                                    <table class="mx-auto">
                                        <tr>
                                            <td><label for="nbJustificatifs">Nombre justificatifs</label></td>
                                            <td><label for="montantTotal">Montant total</label></td>
                                        </tr>  
                                        <tr>  
                                            <td><input type="number" min="0" class="form-control" name="nbJustificatifs" id="nbJustificatifs"></td>
                                            <td><input type="number" min="0" class="form-control" name="montantTotal" id="montantTotal"></td>
                                        </tr>  
                                    </table>
                                </div><br/>

                                <div class="row">
                                    <button type="reset" name="effacer" class="btn btn-danger ml-auto">Effacer</button>
                                    <button type="submit" name="envoyer" class="btn btn-info mr-auto">Envoyer</button>                                   
                                </div>
                            </form>

                            </div>
                        </div>
                    </div>
                </div>