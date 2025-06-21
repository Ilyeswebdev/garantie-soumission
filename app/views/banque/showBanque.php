<?php

include 'suprimerBanque.php';

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Banque</title>
    <!-- <link rel="stylesheet" href="index.css"> -->

</head>

<body>
    <button
        type="button"
        class="btn btn-primary m-2">
        <a href="?page=insertbanque" role="button">Ajouter une Banque</a>
    </button>


    <!-- TABLE -->



    <h1>liste des Banques :</h1>
    <table class="table table-bordered table-hover">
        <thead class="table-dark">
            <tr>
                <th scope="col">nom banque</th>
                <th scope="col">address</th>
                <th scope="col">Agences</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>


            <?php foreach ($banques as $banque) { ?>

                <tr>
                    <td><?php echo htmlspecialchars($banque['nom_banque']) ?> </td>
                    <td><?php echo htmlspecialchars($banque['adress_banque']) ?> </td>
                    <td>
                        <?php
                        echo "<form class='modif'  action='?page=agence' method='POST'>
                               
                                <input type='hidden' name='banque-id' value='{$banque['code_bank']}'>
                                <input type='hidden' name='banque-nom' value='{$banque['nom_banque']}'>
                                <button type='submit' class='mod action' title='voire agences'><img src='./icons/bank2.svg' class='action-icon' width='25' height='25' alt='voireagences'> </button>
                            </form>
                        ";
                        ?>
                    </td>
                    <td>

                        <?php
                        echo "<form class='modif'  action='?page=updatebanque' method='POST'>
                        <input type='hidden' name='code' value='{$banque['nom_banque']}'>
                        <input type='hidden' name='designation' value='{$banque['adress_banque']}'>
                        <input type='hidden' name='modif-id' value='{$banque['code_bank']}'>
                        <button type='submit' class='mod action' title='modifier'> <img src='./icons/pencil-square.svg' class='action-icon' width='25' height='25' alt='modifier'></button>
                    </form>
";
                        ?>
                        <button class='supp action' title='supprimer'
                            data-code='<?php echo htmlspecialchars($banque['nom_banque']) ?>'
                            data-id='<?php echo htmlspecialchars($banque['code_bank']) ?>'>
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



        <?php
        ?>
</body>

</html>