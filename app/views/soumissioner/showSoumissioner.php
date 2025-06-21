<?php

include 'suprimerSoumissioner.php';


?>






<button
    type="button"
    class="btn btn-primary m-2">
    <a href="?page=insertsoumissioner" role="button">Ajouter un Soumissioner</a>
</button>


<!-- TABLE -->



<h1>liste des Soumissioner :</h1>
<table class="table table-bordered table-hover">
    <thead class="table-dark">
        <tr>
            <th scope="col">nom </th>
            <th scope="col">num registre</th>
            <th scope="col">pays</th>
            <th scope="col">Actions</th>
        </tr>
    </thead>
    <tbody>


        <?php foreach ($soumissioners as $soumissioner) { ?>

            <tr>
                <td><?php echo htmlspecialchars($soumissioner['nom_som']) ?> </td>
                <td><?php echo htmlspecialchars($soumissioner['num_registre']) ?> </td>
                <td><?php echo htmlspecialchars($soumissioner['designation_pays']) ?> </td>
                <td>


                    <?php
                    echo "<form class='modif'  action='?page=updatesoumissioner' method='POST'>
                        <input type='hidden' name='payscode' value='{$soumissioner['code_pay']}'>
                        <input type='hidden' name='pay' value='{$soumissioner['designation_pays']}'>
                        <input type='hidden' name='numregistre' value='{$soumissioner['num_registre']}'>
                        <input type='hidden' name='nom' value='{$soumissioner['nom_som']}'>
                        <input type='hidden' name='modif-id' value='{$soumissioner['code_som']}'>
                        <button type='submit' class='mod action' title='modifier'> <img src='./icons/pencil-square.svg' class='action-icon' width='25' height='25' alt='modifier'></button>
                    </form>
";
                    ?>
                    <button class='supp action' title='supprimer'
                        data-id='<?php echo htmlspecialchars($soumissioner['code_som']) ?>'
                        data-code='<?php echo htmlspecialchars($soumissioner['nom_som']) ?>'>
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