    <!-- header des pages -->
    <?php
        require 'include/header.php';
        require 'include/connect.php';
        if (!$_SESSION['loginOK']){
            header('Location: connexion.php');
        }
        if (isset($_GET['id'])) {
            $id = (int)$_GET['id'];
            // récupération des réservations
            $request = "SELECT reservations.titre, reservations.description, DATE_FORMAT(reservations.debut, '%d-%m-%Y %H') as debut, DATE_FORMAT(reservations.fin, '%d-%m-%Y %H') as fin, utilisateurs.login FROM reservations INNER JOIN utilisateurs on reservations.id_utilisateur = utilisateurs.id WHERE reservations.id = $id";
            $exect_request = mysqli_query($connect, $request);
            $reservations = mysqli_fetch_assoc($exect_request);
            // Récupération de la date et des heures de la résa
            list($date, $heure_d) = explode(" ", $reservations['debut']);
            list($date, $heure_f) = explode(" ", $reservations['fin']);
        }
        else {
            header('Location: planning.php');
        }
    ?>

    <!-- contenu de la page -->
    <main>
        <div class="container">
            <h1>Réservation</h1>
            <div class="info_resa">
                <h2><?= $reservations['titre'] ?></h2>
                <p>Créée par <?= $reservations['login'] ?></p>
                <p>La salle est réservée le <?=$date?></p>
                <p>A partir de <?= $heure_d."h" ?> jusqu'à <?= $heure_f."h" ?></p>
                <p>Description de la réservation :</p>
                <p><?= $reservations['description'] ?></p>
            </div>
        </div>
    </main>

    <!-- footer des pages -->
    <?php
        mysqli_close($connect); // fermer la connexion
        require 'include/footer.php';
    ?>
</body>
</html>