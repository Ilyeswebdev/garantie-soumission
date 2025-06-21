<?php
include 'suprimerMonnaie.php';
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>monnaie</title>
    <!-- <link rel="stylesheet" href="index.css"> -->

</head>

<body>
    <button
        type="button"
        class="btn btn-primary m-2">
        <a href="?page=insertmonnaie" role="button">Ajouter une monnaie</a>
    </button>


    <!-- TABLE -->



    <h1>liste des monnais :</h1>
    <table class="table table-bordered table-hover">
        <thead class="table-dark">
            <tr>
                <th scope="col">Code</th>
                <th scope="col">designation</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>


            <?php foreach ($monnaies as $monnaie) { ?>

                <tr>
                    <td><?php echo htmlspecialchars($monnaie['code_monnaie']) ?> </td>
                    <td><?php echo htmlspecialchars($monnaie['designation']) ?> </td>
                    <td>
                        <?php
                        echo "<form class='modif'  action='?page=updatemonnaie' method='POST'>
                        <input type='hidden' name='code' value='{$monnaie['code_monnaie']}'>
                        <input type='hidden' name='designation' value='{$monnaie['designation']}'>
                        <input type='hidden' name='modif-id' value='{$monnaie['cod_M']}'>
                        <button type='submit' class='mod action' title='modifier'> <img src='./icons/pencil-square.svg' class='action-icon' width='25' height='25' alt='modifier'></button>
                    </form>
";
                        ?>
                        <button class='supp action' title='supprimer'
                            data-code='<?php echo htmlspecialchars($monnaie['code_monnaie']) ?>'
                            data-id='<?php echo htmlspecialchars($monnaie['cod_M']) ?>'>
                            <img id='supp' class='action-icon' src='./icons/trash-fill.svg' width='22' height='22' alt='suprimer'>
                        </button>
                    </td>
                </tr>

            <?php } ?>
        </tbody>





        <script>
            document.addEventListener("DOMContentLoaded", () => {
                document.querySelectorAll(".supp").forEach((modBtn) => {
                    modBtn.addEventListener("click", (e) => {
                        // Prevent the default action

                        const code = modBtn.getAttribute("data-code");

                        const id = modBtn.getAttribute("data-id");

                        document.getElementById("supp-code").value = code;

                        document.getElementById("supp-id").value = id;
                        const myModal = new bootstrap.Modal(document.getElementById("modalsupp"));

                        // Show the modal
                        myModal.show();
                    });
                });
            });
        </script>




</body>

</html>