<?php
    session_start();
    require 'include/connect.php';
    $id = (int)$_SESSION['id'];
?>

<?php
    if (isset($_POST['titre']) && isset($_POST['date']) && isset($_POST['heure_debut']) && isset($_POST['heure_fin']) && isset($_POST['description'])){
        $titre = mysqli_real_escape_string($connect, htmlspecialchars($_POST['titre']));
        $date = $_POST['date'];
        $heure_d = $_POST['heure_debut'];
        $heure_f = $_POST['heure_fin'];
        $date_d = [$date, $heure_d];
        $date_d = implode(" ", $date_d);
        $date_f = [$date,$heure_f];
        $date_f = implode(" ", $date_f);
        $description = mysqli_real_escape_string($connect, htmlspecialchars($_POST['description']));
        // Test pour vérifier si la date choisie est un week-end
        $date = date("w", strtotime($date));
        if ($date == 0 || $date == 6){
            $_SESSION['error'] = 3;
            header('Location: reservation-form.php'); // Date choisie est un week-end
        }
        // Test pour vérifier que le créneau soit bien de 1h min
        if ($heure_d >= $heure_f)
        {
            $_SESSION['error'] = 2;
            header('Location: reservation-form.php'); // Créneau trop court ou heure de début postérieure à l'heure de fin
        }

        // Test pour vérifier la disponibilité de la réservation
        $test = "SELECT COUNT(*) FROM `reservations` WHERE '$date_d'<= debut AND '$date_f' <= fin AND debut <='$date_f' OR debut<= '$date_d' AND '$date_f'<=fin OR debut<= '$date_d' AND '$date_d'<=fin AND fin <= '$date_f' OR '$date_d' <= debut AND fin <= '$date_f'";
        $result = mysqli_query($connect, $test);
        $reponse      = mysqli_fetch_array($result);
        $count = $reponse['COUNT(*)'];
        if ($count == 0)
        {
            $sql = "INSERT INTO reservations (titre, description, debut, fin, id_utilisateur) VALUES ('$titre', '$description', '$date_d', '$date_f', $id)";
            $result = mysqli_query($connect, $sql);
            if ($result){
                $_SESSION['error'] = 0;
                header('Location: reservation-form.php'); // Réservation effectuée
            } else {
                $_SESSION['error'] = 4;
                header('Location: reservation-form.php'); // Erreur
            }
        }
        else {
            $_SESSION['error'] = 1;
            header('Location: reservation-form.php'); // Créneau déjà pris
        }
    }

    mysqli_close($connect); // fermer la connexion
?>