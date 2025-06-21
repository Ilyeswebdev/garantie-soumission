<?php


// if (isset($_GET['page'])) {
//   if ($_GET['page'] === 'monnaie') {
//     session_start();
//     $_SESSION['page'] = 'monnaie';

//     // header('location: index.php');
//   }
//   if ($_GET['page'] === 'garentie') {
//     session_start();
//     $_SESSION['page'] = 'garentie';
//     header('location: ../');
//   }
//   if ($_GET['page'] === 'consultergarentie') {
//     session_start();
//     $_SESSION['page'] = 'consultergarentie';
//     header('location: ../');
//   }
//   if ($_GET['page'] === 'document') {
//     session_start();
//     $_SESSION['page'] = 'document';
//     header('location: ../');
//   }
//   if ($_GET['page'] === 'banque') {
//     session_start();
//     $_SESSION['page'] = 'banque';
//     header('location: ../');
//   }
//   if ($_GET['page'] === 'structure') {
//     session_start();
//     $_SESSION['page'] = 'structure';
//     header('location: ../');
//   }
//   if ($_GET['page'] === 'soumissioner') {
//     session_start();
//     $_SESSION['page'] = 'soumissioner';
//     header('location: ../');
//   }
//   if ($_GET['page'] === 'authentification') {
//     session_start();
//     $_SESSION['page'] = 'authentification ';
//     header('location: ../');
//   }
//   if ($_GET['page'] === 'validite') {
//     session_start();
//     $_SESSION['page'] = 'validite';
//     header('location: ../');
//   }
//   if ($_GET['page'] === 'utilisateurs') {
//     session_start();
//     $_SESSION['page'] = 'utilisateurs';
//     header('location: ../');
//   }
//   if ($_GET['page'] === 'ajouterutilisateurs') {
//     session_start();
//     $_SESSION['page'] = 'ajouterutilisateurs';
//     header('location: ../');
//   }
// }

?>



<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="icons/card-list.svg" />

  <title>sidebar</title>
  <style>
    /* Optional: Styling for the sidebar */


    .sidebar {
      /* min-height: 100vh; */

      position: fixed;
      width: 200px;
      height: 100%;
      top: 56px;

      background-color: #010057;
      padding-top: 1rem;
    }

    .sidebar a {
      color: white;
      text-decoration: none;
      padding: 10px 15px;
      display: block;
    }

    .icon {
      margin-right: 10px;
    }

    .sidebar a:hover {
      background-color: #0f01d4;
      color: #ffffff;
    }

    .sidebar a:active {
      background-color: #e9ecef;
      color: #007bff;
    }

    .arrow {
      font-size: 0.9em;
      /* Slightly smaller than text */
      color: inherit;
      /* Same color as the text */
      margin-left: auto;
      /* Push arrow to the right */
    }

    a:hover .arrow {
      color: #007bff;
      /* Change color on hover for better interactivity */
    }

    .items {
      font-size: 14px;
    }
  </style>
</head>

<body>
  <!-- Sidebar -->
  <nav class="col-md-2.5 col-lg-1.5 d-md-block sidebar">
    <div class="position-sticky">
      <ul class="nav flex-column">
        <li class="nav-item">
          <a
            class="dropdown-toggle"
            data-bs-toggle="collapse" href="#itemsMenu" role="button" aria-expanded="false"
            aria-controls="itemsMenu">
            <img
              class="icon"
              src="icons\card-list.svg"
              width="20"
              height="20"
              alt="" />
            Garentie

          </a>
          <ul class="collapse list-unstyled ps-4" id="itemsMenu">
            <li><a href="?page=insertgarantie" class="items">Ajouter Garentie</a></li>
            <li><a href="?page=garantie" class="items">Consulter Garentie</a></li>
          </ul>
        </li>

        <!-- Utilisateurs -->

        <li class="nav-item">
          <a class="dropdown-toggle"
            data-bs-toggle="collapse" href="#utilisateursMenu" role="button" aria-expanded="false"
            aria-controls="utilisateursMenu">
            <img
              class="icon"
              src="icons\person-circle.svg"
              width="20"
              height="20"
              alt="" />
            utilisateurs
          </a>
          <ul class="collapse list-unstyled ps-4" id="utilisateursMenu">
            <li><a href="?page=utilisateurs" class="items">consulter Utilisateurs</a></li>
            <li><a href="?page=ajouterutilisateurs" class="items">Ajouter utilisateurs</a></li>
          </ul>
        </li>


        <li class="nav-item">
          <a class="nav-link" href="?page=banque">
            <img
              class="icon"
              src="icons\bank2.svg"
              width="20"
              height="20"
              alt="" />
            banque
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="?page=validite">
            <img
              class="icon"
              src="icons/stopwatch-fill.svg"
              width="20"
              height="20"
              alt="" />
            Valdite
          </a>
        </li>


        <li class="nav-item">
          <a class="nav-link" href="?page=monnaie">
            <img
              class="icon"
              src="icons/coin.svg"
              width="20"
              height="20"
              alt="" />
            Monnaie
          </a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="?page=soumissioner">
            <img
              class="icon"
              src="icons\construction-excavator-svgrepo-com.svg"
              width="20"
              height="20"
              alt="" />
            soumissioner
          </a>
        </li>


      </ul>
    </div>
  </nav>

  <!-- Main Content -->
</body>
<script>

</script>

</html>