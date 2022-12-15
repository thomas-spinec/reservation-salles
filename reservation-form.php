    <!-- header des pages -->
    <?php
        require 'include/header.php';
        require 'include/connect.php';
        if (!$_SESSION['loginOK']){
            header('Location: connexion.php');
        }
        $id = (int)$_SESSION['id'];
    ?>

    <!-- contenu de la page -->
    <main>
        <div class="container">
            <h1>Réservation d'une salle</h1>
            <div class="form_resa">

                <!-- Vérification des erreurs -->
                <?php
                    if(isset($_SESSION['error'])){
                        $err = $_SESSION['error'];
                        switch($err) {
                            case 0:
                                echo "<p style='color:green'>La salle a bien été réservée</p>";
                                break;
                            case 1:
                                echo "<p style='color:red'>La salle est déjà réservée à cette date et à cette heure</p>";
                                break;
                            case 2:
                                echo "<p style='color:red'>Le créneau doit être de minimum 1h, ou alors vous avez choisi une heure de fin antérieure à l'heure de début</p>";
                                break;
                            case 3:
                                echo "<p style='color:red'>La date choisie est un week-end, veuillez choisir une autre date</p>";
                                break;
                            case 4:
                                echo "<p style='color:red'>Il y a eu un problème durant la réservation, veuillez réessayer ultérieurement</p>";
                                break;
                        }
                        unset($_SESSION['error']);
                    }
                ?>
                <!-- Formulaire -->
                <form id="reserv" action="verif_resa.php" method="post">
                    <label for="titre">Titre :</label>
                    <input type="text" name="titre" placeholder="Titre de la réservation" required>
                    <label for="date">Date :</label>
                    <input type="date" name="date" min=<?= date("Y-m-d", strtotime("now"))?> required>
                    <label for="heure_debut">Heure de début :</label>
                    <select name="heure_debut" required>
                        <option value="08:00:00">08h</option>
                        <option value="09:00:00">09h</option>
                        <option value="10:00:00">10h</option>
                        <option value="11:00:00">11h</option>
                        <option value="12:00:00">12h</option>
                        <option value="13:00:00">13h</option>
                        <option value="14:00:00">14h</option>
                        <option value="15:00:00">15h</option>
                        <option value="16:00:00">16h</option>
                        <option value="17:00:00">17h</option>
                        <option value="18:00:00">18h</option>
                    </select>
                    <label for="heure_fin">Heure de fin :</label>
                    <select name="heure_fin" required>
                        <option value="09:00:00">09h</option>
                        <option value="10:00:00">10h</option>
                        <option value="11:00:00">11h</option>
                        <option value="12:00:00">12h</option>
                        <option value="13:00:00">13h</option>
                        <option value="14:00:00">14h</option>
                        <option value="15:00:00">15h</option>
                        <option value="16:00:00">16h</option>
                        <option value="17:00:00">17h</option>
                        <option value="18:00:00">18h</option>
                        <option value="19:00:00">19h</option>
                    </select>
                    <label for="description">Description :</label>
                    <input type="text" name="description" placeholder="Description de la réservation" required>
                    <input type="submit" value="Réserver">
                </form>
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