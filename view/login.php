
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
            <a class="navbar-brand" href="#pablo">Connexion</a>
        </div>
    </div>
</nav>
<!-- End Navbar -->

<div class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="card mb-3 mx-auto" style="max-width: 50rem; padding-bottom:45px;">
                <div class="card-header ">
                    <h4 class="card-title">Connecter vous !</h4>  
                    <div class="card-body">
                        <form method="post" action="/GsbGreta/index.php/connexion">
                            <div class="column col-12"> 
                                <div class="col-6 mx-auto">
                                    <label for="login">Login</label><input type="text" class="form-control" name="login" id="login" required >
                                </div><br/>
                                <div class="col-6 mx-auto">
                                    <label for="mdp">Mot de passe</label><input type="mdp" class="form-control" name="mdp" id="mdp" required>
                                </div>
                                <?php if ($existe==0){?>
                                    <p style="text-align:center; color:red">login incorrect ou mot de passe<p>
                                <?php }?>

                            </div><br/><br/>
                            <div class="row">
                                <button type="reset" name="effacer" class="btn btn-danger ml-auto">Effacer</button>
                                <button type="submit" name="envoyer" class="btn btn-info mr-auto">Envoyer</button>                                   
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
