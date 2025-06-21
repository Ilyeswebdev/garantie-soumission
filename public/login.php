<?php

?>


<!DOCTYPE html>
<html lang="en">

<head>
  <link rel="stylesheet" href="assets\css\bootstrap.min.css">
</head>


<style>
  body {
    display: flex;
    justify-content: center;
    align-items: center;
    /* background-color: rgba(126, 126, 126, 0.3); */
    background-image: url('../public/documents/bkg.jpg');
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    height: 80vh;
  }


  small {
    color: red;
  }

  .login-container {
    width: 500px;
    border: 1px solid rgb(159, 159, 159);
    border-radius: 4px;
    box-shadow: 2px 2px 6px rgba(136, 136, 136, 0.427);
    padding: 10px;
    margin-top: 10%;
    background-color: white;
  }
</style>
</head>

<body>

  <div class="login-container">
    <form action="index.php?page=login" method="POST">
      <div class="form-group">
        <label for="password">nom d’utilisateur:</label>
        <input
          name="username"
          type="text"
          class="form-control"
          id="username"
          placeholder="nom d’utilisateur" />
        <small id="email-help">
          <?php

          if (isset($_GET['error'])) {
            $error = $_GET['error'];
            if ($error === 'u') {
              echo "Veuillez saisir un nom d’utilisateur.";
            } elseif ($error === 'u1') {
              echo "cette utilisateur nexisre pas ";
            }
          } ?>
        </small>
      </div>
      <div class="form-group mb-2">
        <label for="password">mot de passe</label>
        <input
          name="password"
          type="password"
          class="form-control"
          id="password"
          placeholder="*****  " />
        <small id="password-help">
          <?php if (isset($_GET['error'])) {
            $error = $_GET['error'];
            if ($error === 'p') {
              echo "remplire ce shamp";
            } elseif ($error === 'p1') {
              echo "mot de passe incorect";
            }
          } ?>
        </small>
      </div>

      <strong style="color: red;">
        <?php if (isset($_GET['error'])) {
          $error = $_GET['error'];
          if ($error === 'a') {
            echo "ce compte est inactif veuillez consulter l'administrateur";
          }
        } ?></strong>

      <button type="submit" name="submit" id="login-btn" class="btn btn-primary mt-2">
        Login
      </button>
    </form>
  </div>

  <script src="assets\js\bootstrap.bundle.min.js"></script>
</body>

</html>