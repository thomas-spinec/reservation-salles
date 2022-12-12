<!--
////////////////////////////////////////////////////////////////////////////////////////
// Récupération de la date /////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////
-->
<?php
    if (isset($_GET["week"])){
        $week = $_GET["week"];
    }
    else{
        $week = 0;
    }
    function get_lundi_dimanche_from_week($week){
        $lundi = date("d-m-Y", strtotime("+".$week." week Monday"));
        $mardi = date("d-m-Y", strtotime("+".$week." week Tuesday"));
        $mercredi = date("d-m-Y", strtotime("+".$week." week Wednesday"));
        $jeudi = date("d-m-Y", strtotime("+".$week." week Thursday"));
        $vendredi = date("d-m-Y", strtotime("+".$week." week Friday"));
        $samedi = date("d-m-Y", strtotime("+".$week." week Saturday"));
        $dimanche = date("d-m-Y", strtotime("+".$week." week Sunday"));

        return array($lundi, $mardi, $mercredi, $jeudi, $vendredi, $samedi, $dimanche);
    }

    $debut_fin_semaine = get_lundi_dimanche_from_week($week);
    echo "Semaine du : " .$debut_fin_semaine[0] . " au " . $debut_fin_semaine [6];
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
                    <th>Lundi <?= $debut_fin_semaine[0]?></th>
                    <th>Mardi <?= $debut_fin_semaine[1]?></th>
                    <th>Mercredi <?= $debut_fin_semaine[2]?></th>
                    <th>Jeudi <?= $debut_fin_semaine[3]?></th>
                    <th>Vendredi <?= $debut_fin_semaine[4]?></th>
                    <th>Samedi <?= $debut_fin_semaine[5]?></th>
                    <th>Dimanche <?= $debut_fin_semaine[6]?></th>
                    <th>
                        <a href=<?="planning.php?week=".$week+1?>><img class="week" src="img/next.png" alt="semaine suivante"></a>
                    </th>
                </tr>
            </thead>
        </table>
    </main>

    <!-- footer des pages -->
    <?php
        require 'include/footer.php';
    ?>
</body>
</html>
