    <!-- header des pages -->
    <?php
        include 'include/header.php';
        include 'include/connect.php';
        if (!$_SESSION['loginOK']){
            header('Location: connexion.php');
        }
        else if (!$_SESSION['admin']){
            header('Location: index.php');
        }
    ?>

    <!-- contenu de la page -->
    <main>
        <div class="container">
            <h1>Administration</h1>
            <div id="table_admin">
                <h2>Utilisateurs</h2>
                <table>
                    <thead>
                        <tr>
                            <th>Nom d'utilisateur</th>
                        </tr>
                    </thead>

                    <!-- Début body tableau des utilisateurs -->

                    <tbody>
                        <?php
                            $request = "SELECT * FROM utilisateurs";
                            $exec_request = $connect -> query($request);
                            while(($result = $exec_request -> fetch_assoc()) != null)
                            {
                        ?>
                        
                        <tr>
                            <td><?=$result['login']?></td>
                        </tr>

                        <?php
                            }
                        ?>
                    </tbody>

                    <!-- Fin body tableau des utilisateurs -->

                </table>
            </div>
        </div>
    </main>

    <!-- footer des pages -->
    <?php

        mysqli_close($connect); // fermer la connexion
        include 'include/footer.php';
    ?>
</body>
</html>