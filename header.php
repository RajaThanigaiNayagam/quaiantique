<?php 
    session_start();      //demarrage du session d'un utilisateur admin/clinet
    error_reporting(0);   //Désactiver tous les rapports d'erreurs
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <link rel="icon" type="image/png" sizes="32x32" href="img/favicon-32x32.png">    <!--favicon-->
        <title>Quai Antique</title>
        <meta charset="utf-8">
        
        <!-- -------------------------- To display in the search engine ------------------------- -->
        <meta name=”description” content="Restaurant Quai Antique" />

        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="css/style.css" rel="stylesheet" type="text/css">     <!--style.css document-->
        <link href="css/font-awesome.css" rel="stylesheet">     <!--font-awesome-->
        
        <!-- -------------------------appel POLICE RANCHO------------------------------ -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Lora:wght@400;500;600&family=Montserrat:ital,wght@0,500;0,600;0,700;0,900;1,500;1,600&family=Petit+Formal+Script&family=Rancho&family=Taviraj:ital,wght@0,300;0,400;0,500;0,600;1,300&display=swap" rel="stylesheet">
        

        <!-- -------------------------------- linking css at end -------------------------------- -->
        <link href="css/style.css" rel="stylesheet" type="text/css">     <!--style.css document-->

        <!-- ----------------------------------- appel jquery ----------------------------------- -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css"> <!--bootstrap-->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>  <!--googleapis jquery-->
        <!--<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>     jquery -->
        <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script> <!--bootstrap-->
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>    <!--bootstrap-->
    
        <!-- --------------------------------- APPEL font image --------------------------------- -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">  <!--font-awesome-->
	</head>
    <body>


        <!--     *****************************************************************************    -->
        <!--     ************************    Main Navigation bar     *************************    -->
        <!--     ***********   The Navigation bar which displays the main menu     ***********    -->
        <!--     *****************************************************************************    -->
        <nav class="navbar navbar-expand-md navbar-light fixed-top">
            <div class="container">
                <a class="navbar-brand" href="index.php">
                    <strong><em>Quai Antique</em></strong>
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navi">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navi">
                    <ul class="navbar-nav mr-auto">
                        <?php
                        //set navigation bar when logged in
                        if(isset($_SESSION['user_id'])) { 
                            echo'
                            <li class="nav-item">
                                <a class="nav-link" href="view_carte.php" >Notre carte</a>
                            </li>
                            <div class="dropdown nav-item">
                                <label class="dropdown-toggle nav-link" type="text" id="dropdownReservationButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Réservation
                                </label>
                                <div class="dropdown-menu" aria-labelledby="dropdownReservationButton">
                                    <a class="dropdown-item nav-link" href="reservation.php">Nouvelle réservation</a>
                                    <a class="dropdown-item nav-link" href="view_reservations.php">Voir les réservations</a>
                                </div>
                            </div>'  ;
                            if($_SESSION['role']==1) {
                                echo '<li class="nav-item">
                                    <a class="nav-link" href="index.php#footer">Nos horaires</a>
                                </li>'  ;
                            }
                            //set navigation bar when logged in and role of ADMIN
                            if($_SESSION['role']==2) {   
                                echo'
                                <li class="nav-item">
                                    <a class="nav-link" href="schedule.php" >Gérer l\'horaire</a>
                                </li>
                                <div class="dropdown nav-item">
                                    <label class="dropdown-toggle nav-link" type="text" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Les menus
                                    </label>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <a class="dropdown-item nav-link" href="view_menu.php">Gérer les menus</a>
                                        <a class="dropdown-item nav-link" href="view_food.php">Gérer les plats</a>
                                    </div>
                                </div>
                                <li class="nav-item">
                                    <a class="nav-link" href="index.php#footer">Nos horaires</a>
                                </li>'  ;
                            }
                        }
                        //main page not logged in navigation bar
                        else {
                            echo'
                            <li class="nav-item">
                                <a class="nav-link" href="view_carte.php" >Notre carte</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="index.php#aboutus">À propos de nous</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="index.php#gallery">Galerie</a>
                            </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="index.php#reservation">Réservation</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="index.php#footer">Nos horaires</a>
                                </li>' ;
                        }    ?>
                    </ul>
                    <?php
                    //log out button when user is logged in
                    if(isset($_SESSION['user_id'])){    //    LOGOUT    //
                        echo '
                        <form class="navbar-form navbar-right" action="includes/logout.inc.php" method="post">
                            <button type="submit" name="logout-submit" class="btn btn-outline-dark">Se déconnecter</button>
                        </form>' ;
                    }
                    else{     //    SIGN IN    //
                        echo '
                            <div class="authentification">
                                <ul class="navbar-nav ml-auto">
                                    <div class="fa fa-sign-in"> 
                                    <li><a class="nav-link" data-toggle="modal" data-target="#myModal_reg" id="signup">&nbsp;S\'inscrire</a></li>
                                    </div>
                                    <div class="fa fa-user-plus">  
                                    <li><a class="nav-link" data-toggle="modal" data-target="#myModal_login" id="signin">&nbsp;Connexion</a></li>
                                    </div>
                                </ul> 
                            </div>'
                        ;
                    }  ?>
                </div>
            </div>
        </nav>

        
        <!--     *****************************************************************************     -->  
        <!--     *************************    dialog box SIGN-IN     *************************     -->  
        <!--     ************   The Modal Bootstrap 4.1.0 display for SIGN-IN     ************     --> 
        <!--     *****************************************************************************     --> 
        <div class="container">
            <!--   The Modal Bootstrap 4.1.0 display for dialog box SIGN-IN   -->                          
            <div class="modal fade" id="myModal_login">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <!--   Modal Header in the dialog box SIGN-IN   -->
                        <div class="modal-header">
                            <h4 class="modal-title">Connexion</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <!-- Modal body -->
                        <div class="modal-body">
                            <?php 
                            if(isset($_GET['error1'])){ 
                                //script for modal to appear when error 
                                echo 
                                '<script>
                                    $(document).ready(
                                        function(){
                                            $("#myModal_login").modal("show");
                                        }
                                    );
                                </script>  ' ;
                                //error handling of log in
                                if($_GET['error1'] == "emptyfields") {   
                                    echo '<h5 class="text-danger text-center">Remplissez tous les champs, veuillez réessayer !</h5>';
                                }
                                else if($_GET['error1'] == "error") {   
                                    echo '<h5 class="text-danger text-center">Une erreur s\'est produite, veuillez réessayer !</h5>';
                                }
                                else if($_GET['error1'] == "wrongpwd") {   
                                    echo '<h5 class="text-danger text-center">Mauvais mot de passe, veuillez réessayer !</h5>';
                                }
                                    else if($_GET['error1'] == "error2") {   
                                    echo '<h5 class="text-danger text-center">Une erreur s\'est produite, veuillez réessayer !</h5>';
                                }
                                else if($_GET['error1'] == "nouser") {   
                                    echo '<h5 class="text-danger text-center">Nom d\'utilisateur ou e-mail introuvable, veuillez réessayer !</h5>';
                                }
                            }
                            echo'<br>';
                            ?>  
                            <!-- ------------------   SIGN-IN FORM -------------------------- -->
                            <div class="signin-form">
                                <form action="includes/login.inc.php" method="post">
                                    <p class="hint-text">Si vous avez déjà un compte, veuillez vous connecter.</p>
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="mailuid" placeholder="Nom d'utilisateur ou email" required="required">
                                    </div>
                                    <div class="form-group">
                                        <input type="password" class="form-control" name="pwd" placeholder="Mot de passe" required="required">
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" name="login-submit" class="btn btn-dark btn-lg btn-block">Connexion</button>
                                    </div>
                                </form>
                            </div>   
                        </div>
                        <!-- Modal footer -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Fermer</button>
                        </div>
                    </div>
                </div>
            </div> 
        </div>


        
        <!--     *****************************************************************************     -->
        <!--     *************************    dialog box SIGN-UP     *************************     -->
        <!--     ************   The Modal Bootstrap 4.1.0 display for SIGN-UP     ************     -->
        <!--     *****************************************************************************     -->
        <div class="container">
            <!--   dialog box SIGN-UP   -->
            <!--   The Modal Bootstrap 4.1.0 display for SIGN-UP   -->
            <div class="modal fade" id="myModal_reg">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <!--   Modal Header in the dialog box SIGN-UP   -->
                        <div class="modal-header">
                            <h4 class="modal-title">Enregistrer</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>      
                        <!-- Modal body in the dialog box SIGN-UP   -->
                        <div class="modal-body">
                            <?php
                            if(isset($_GET['error'])){
                                //script for modal to appear when error
                                echo'  
                                    <script>
                                        $(document).ready(function(){
                                            $("#myModal_reg").modal("show");
                                        });
                                    </script>'
                                ;
                                //error handling for errors and success --sign up form
                                if($_GET['error'] == "emptyfields") {   
                                    echo '<h5 class="bg-danger text-center">Remplissez tous les champs, veuillez réessayer !</h5>';
                                }
                                else if($_GET['error'] == "usernameemailtaken") {   
                                    echo '<h5 class="bg-danger text-center">Le nom d\'utilisateur ou l\'e-mail sont pris !</h5>';
                                }
                                else if($_GET['error'] == "invalidemail") {   
                                    echo '<h5 class="bg-danger text-center">E-mail invalide, veuillez réessayer !</h5>';
                                }
                                else if($_GET['error'] == "invalidemailusername") {   
                                    echo '<h5 class="bg-danger text-center">Le nom d\'utilisateur ou l\'e-mail n\'est pas pris, veuillez réessayer !</h5>';
                                }
                                else if($_GET['error'] == "invalidusername") {   
                                    echo '<h5 class="bg-danger text-center">Nom d\'utilisateur invalide, veuillez réessayer !</h5>';
                                }
                                else if($_GET['error'] == "invalidpassword") {   
                                    echo '<h5 class="bg-danger text-center">Mot de passe invalide, réessayez!</h5>';
                                }
                                else if($_GET['error'] == "passworddontmatch") {   
                                    echo '<h5 class="bg-danger text-center">Le mot de passe doit correspondre, veuillez réessayer !</h5>';
                                }
                                else if($_GET['error'] == "error1") {   
                                    echo '<h5 class="bg-danger text-center">Une erreur s\'est produite, veuillez réessayez !</h5>';
                                }
                                else if($_GET['error'] == "error2") {   
                                    echo '<h5 class="bg-danger text-center">Une erreur s\'est produite, veuillez réessayez !</h5>';
                                }
                                $_SESSION['user_id']=null;
                            }
                            if(isset($_GET['signup'])) { 
                                //success dialog box modal to appear when the subscription is success
                                echo
                                    '<script>
                                        $(document).ready(
                                            function(){
                                                $("#myModal_reg").modal("show");
                                            }
                                        );
                                    </script>'
                                ;
                                if($_GET['signup'] == "success"){ 
                                    echo '<h5 class="bg-success text-center">L\'inscription a réussi ! Veuillez vous connecter!</h5>';
                                }
                            }
                            echo'<br>';
                            ?>
                            <!-- ------------------   SIGN-UP REGISTRATION FORM -------------------------- -->
                            <div class="signup-form">
                                <form action="includes/signup.inc.php" method="post">
                                    <p class="hint-text">Créez votre compte. C'est gratuit et ne prend qu'une minute.</p>
                                    <div class="form-group">
                                        <label>Prénom</label>
                                        <input type="text" class="form-control" name="fname" placeholder="Prénom" required="required">
                                        <small class="form-text text-muted">Le prénom doit comporter entre 2 et 20 caractères</small>
                                    </div>
                                    <div class="form-group">
                                        <label>Last Name</label>
                                        <input type="text" class="form-control" name="lname" placeholder="Nom de famille" required="required">
                                        <small class="form-text text-muted">Le nom de famille doit comporter entre 2 et 20 caractères</small>
                                    </div>   
                                    <div class="form-group">
                                            <input type="text" class="form-control" name="uid" placeholder="Nom d'utilisateur" required="required">
                                            <small class="form-text text-muted">Le nom d'utilisateur doit comporter entre 4 et 20 caractères</small>
                                    </div>
                                    <div class="form-group">
                                            <input type="email" class="form-control" name="mail" placeholder="E-mail" required="required">
                                    </div>
                                    <div class="form-group">
                                        <input type="telephone" class="form-control" name="tele" required="required">
                                        <small class="form-text text-muted">Le numéro de téléphone doit comporter entre 6 et 20 caractères</small>
                                    </div>
                                    <div class="form-group">
                                        <input type="password" class="form-control" name="pwd" placeholder="Mot de passe" required="required">
                                        <small class="form-text text-muted">Le mot de passe doit comporter entre 6 et 20 caractères</small>
                                    </div>
                                    <div class="form-group">
                                        <input type="password" class="form-control" name="pwd-repeat" placeholder="Confirmer le mot de passe" required="required">
                                    </div>        
                                    <div class="form-group">
                                        <label class="checkbox-inline"><input type="checkbox" required="required"> J'accepte le <a href="#">Conditions d'utilisation </a> &amp; <a href="#">politique de confidentialité</a></label>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" name="signup-submit" class="btn btn-dark btn-lg btn-block">S'inscrire maintenant</button>
                                    </div>
                                </form>
                                    <div class="text-center">Avez Vous déjà un compte?<a href="#">Connexion</a></div>
                            </div> 	
                        </div>        
                        <!-- Modal footer -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Fermer</button>
                        </div> 
                    </div>
                </div>
            </div>
        </div>
