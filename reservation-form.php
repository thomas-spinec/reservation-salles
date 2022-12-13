    <!-- header des pages -->
    <?php
        include 'include/header.php';
        include 'include/connect.php';
        if (!$_SESSION['loginOK']){
            header('Location: connexion.php');
        }
        $id = $_SESSION['id'];
    ?>

    <!-- contenu de la page -->
    <main>
        <div class="container">
            <h1>Réservation d'une salle</h1>
            <form action="reservation-form.php" method="post">
                <label for="titre">Titre :</label>
                <input type="text" name="titre" placeholder="Titre de la réservation" required>
                <label for="date">Date :</label>
                <input type="date" name="date" min=<?= date("Y-m-d", strtotime("now"))?> required>
                <label for="heure_debut">Heure de début :</label>
                <select name="heure_debut">
                    <option value="08">08h</option>
                    <option value="09">09h</option>
                    <option value="10">10h</option>
                    <option value="11">11h</option>
                    <option value="12">12h</option>
                    <option value="13">13h</option>
                    <option value="14">14h</option>
                    <option value="15">15h</option>
                    <option value="16">16h</option>
                    <option value="17">17h</option>
                    <option value="18">18h</option>
                </select>
                <label for="heure_fin">Heure de fin :</label>
                <select name="heure_fin">
                    <option value="09">09h</option>
                    <option value="10">10h</option>
                    <option value="11">11h</option>
                    <option value="12">12h</option>
                    <option value="13">13h</option>
                    <option value="14">14h</option>
                    <option value="15">15h</option>
                    <option value="16">16h</option>
                    <option value="17">17h</option>
                    <option value="18">18h</option>
                    <option value="19">19h</option>
                </select>
                <label for="description">Description :</label>
                <input type="text" name="description" placeholder="Description de la réservation" required>
                <input type="submit" value="Réserver">
            </form>
    </main>

    <?php
        if (isset($_POST['titre']) && isset($_POST['date']) && isset($_POST['heure_debut']) && isset($_POST['heure_fin']) && isset($_POST['description'])){
            $titre = mysqli_real_escape_string($connect, htmlspecialchars($_POST['titre']));
            $date = $_POST['date'];
            $heure_d = $_POST['heure_debut'];
            $heure_f = $_POST['heure_fin'];
            $date_d = "$date $heure_d";
            $date_f = "$date $heure_f";
            $description = mysqli_real_escape_string($connect, htmlspecialchars($_POST['description']));
            // Test pour vérifier si la date choisie est un week-end
            $date = date("w", strtotime($date));
            if ($date == 0 || $date == 6){
                echo "La date choisie est un week-end, veuillez choisir une autre date";
                exit();
            }
            // Test pour vérifier la disponibilité de la réservation
            $test = "SELECT COUNT(*) FROM `reservations` WHERE debut< $heure_d < fin OR debut< $heure_f <fin";
            $result = mysqli_query($connect, $test);
            $reponse      = mysqli_fetch_array($result);
            $count = $reponse['COUNT(*)'];
            if ($count == 0)
            {
                $sql = "INSERT INTO reservations (titre, description, debut, fin, id_utilisateur) VALUES ('$titre', '$description', '$date_d', '$date_f', '$id')";
                $result = mysqli_query($connect, $sql);
                if ($result){
                    echo "Réservation effectuée";
                } else {
                    echo "Erreur";
                }
            }
            else {
                echo "Créneau déjà pris";
            }
        }
    ?>

    <!-- footer des pages -->
    <?php
        mysqli_close($connect); // fermer la connexion
        include 'include/footer.php';
    ?>
</body>
</html>