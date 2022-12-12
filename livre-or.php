    <!-- header des pages -->
    <?php
        include 'header.php';
        include 'connect.php';
    ?>

    <!-- contenu de la page -->
    <main>
        <?php
            // requête pour récupérer tout ce qu'il y a dans la base de données commentaires, ainsi que le login dans la base de donnée utilisateurs correspondant à l'id_utilisateurs de la base de données commentaires
            $requete = "SELECT commentaires.id, commentaires.commentaire, DATE_FORMAT(commentaires.date, '%d/%m/%Y') as date, utilisateurs.login FROM commentaires INNER JOIN utilisateurs ON commentaires.id_utilisateur = utilisateurs.id ORDER BY id DESC";

            // exécution de la requête
            $exec_requete = $connect -> query($requete);
            
        ?>

        <div class="container">

            <!-- Affichage des commentaires -->
            <h1>Livre d'or</h1>
            <table class="commentaires">
                <thead>
                    <tr>
                        <th class="date">Posté le</th>
                        <th class="user">Par l'utilisateur</th>
                        <th class="comm">Commentaires</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        // affichage des commentaires
                        while ($reponse = mysqli_fetch_assoc($exec_requete)){
                            echo "<tr>";
                            echo "<td class='date'>".$reponse['date']."</td>";
                            echo "<td class='user'>".$reponse['login']."</td>";
                            echo "<td class='comm'>".$reponse['commentaire']."</td>";
                            echo "</tr>";
                        }
                    ?>
                </tbody>
            </table>

            <!-- Vérif si connecté ou pas -->
            <?php
                if (isset($_SESSION['loginOK'])){
                    if ($_SESSION['loginOK']){

            ?>
            <br>
                <div class="center">
                    <a href='commentaire.php'><button>Laisser un commentaire</button></a>
                </div>
            <?php
                    }
                }
                else 
                {
            ?>
                <div class="center">
                    <p>Vous devez être connecté pour laisser un commentaire</p>
                    <a href='connexion.php'><button>Se connecter</button></a>
                </div>
            <?php
                }
            ?>

        </div>

    </main>

    <!-- footer des pages -->
    <?php
        include 'footer.php';
    ?>
</body>
</html>