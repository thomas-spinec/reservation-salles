    <!-- header des pages -->
    <?php
        include 'header.php';
    ?>

    <!-- contenu de la page -->
    <main>
        <div class="container">
            <div class="background_form">
                <h1>Connexion</h1>
                <form action="verif.php" method="post">
                    <label for="login">login</label>
                    <input type="text" name="login" id="login" placeholder="login" required>
                    <label for="password">Mot de passe</label>
                    <input type="password" name="password" id="password" placeholder="Mot de passe" required>
                    <input type="submit" value="Se connecter">
                </form>

                <?php
                    if(isset($_GET['erreur'])){
                        $err = $_GET['erreur'];
                        if($err==1 || $err==2)
                            echo "<p style='color:red'>Utilisateur ou mot de passe incorrect</p>";
                    }
                ?>
            </div>
        </div>
    </main>

    <!-- footer des pages -->
    <?php
        include 'footer.php';
    ?>
</body>
</html>