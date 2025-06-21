<?php



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


      </ul>
    </div>
  </nav>

  <!-- Main Content -->
</body>
<script>

</script>

</html>