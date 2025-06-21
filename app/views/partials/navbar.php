<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>navbar</title>



</head>
<style>

</style>

<body>

  <nav class="navbar navbar-expand-lg navbar-light fixed-top">
    <div class="container-fluid">
      <!-- Brand -->
      <a class="navbar-brand" href="index.php">HOME</a>


      <div class="d-flex ms-auto align-items-center">
        <span class="navbar-text text-primary me-3">
          <?php echo $_SESSION['username']; ?>
        </span>
        <a href="?page=logout" class="btn btn-outline-primary btn-sm">déconnexion</a>
      </div>
  </nav>
</body>

</html>