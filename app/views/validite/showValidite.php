<?php

include 'suprimerValidite.php';

?>




<button
    type="button"
    class="btn btn-primary m-2">
    <a href="?page=insertvalidite" role="button">Ajouter une monnaie</a>
</button>


<!-- TABLE -->



<h1>liste des Validite :</h1>
<table class="table table-bordered table-hover">
    <thead class="table-dark">
        <tr>

            <th scope="col">designation</th>
            <th scope="col">Actions</th>
        </tr>
    </thead>
    <tbody>


        <?php foreach ($valites as $valite) { ?>

            <tr>
                <td><?php echo htmlspecialchars($valite['disignation_validite']) ?> jours </td>

                <td>


                    <button class='supp action' title='supprimer'
                        data-code='<?php echo htmlspecialchars($valite['disignation_validite'])
                                    ?>'
                        data-id='<?php echo htmlspecialchars($valite['code_validite'])
                                    ?>'>
                        <img id='supp' class='action-icon' src='./icons/trash-fill.svg' width='22' height='22' alt='suprimer'>
                    </button>
                </td>
            </tr>

        <?php } ?>
    </tbody>





    <script>
        document.addEventListener("DOMContentLoaded", () => {
            // document.querySelectorAll(".mod").forEach((modBtn) => {
            //     modBtn.addEventListener("click", (e) => {
            //         // Prevent the default action
            //         const code = modBtn.getAttribute("data-code");
            //         const label = modBtn.getAttribute("data-label");
            //         const id = modBtn.getAttribute("data-id");

            //         document.getElementById("modif-code").value = code;
            //         document.getElementById("modif-label").value = label;
            //         document.getElementById("modif-id").value = id;
            //         const myModal = new bootstrap.Modal(
            //             document.getElementById("modalmodif")
            //         );

            //         // Show the modal
            //         myModal.show();
            //     });
            // });

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