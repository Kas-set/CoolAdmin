<?php
// Connexion à la base de données
$servername = "localhost";
$username = "godwin";
$password = "";
$dbname = "web tp";

// Créer une connexion
$conn = new mysqli($servername, $username, $password, $dbname);

// Vérifier la connexion
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Requête SQL pour récupérer les données
$sql = "SELECT `id`, `nom`, `prenom`, `photo`, `date de naissance`, `sexe`, `nationalité`,YEAR(`anneeInscription`) AS anneeInscription, `serie` FROM `etudiant`";
$result = $conn->query($sql);

$sql2 = "SELECT `nationalité`, COUNT(*) AS nombre_inscrits FROM `etudiant` GROUP BY nationalité";

// Exécution de la requête
$resultat2 = $conn->query($sql2);

// Tableau des informations de nationalité et nombre d'inscrits
$nations = [];

// Récupérer les données de la base de données
if ($resultat2->num_rows > 0) {
    while ($row = $resultat2->fetch_assoc()) {
        $nationalite = $row["nationalité"];
        $nombre_inscrits = $row["nombre_inscrits"];
        // Ajouter les informations à la tableau
        $nations[$nationalite] = $nombre_inscrits;
    }
}

// Requête SQL pour récupérer toutes les informations des étudiants, classées par nationalité

$sql3 = "SELECT `nom`, `prenom`, `photo`, `date de naissance`, `sexe`, `nationalité`, YEAR(`anneeInscription`) AS anneeInscription, `serie`FROM `etudiant`ORDER BY `nationalité`";

// Exécution de la requête
$resultat3 = $conn->query($sql3);

// Variable pour stocker la nationalité précédente 
$nationalite_precedente = null;

$sql4 = "SELECT `nom`, `prenom`, `photo`, `date de naissance`, `sexe`, `nationalité`, YEAR(`anneeInscription`) AS anneeInscription, `serie`, COUNT(*) as nb_inscriptions FROM `etudiant`GROUP BY `nom`, `prenom` HAVING COUNT(*) > 1";

    // Exécution de la requête
$result4 = $conn->query($sql4);

// Effectuer la requête SQL pour récupérer les inscrits masculins
$sql_hommes = "SELECT * FROM etudiant WHERE sexe = 'M'";
$result_hommes = $conn->query($sql_hommes);

// Effectuer la requête SQL pour récupérer les inscrites féminins
$sql_femmes = "SELECT * FROM etudiant WHERE sexe = 'F'";
$result_femmes = $conn->query($sql_femmes);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="au theme template">
    <meta name="author" content="Hau Nguyen">
    <meta name="keywords" content="au theme template">

    <!-- Title Page-->
    <title>Tables</title>

    <!-- Fontfaces CSS-->
    <link href="css/font-face.css" rel="stylesheet" media="all">
    <link href="vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
    <link href="vendor/font-awesome-5/css/fontawesome-all.min.css" rel="stylesheet" media="all">
    <link href="vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">

    <!-- Bootstrap CSS-->
    <link href="vendor/bootstrap-4.1/bootstrap.min.css" rel="stylesheet" media="all">

    <!-- Vendor CSS-->
    <link href="vendor/animsition/animsition.min.css" rel="stylesheet" media="all">
    <link href="vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet" media="all">
    <link href="vendor/wow/animate.css" rel="stylesheet" media="all">
    <link href="vendor/css-hamburgers/hamburgers.min.css" rel="stylesheet" media="all">
    <link href="vendor/slick/slick.css" rel="stylesheet" media="all">
    <link href="vendor/select2/select2.min.css" rel="stylesheet" media="all">
    <link href="vendor/perfect-scrollbar/perfect-scrollbar.css" rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link href="css/theme.css" rel="stylesheet" media="all">

</head>

