<!--
////////////////////////////////////////////////////////////////////////////////////////
// Récupération de la date /////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////
-->
<?php
    setlocale(LC_TIME, 'fr_FR.utf8','fra');
    date_default_timezone_set('Europe/Paris');
    $format = "d-m-Y";

    if (isset($_GET["week"])){
        $week = $_GET["week"];
    }
    else{
        $week = 0;
    }
    function get_lundi_dimanche_from_week($week){
        $lundi = new DateTime("Monday this week+$week week");
        $mardi = new DateTime("Tuesday this week+$week week");
        $mercredi = new DateTime("Wednesday this week+$week week");
        $jeudi = new DateTime("Thursday this week+$week week");
        $vendredi = new DateTime("Friday this week+$week week");
        $samedi = new DateTime("Saturday this week+$week week");
        $dimanche = new DateTime("Sunday this week+$week week");

        return array($lundi, $mardi, $mercredi, $jeudi, $vendredi, $samedi, $dimanche);
    }

    $debut_fin_semaine = get_lundi_dimanche_from_week($week);

    // Fonction permettant de construire l'intérieur du tableau
    function jour($reservations, $debut_fin_semaine, $format, $heure1, $heure2){
        for ($i=0; $i < 5; $i++) {
            $case = null;   
            for ($j=0; isset($reservations[$j]); $j++) {
                $date_start = $reservations[$j]['debut'];
                $date_end = $reservations[$j]['fin'];
                $date_d = get_debut($date_start)[0];
                $heure_d = get_debut($date_start)[1];
                $heure_f = get_fin($date_end)[1];
                if ($date_d == $debut_fin_semaine[$i]->format($format) && $heure1 >= $heure_d && $heure2 <= $heure_f)
                {
                    echo "<td class='booked'>"; 
                    echo "<a href='reservation.php?id=" . $reservations[$j]['id'] . "'>
                            <p>".$reservations[$j]['login']."</p>
                            <p>".$reservations[$j]['titre']."</p>
                        </a>";
                    $case = true;
                    break; 
                }
            }
            if (!isset($case))
            {
                echo "<td>"; 
                echo "<p>Libre</p>";
            }
            echo "</td>";
        }
        for ($x=0; $x<2; $x++){
            echo "<td class='weekend'>";
            echo "<p>Indisponible</p>";
            echo "</td>";
        }
    }


    // récupération des réservations, séparation des dates en 2 variables
    function get_debut($date){
        $date_d = '';
        $heure_d = '';
        list($date_d, $heure_d) = explode(" ", $date);

        return [$date_d,$heure_d];
    }

    function get_fin($date){
        $date_f = '';
        $heure_f = '';
        list($date_f, $heure_f) = explode(" ", $date);

        return [$date_f,$heure_f];
    }
?>
<!-- 
////////////////////////////////////////////////////////////////////////////////////////
// Reste de la page ////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////
-->

    <!-- header des pages -->
    <?php
        require 'include/header.php';
        require 'include/connect.php';

        // récupération des réservations
        $request = "SELECT reservations.id, reservations.titre, DATE_FORMAT(reservations.debut, '%d-%m-%Y %H') as debut, DATE_FORMAT(reservations.fin, '%d-%m-%Y %H') as fin, utilisateurs.login FROM reservations INNER JOIN utilisateurs on reservations.id_utilisateur = utilisateurs.id";
        $exect_request = mysqli_query($connect, $request);
        $reservations = mysqli_fetch_all($exect_request, MYSQLI_ASSOC);
    ?>

    <!-- contenu de la page -->
    <main>
        <div class="container">
            <h1>Planning</h1>
        <!-- Affichage de la semaine -->
            <table class="planning">
                <thead>
                    <tr>
                        <th>
                            <a href=<?="planning.php?week=".$week-1?>><img class="week" src="img/precedent.png" alt="semaine précédente"></a>
                        </th>
                        <th>Lundi <?= $debut_fin_semaine[0]->format($format)?></th>
                        <th>Mardi <?= $debut_fin_semaine[1]->format($format)?></th>
                        <th>Mercredi <?= $debut_fin_semaine[2]->format($format)?></th>
                        <th>Jeudi <?= $debut_fin_semaine[3]->format($format)?></th>
                        <th>Vendredi <?= $debut_fin_semaine[4]->format($format)?></th>
                        <th>Samedi <?= $debut_fin_semaine[5]->format($format)?></th>
                        <th>Dimanche <?= $debut_fin_semaine[6]->format($format)?></th>
                        <th>
                            <a href=<?="planning.php?week=".$week+1?>><img class="week" src="img/next.png" alt="semaine suivante"></a>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>8h-9h</td>
                        <?php 
                            jour($reservations, $debut_fin_semaine, $format, "08", "09"); 
                        ?>
                        <td>8h-9h</td>
                    </tr>
                    <tr>
                        <td>9h-10h</td>
                        <?php 
                            jour($reservations, $debut_fin_semaine, $format, "09", "10");
                        ?>
                        <td>9h-10h</td>
                    </tr>
                    <tr>
                        <td>10h-11h</td>
                        <?php
                            jour($reservations, $debut_fin_semaine, $format, "10", "11");
                        ?>
                        <td>10h-11h</td>
                    </tr>
                    <tr>
                        <td>11h-12h</td>
                        <?php
                            jour($reservations, $debut_fin_semaine, $format, "11", "12");
                        ?>
                        <td>11h-12h</td>
                    </tr>
                    <tr>
                        <td>12h-13h</td>
                        <?php
                            jour($reservations, $debut_fin_semaine, $format, "12", "13");
                        ?>
                        <td>12h-13h</td>
                    </tr>
                    <tr>
                        <td>13h-14h</td>
                        <?php
                            jour($reservations, $debut_fin_semaine, $format, "13", "14");
                        ?>
                        <td>13h-14h</td>
                    </tr>
                    <tr>
                        <td>14h-15h</td>
                        <?php
                            jour($reservations, $debut_fin_semaine, $format, "14", "15");
                        ?>
                        <td>14h-15h</td>
                    </tr>
                    <tr>
                        <td>15h-16h</td>
                        <?php
                            jour($reservations, $debut_fin_semaine, $format, "15", "16");
                        ?>
                        <td>15h-16h</td>
                    </tr>
                    <tr>
                        <td>16h-17h</td>
                        <?php
                            jour($reservations, $debut_fin_semaine, $format, "16", "17");
                        ?>
                        <td>16h-17h</td>
                    </tr>
                    <tr>
                        <td>17h-18h</td>
                        <?php
                            jour($reservations, $debut_fin_semaine, $format, "17", "18");
                        ?>
                        <td>17h-18h</td>
                    </tr>
                    <tr>
                        <td>18h-19h</td>
                        <?php
                            jour($reservations, $debut_fin_semaine, $format, "18", "19");
                        ?>
                        <td>18h-19h</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </main>

    <!-- footer des pages -->
    <?php
        require 'include/footer.php';
    ?>
</body>
</html>
