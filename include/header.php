<!-- Partie PHP -->
<?php
    session_start();
?>
<!-- header des pages -->
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="site.css">
    <title>Accueil</title>
</head>

<body>
    <header>
        <div class="container">
            <div class="flex">
                <div id="left">
                    <h3>Thomas Spinec</h3>
                    <h4>Web Developper</h4>
                </div>
                <?php
                    // test si l'utilisateur est connecté
                    if (isset($_GET['deconnexion'])){
                        if($_GET['deconnexion']==true){
                            session_unset();
                            session_destroy();
                            header('Location: index.php');
                        }
                    }
                    else if(isset($_SESSION['login'])){
                        $user = $_SESSION['login'];
                ?>
                <div id='center'>
                    <h3>Bonjour <?=$user?></h3>
                    <a href='index.php?deconnexion=true'><button>Déconnexion</button></a>
                </div>
                        
                <?php
                        if ($user == 'admin') {
                            $_SESSION['admin'] = true;
                ?>

                <nav>
                    <ul>
                        <li><a class='a_head'href='index.php'>Accueil</a></li>
                        <li><a class='a_head' href='profil.php'>Profil</a></li>
                        <li><a class='a_head' href='livre-or.php'>Livre d'or</a></li>
                        <li><a class='a_head' href='admin.php'>Info Utilisateurs</a></li>
                    </ul>
                </nav>

                <?php
                        }
                        else {
                ?>
                
                <nav>
                    <ul>
                        <li><a class='a_head' href='index.php'>Accueil</a></li>
                        <li><a class='a_head' href='profil.php'>Profil</a></li>
                        <li><a class='a_head' href='livre-or.php'>Livre d'or</a></li>
                    </ul>
                </nav>

                <?php
                        }
                    }
                    else{
                ?>
                <div>
                    <a href='connexion.php'><button>Connexion</button></a>
                    <a href='inscription.php'><button>Inscription</button></a>
                    </div>
                <div>
                    <a class='a_head' href='index.php'>Accueil</a>
                    <a class='a_head' href='livre-or.php'>Livre d'or</a>
                </div>

                <?php
                    }
                ?>
            </div>
        </div>
    </header>