<body class="animsition">
    <div class="page-wrapper">
        <!-- HEADER MOBILE-->
        <header class="header-mobile d-block d-lg-none">
            <div class="header-mobile__bar">
                <div class="container-fluid">
                    <div class="header-mobile-inner">
                        <a class="logo" href="index.php">
                            <img src="images/icon/logo.png" alt="CoolAdmin" />
                        </a>
                        <button class="hamburger hamburger--slider" type="button">
                            <span class="hamburger-box">
                                <span class="hamburger-inner"></span>
                            </span>
                        </button>
                    </div>
                </div>
            </div>
            <nav class="navbar-mobile">
                <div class="container-fluid">
                <ul class="list-unstyled navbar__list">
                        <li class="active has-sub">
                            <a class="js-arrow" href="index.php">
                                <i class="fas fa-tachometer-alt"></i>Dashboard
                            </a>
                        </li>
                       
                        <li class="has-sub">
                            <a href="table.php">
                                <i class="fas fa-table"></i>Tables</a>
                        </li>
                        <li class="has-sub">
                            <a href="form.php">
                                <i class="far fa-check-square"></i>Formulaires</a>
                        </li>
                        <li>
                            <a href="calendar.html">
                                <i class="fas fa-calendar-alt"></i>Calendrier</a>
                        </li>
                        <li class="has-sub">
                           
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <!-- END HEADER MOBILE-->

        <!-- MENU SIDEBAR-->
        <aside class="menu-sidebar d-none d-lg-block">
            <div class="logo fw-bold">
                ESPACE ADMIN
        
            </div>
            <div class="menu-sidebar__content js-scrollbar1">
                <nav class="navbar-sidebar">
                <ul class="list-unstyled navbar__list">
                        <li class="active has-sub">
                            <a class="js-arrow" href="index.php">
                                <i class="fas fa-tachometer-alt"></i>Dashboard
                            </a>
                        </li>
                       
                        <li class="has-sub">
                            <a href="table.php">
                                <i class="fas fa-table"></i>Tables</a>
                        </li>
                        <li class="has-sub">
                            <a href="form.php">
                                <i class="far fa-check-square"></i>Formulaires</a>
                        </li>
                        <li>
                            <a href="calendar.html">
                                <i class="fas fa-calendar-alt"></i>Calendrier</a>
                        </li>
                        <li class="has-sub">
                           
                        </li>
                    </ul>
            </div>
        </aside>
        <!-- END MENU SIDEBAR-->

        <!-- PAGE CONTAINER-->
        <div class="page-container">
            <!-- HEADER DESKTOP-->
            <header class="header-desktop">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="header-wrap">
                            <form class="form-header" action="" method="POST">
                                <input class="au-input au-input--xl" type="text" name="search" placeholder="Rechercher des candidats" />
                                <button class="au-btn--submit" type="submit">
                                    <i class="zmdi zmdi-search"></i>
                                </button>
                            </form>
                            <div class="header-button">
                                <div class="noti-wrap">
                                   
                                   
                                    <div class="noti__item js-item-menu">
                                        <i class="zmdi zmdi-notifications"></i>
                                        <span class="quantity">3</span>
                                        <div class="notifi-dropdown js-dropdown">
                                            <div class="notifi__title">
                                                <p>You have 3 Notifications</p>
                                            </div>
                                            <div class="notifi__item">
                                                <div class="bg-c1 img-cir img-40">
                                                    <i class="zmdi zmdi-email-open"></i>
                                                </div>
                                                <div class="content">
                                                    <p>You got a email notification</p>
                                                    <span class="date">April 12, 2018 06:50</span>
                                                </div>
                                            </div>
                                            <div class="notifi__item">
                                                <div class="bg-c2 img-cir img-40">
                                                    <i class="zmdi zmdi-account-box"></i>
                                                </div>
                                                <div class="content">
                                                    <p>Your account has been blocked</p>
                                                    <span class="date">April 12, 2018 06:50</span>
                                                </div>
                                            </div>
                                            <div class="notifi__item">
                                                <div class="bg-c3 img-cir img-40">
                                                    <i class="zmdi zmdi-file-text"></i>
                                                </div>
                                                <div class="content">
                                                    <p>You got a new file</p>
                                                    <span class="date">April 12, 2018 06:50</span>
                                                </div>
                                            </div>
                                            <div class="notifi__footer">
                                                <a href="#">All notifications</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="account-wrap">
                                    <div class="account-item clearfix js-item-menu">
                                        <div class="image">
                                            <img src="images/icon/avatar-01.jpg" alt="John Doe" />
                                        </div>
                                        <div class="content">
                                            <a class="js-acc-btn" href="#">Godwin</a>
                                        </div>
                                        <div class="account-dropdown js-dropdown">
                                            <div class="info clearfix">
                                                <div class="image">
                                                    <a href="#">
                                                        <img src="images/icon/avatar-01.jpg" alt="John Doe" />
                                                    </a>
                                                </div>
                                                <div class="content">
                                                    <h5 class="name">
                                                        <a href="#">Godwin</a>
                                                    </h5>
                                                    <span class="email">godwin@example.com</span>
                                                </div>
                                            </div>
                                            <div class="account-dropdown__footer">
                                                <a href="#">
                                                    <i class="zmdi zmdi-power"></i>Logout</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </header>
            <!-- END HEADER DESKTOP-->

            <!-- MAIN CONTENT-->
            <div class="main-content">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-lg-9">
                                <div class="table-responsive table--no-card m-b-30">
                                <table class="table table-borderless table-striped table-earning">
                                        <thead>
                                            <tr>
                                                <th>Photo</th>
                                                <th>Nom</th>
                                                <th>Prénom</th>
                                                <th>Date de naissance</th>
                                                <th>Sexe</th>
                                                <th>Nationalité</th>
                                                <th>Année d'inscription</th>
                                                <th>Série</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            // Vérifier s'il y a des résultats
                                            if ($result->num_rows > 0) {
                                                // Afficher les données dans le tableau
                                                while($row = $result->fetch_assoc()) {
                                                    echo "<tr>";
                                                    echo "<td><img src='" . $row["photo"] . "' alt='" . $row["nom"] . " " . $row["prenom"] . "' width='100'></td>";
                                                    echo "<td>" . $row["nom"] . "</td>";
                                                    echo "<td>" . $row["prenom"] . "</td>";
                                                    echo "<td>" . $row["date de naissance"] . "</td>";
                                                    echo "<td>" . $row["sexe"] . "</td>";
                                                    echo "<td>" . $row["nationalité"] . "</td>";
                                                    echo "<td>" . $row["anneeInscription"] . "</td>";
                                                    echo "<td>" . $row["serie"] . "</td>";
                                                    echo "</tr>";
                                                }
                                            } else {
                                                echo "0 results";
                                            }
                                            // Fermer la connexion à la base de données
                                            $conn->close();
                                            ?>
                                        </tbody>
                                    </table>
                            
                                </div>
                            </div>

                            <!-- nationalités et occurences -->
                            <div class="col-lg-3">
                                <div class="au-card au-card--bg-blue au-card-top-countries m-b-30">
                                    <div class="au-card-inner">

                                        <div class="table-responsive">
                                            <?php

                                                // Afficher les informations dans le tableau existant
                                                echo '<table class="table table-top-countries">
                                                        <tbody>';
                                                foreach ($nations as $nationalite => $nombre_inscrits) {
                                                    echo '<tr>
                                                            <td>' . $nationalite . '</td>
                                                            <td class="text-right">' . $nombre_inscrits . '</td>
                                                        </tr>';
                                                }
                                                echo '</tbody>
                                                    </table>';
                                                ?>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                         
                        <div>
                            <!-- LISTE PAR SEXE -->
                            <h2 class="my-4 text-center">Liste des candidats inscrits par sexe</h2>
                            <div class='table-responsive'>
                            <table class="table table-borderless table-striped table-earning">
    <thead>
        <tr>
            <th>Photo</th>
            <th>Nom</th>
            <th>Prénom</th>
            <th>Date de naissance</th>
            <th>Sexe</th>
            <th>Nationalité</th>
            <th>Année d'inscription</th>
            <th>Série</th>
        </tr>
    </thead>
    <tbody>
        <!-- Affichage des inscrits masculins -->
        <?php
        if ($result_hommes->num_rows > 0) {
            echo "<tr class='table-primary text-center fw-bold'>";
            echo "<td  colspan='7'>";
            echo"LES INSCRITS DE SEXE MASCULIN";
            echo "</td>";
            echo "</tr>";
            while ($row_homme = $result_hommes->fetch_assoc()) {
                echo "<tr>";
                echo "<td><img src='" . $row_homme["photo"] . "' alt='" . $row_homme["nom"] . " " . $row_homme["prenom"] . "' width='100'></td>";
                echo "<td>" . $row_homme["nom"] . "</td>";
                echo "<td>" . $row_homme["prenom"] . "</td>";
                echo "<td>" . $row_homme["date de naissance"] . "</td>";
                echo "<td>" . $row_homme["sexe"] . "</td>";
                echo "<td>" . $row_homme["nationalité"] . "</td>";
                echo "<td>" . $row_homme["anneeInscription"] . "</td>";
                echo "<td>" . $row_homme["serie"] . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='8'>Aucun inscrit masculin trouvé.</td></tr>";
        }
        ?>

        <!-- Affichage des inscrites féminins -->
        <?php
        if ($result_femmes->num_rows > 0) {
            echo "<tr class='table-danger text-center fw-bold'>";
            echo "<td  colspan='7'>";
            echo"LES INSCRITS DE SEXE FEMINiN";
            echo "</td>";
            echo "</tr>";
            while ($row_femme = $result_femmes->fetch_assoc()) {
                echo "<tr>";
                echo "<td><img src='" . $row_femme["photo"] . "' alt='" . $row_femme["nom"] . " " . $row_femme["prenom"] . "' width='100'></td>";
                echo "<td>" . $row_femme["nom"] . "</td>";
                echo "<td>" . $row_femme["prenom"] . "</td>";
                echo "<td>" . $row_femme["date de naissance"] . "</td>";
                echo "<td>" . $row_femme["sexe"] . "</td>";
                echo "<td>" . $row_femme["nationalité"] . "</td>";
                echo "<td>" . $row_femme["anneeInscription"] . "</td>";
                echo "<td>" . $row_femme["serie"] . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='8'>Aucun inscrit féminin trouvé.</td></tr>";
        }
        ?>
    </tbody>
</table>

                            </div>
                            <!-- END LISTE PAR SEXE -->
                            
                        </div>
                        <!-- liste par nationalité  -->
                        <div class="table-responsive">
                        <div class="container">
    <h2 class="my-4 text-center">Liste des candidats inscrits par nationalité</h2>
    <div class="row m-t-30">
        <div class="col-md-9">
            <!-- Tableau des candidats inscrits par nationalité -->
            <div class="table-responsive">
                <?php
                echo '<table class="table table-borderless table-striped table-earning">
                    <thead>
                        <tr>
                            <th>Photo</th>
                            <th>Nom</th>
                            <th>Prénom</th>
                            <th>Date de naissance</th>
                            <th>Sexe</th>
                            <th>Année d\'inscription</th>
                            <th>Série</th>
                        </tr>
                    </thead>
                    <tbody>';

                while ($row = $resultat3->fetch_assoc()) {
                    // Vérifier si la nationalité actuelle est différente de la précédente
                    if ($row["nationalité"] !== $nationalite_precedente) {
                        // Afficher l'en-tête pour la nouvelle nationalité
                        echo '<tr class="table-primary text-center fw-bold"><td colspan="7"> LES ELEVES DE NATIONALITE ' . $row["nationalité"] . '</td></tr>';
                        // Mettre à jour la nationalité précédente
                        $nationalite_precedente = $row["nationalité"];
                    }
                    // Afficher les informations de l'étudiant
                    echo '<tr>
                            <td><img src="' . $row["photo"] . '" alt="' . $row["nom"] . ' ' . $row["prenom"] . '" width="100"></td>
                            <td>' . $row["nom"] . '</td>
                            <td>' . $row["prenom"] . '</td>
                            <td>' . $row["date de naissance"] . '</td>
                            <td>' . $row["sexe"] . '</td>
                            <td>' . $row["anneeInscription"] . '</td>
                            <td>' . $row["serie"] . '</td>
                          </tr>';
                }

                echo '</tbody>
                    </table>';
                ?>
                <!-- END DATA TABLE-->
            </div>
        </div>
        <div class="col-md-3">
            <!-- Image de l'histogramme -->
            <a href="./histo.php">
                <img class='h-auto w-100' src="histo.php" alt="Histogramme des candidats inscrits par nationalité" class="img-fluid">
            </a>
        </div>
    </div>
</div>
>
                        <div>
                            <h2 class="my-4 text-center">Liste des candidats inscrits doublement</h2>
                            <div class="row">
                            <div class="col-lg-12">
                                <div class="table-responsive table--no-card m-b-30">
                                <table class="table table-borderless table-striped table-earning">
            <thead>
                <tr>
                    <th>Nombre s'inscriptions</th>
                    <th>Photo</th>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Date de naissance</th>
                    <th>Sexe</th>
                    <th>Nationalité</th>
                    <th>Année d'inscription</th>
                    <th>Série</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Vérifier s'il y a des résultats
                if ($result->num_rows > 0) {
                    // Afficher les données dans le tableau
                    while($row = $result4->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["nb_inscriptions"] . "</td>";
                        echo "<td><img src='" . $row["photo"] . "' alt='" . $row["nom"] . " " . $row["prenom"] . "' width='100'></td>";
                        echo "<td>" . $row["nom"] . "</td>";
                        echo "<td>" . $row["prenom"] . "</td>";
                        echo "<td>" . $row["date de naissance"] . "</td>";
                        echo "<td>" . $row["sexe"] . "</td>";
                        echo "<td>" . $row["nationalité"] . "</td>";
                        echo "<td>" . $row["anneeInscription"] . "</td>";
                        echo "<td>" . $row["serie"] . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "0 results";
                }
                
                ?>
            </tbody>
        </table>

                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="copyright">
                                    <p>Copyright © 2023 GodwinKassa. All rights reserved.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Jquery JS-->
    <script src="vendor/jquery-3.2.1.min.js"></script>
    <!-- Bootstrap JS-->
    <script src="vendor/bootstrap-4.1/popper.min.js"></script>
    <script src="vendor/bootstrap-4.1/bootstrap.min.js"></script>
    <!-- Vendor JS       -->
    <script src="vendor/slick/slick.min.js">
    </script>
    <script src="vendor/wow/wow.min.js"></script>
    <script src="vendor/animsition/animsition.min.js"></script>
    <script src="vendor/bootstrap-progressbar/bootstrap-progressbar.min.js">
    </script>
    <script src="vendor/counter-up/jquery.waypoints.min.js"></script>
    <script src="vendor/counter-up/jquery.counterup.min.js">
    </script>
    <script src="vendor/circle-progress/circle-progress.min.js"></script>
    <script src="vendor/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="vendor/chartjs/Chart.bundle.min.js"></script>
    <script src="vendor/select2/select2.min.js">
    </script>

    <!-- Main JS-->
    <script src="js/main.js"></script>

</body>

</html>
<!-- end document-->
