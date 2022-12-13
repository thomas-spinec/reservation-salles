<!--
////////////////////////////////////////////////////////////////////////////////////////
// Récupération de la date /////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////
-->
<?php
    setlocale(LC_TIME, 'fr_FR.utf8','fra');
    date_default_timezone_set('Europe/Paris');
    // $semaine = date("W");
    // $date = new DateTime("week");
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
?>
<!-- 
////////////////////////////////////////////////////////////////////////////////////////
// Reste de la page ////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////
-->

    <!-- header des pages -->
    <?php
        require 'include/header.php';
    ?>

    <!-- contenu de la page -->
    <main>
        <!-- Affichage de la semaine -->
        <table>
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
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>9h-10h</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>10h-11h</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>11h-12h</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>12h-13h</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>13h-14h</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>14h-15h</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>15h-16h</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>16h-17h</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>17h-18h</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>18h-19h</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
            </tbody>
        </table>
    </main>

    <!-- footer des pages -->
    <?php
        require 'include/footer.php';
    ?>
</body>
</html>
