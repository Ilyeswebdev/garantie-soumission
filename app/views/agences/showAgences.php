<?php

include 'suprimerAgences.php';

?>

<!DOCTYPE html>
<html lang="en">



<body>
    <div class="d-flex justify-content-between">
        <form action="?page=insertagence" method="post">
            <input type="hidden" name="banque-id" value="<?php echo $banqueId ?>">
            <input type="hidden" name="banque-nom" value="<?php echo $banqueNom ?>">
            <button
                type="submit"
                class="btn btn-primary m-2">
                Ajouter une Agence
            </button>
        </form>

        <a href="?page=banque">
            <button
                type="submit"
                name="retour"
                type="button"
                class="btn btn-success ">
                <img height="25" width="25" src="icons\box-arrow-left.svg" alt="">
                Retour vers banques
            </button>
        </a>
    </div>
    <!-- TABLE -->



    <h1>liste des Agence pour la banque <b style="color: red;"><?php echo $banqueNom ?> </b> :</h1>
    <table class="table table-bordered table-hover">
        <thead class="table-dark">
            <tr>

                <th scope="col">desigation</th>
                <th scope="col">address</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>


            <?php foreach ($agences as $agence) { ?>

                <tr>
                    <td><?php echo htmlspecialchars($agence['adress_AG']) ?> </td>
                    <td><?php echo htmlspecialchars($agence['designation_AG']) ?> </td>
                    <td>

                        <?php
                        echo "<form class='modif'  action='?page=updateagence' method='POST'>
                        <input type='hidden' name='code' value='{$agence['adress_AG']}'>
                        <input type='hidden' name='designation' value='{$agence['designation_AG']}'>
                        <input type='hidden' name='modif-id' value='{$agence['code_AG']}'>
                        <input type='hidden' name='banque-id' value='{$banqueId}'>
                        <input type='hidden' name='banque-nom' value='{$banqueNom}'>
                        <button type='submit' class='mod action' title='modifier'> <img src='./icons/pencil-square.svg' class='action-icon' width='25' height='25' alt='modifier'></button>
                    </form>
";
                        ?>
                        <button class='supp action' title='supprimer'
                            data-code='<?php echo htmlspecialchars($agence['designation_AG']) ?>'
                            data-id='<?php echo htmlspecialchars($agence['code_AG']) ?>'>
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