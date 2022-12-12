    <!-- header des pages -->
    <?php
        include 'header.php';
        include 'connect.php';
        if (!$_SESSION['loginOK']){
            header('Location: connexion.php');
        }
        // rappel des variable contenant les informations de l'utilisateur
        $login = $_SESSION['login'];

        $requete = "SELECT password FROM utilisateurs where login = '".$login."'";
        $exec_requete = $connect -> query($requete);
        $reponse = mysqli_fetch_array($exec_requete);
    ?>

    <!-- contenu de la page -->
    <main>
        <div class="container">
            <div class="profil">
                <h1>Profil</h1>
                <?php
                    echo "<p>Bonjour $user</p>";
                    echo "<p>Voici vos informations:</p>";

                ?>

                <!-- modification des informations -->
                <div class="background_form">
                    <h3>Modifiez vos informations</h3>
                    <?php
                        // affichage en cas d'erreur
                        if(isset($_GET['erreur'])){
                            if($_GET['erreur'] == 0)
                                echo "<p style='color:green'>Modifications réalisées</p>";
                            else if ($_GET['erreur'] == 1){
                                echo "<p style='color:red'>Mot de passe incorrect, modifications non réalisées</p>";
                            }
                            else if ($_GET['erreur'] == 2){
                                echo "<p style='color:red'>Veuillez entrer votre mot de passe pour réaliser des changements</p>";
                            }
                        }
                    ?>
                    <form action="profil.php" method="post">
                        <label for="login">login</label>
                        <input type="text" name="login" id="login" value="<?=$login?>" required>
                        <label for="password">Mot de passe</label>
                        <input type="password" name="password" id="password" placeholder="Entrez votre mot de passe" required>
                        <input type="submit" value="Modifier">
                    </form>

                    <?php
                        if(isset($_POST['login']) && isset($_POST['password'])){
                            $password = $_POST['password'];
                            if ($password != ""){
                                $password_hash = $reponse['password'];
                                if (password_verify($password, $password_hash)) { //mot de passe correct
                                    // stockage des nouvelles infos dans la BDD
                                    $password = password_hash($password, PASSWORD_DEFAULT);
                                    $requete = "UPDATE utilisateurs SET login = '".$_POST['login']."' where login = '".$login."'";
                                    $exec_requete = $connect -> query($requete);
                                    // stockage des nouvelles infos dans les variables de session
                                    $login = $_POST['login'];
                                    $_SESSION['login'] = $login;

                                    // redirection vers la page profil avec les nouvelles données
                                    header('Location: profil.php?erreur=0');
                                }
                                else{
                                    header('Location: profil.php?erreur=1'); // mot de passe incorrect
                                }
                            }
                            else{
                                header('Location: profil.php?erreur=2'); // mot de passe vide
                            }
                        }
                    ?>
                </div>
                <br>
                <br>
                <!-- modification du mot de passe -->
                <div class="background_form">
                    <h3>Modifiez votre mot de passe</h3>
                    <?php
                        //affichage en cas d'erreur
                        if(isset($_GET['erreur'])){
                            if ($_GET['erreur'] == 3){
                                echo "<p style='color:red'>Les deux mots de passe ne correspondent pas</p>";
                            }
                            else if ($_GET['erreur'] == 4){
                                echo "<p style='color:red'>Veuillez entrer un nouveau mot de passe</p>";
                            }
                            else if ($_GET['erreur'] == 5){
                                echo "<p style='color:red'>Case ancien mot de passe vide ou incorrect</p>";
                            }
                            else if ($_GET['erreur'] == 6){
                                echo "<p style='color:green'>Mot de passe modifié</p>";
                            }
                        }

                    ?>
                    <br>
                    <form action="profil.php" method="post">
                        <label for="password1">Ancien mot de passe</label>
                        <input type="password" name="password1" id="password" placeholder="Entrez votre ancien mot de passe" required>
                        <label for="newpassword">Nouveau mot de passe</label>
                        <input type="password" name="newpassword" id="newpassword" placeholder="Entrez votre nouveau mot de passe" required>
                        <label for="newpassword2">Confirmez votre nouveau mot de passe</label>
                        <input type="password" name="newpassword2" id="newpassword2" placeholder="Confirmez votre nouveau mot de passe" required>
                        <input type="submit" value="Changer le mot de passe">
                    </form>

                    <?php
                        if(isset($_POST['password1']) && isset($_POST['newpassword']) && isset($_POST['newpassword2'])){
                            if ($_POST['password1'] != ""){
                                $password_hash = $reponse['password'];
                                if (password_verify($_POST['password1'], $password_hash)) { // ancien mot de passe correct
                                    if (isset($_POST['newpassword']) && $_POST['newpassword'] !== '' && isset($_POST['newpassword2']) && $_POST['newpassword2'] !== ''){
                                        if ($_POST['newpassword'] == $_POST['newpassword2']){ // nouveau mot de passe correct
                                            $password = password_hash($_POST['newpassword'], PASSWORD_BCRYPT);
                                            // stockage du nouveau mot de passe dans la BDD
                                            $requete = "UPDATE utilisateurs SET password = '".$password."'";
                                            $exec_requete = $connect -> query($requete);
                                            // stockage du nouveau mot de passe dans les variables de session
                                            $_SESSION['password'] = $password;
                                            // redirection avec message de réussite
                                            header('Location: profil.php?erreur=6');
                                            
                                        }
                                        else{
                                            // $_SESSION['erreur'] = 3; // les deux mots de passe ne correspondent pas
                                            header('Location: profil.php?erreur=3'); // deux mots de passe différents
                                        }
                                    }
                                    else{
                                        //$_SESSION['erreur'] = 4; // case nouveau mot de passe vide
                                        header('Location: profil.php?erreur=4'); // nouveau mot de passe vide
                                    }
                                }
                                else{
                                    //$_SESSION['erreur'] = 5; // ancien mot de passe incorrect
                                    header('Location: profil.php?erreur=5'); // ancien mot de passe incorrect
                                }
                            }
                            else{
                                //$_SESSION['erreur'] = 5; // ancien mot de passe vide
                                header('Location: profil.php?erreur=5'); // ancien mot de passe vide
                            }
                        }

                    ?>
                </div>
            </div>
        </div>

    </main>

    <!-- footer des pages -->
    <?php
        include 'footer.php';
    ?>
</body>
</html>