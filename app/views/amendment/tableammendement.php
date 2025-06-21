<?php

include 'suprimerAmmendment.php';
include 'ajouterDocumentAmmendment.php';
?>

<body>




    <!-- TABLE -->

    <div class="d-flex justify-content-between">
        <h3 class="mb-3">Voire Les ammendment pour la garantie :
            <?php echo "<strong  style='color: red;'>$numg</strong>" ?></h3>

        <a href="?page=garantie">
            <button
                type="submit"
                name="retour"
                type="button"
                class="btn btn-success ">
                <img height="25" width="25" src="icons\box-arrow-left.svg" alt="">
                Retour vers garanties
            </button>
        </a>
    </div>
    <?php if ($_SESSION['role'] === 1 || $_SESSION['role'] === 2) { ?>
        <!-- <button
            type="button"
            class="btn btn-primary m-2">
            <a href="?page=insertgarantie" role="button">Ajouter un ammendment</a>
        </button> -->
        <form style='width: fit-content;' class='my-2' action='?page=ajouteramendment' method='post'>
            <input type='hidden' name='numg' value='<?php echo $numg ?>'>
            <button style='color: white;' type='submit' class='auth action p-2' title='authentifier'>
                Ajouter un ammendment
                <img id='auth' class='action-icon' src='./icons/wrench.svg' width='22' height='22' alt='suprimer'>
            </button>
        </form>
    <?php } ?>

    <div class="table-responsive">
        <table class="table border table-hover mt-3">
            <thead class="table-dark ">
                <tr>
                    <th class="border" scope="col">numero AM</th>
                    <th class="border" scope="col">type</th>
                    <th class="border" scope="col">date AM</th>
                    <th class="border" scope="col">date progation AM</th>
                    <th class="border" scope="col">montant :</th>
                    <th class="border" scope="col">observation:</th>

                    <th class="border" scope="col">document</th>


                    <?php if ($_SESSION['role'] === 1 || $_SESSION['role'] === 2) { ?>
                        <th class="border" scope="col"> Actions</th>
                    <?php } ?>
                </tr>
            </thead>
            <tbody>

                <?php
                // print_r($documents);

                foreach ($amendements as $amendement) { ?>

                    <tr>
                        <td><?php echo htmlspecialchars($amendement['num_AM']) ?> </td>
                        <td><?php echo htmlspecialchars($amendement['designation_typeAM']) ?> </td>
                        <td><?php echo htmlspecialchars($amendement['date_amendment']) ?> </td>
                        <td><?php echo htmlspecialchars($amendement['date_progation']) ?> </td>
                        <td><?php echo htmlspecialchars($amendement['montant_AM']) ?> </td>
                        <td><?php echo htmlspecialchars($amendement['observation']) ?> </td>

                        <td>
                            <!-- <form class="form-btn" action="?page=garantie" method="post">
                                <input type="hidden" name="numg" value="<?php echo htmlspecialchars($amendement['num_AM'])  ?>">
                                <button title="voire documents" class="auth action" type="submit">
                                    <img class='action-icon' src='./icons/file-earmark-arrow-down.svg' width='22' height='22' alt='voire documents'>
                                </button>
                            </form> -->

                            <?php if ($_SESSION['role'] === 1 || $_SESSION['role'] === 2) { ?>

                                <button class='add action' title='ajouter document ammendment'
                                    data-id='<?php echo htmlspecialchars($amendement['num_AM']) ?>'>
                                    <img id='supp' class='action-icon' src='./icons/file-earmark-plus-fill.svg' width='22' height='22' alt='ajouter document garantie'>
                                </button>
                            <?php } ?>
                            <br>
                            <?php
                            if (isset($documentsam)) {
                                foreach ($documentsam as $document) {
                                    if ($amendement['num_AM'] === $document['amendmentnum_AM']) {

                                        // echo "<a  target='_blank' class='link' href='" . $document['chemin_G'] . "'>" . $document['nom_G'] . " </a>";
                                        echo "
                                        <div class='inline-container mt-1'>
                                        <a  target='_blank' class='link' href='" . $document['chemin_AM'] . "'>" . $document['nom_AM'] . " </a>
                                        <form class='form-btn ' class='px-5' action='?page=deletDocumentammendement' method='post'> 
                                        ";

                                        if ($_SESSION['role'] === 1 || $_SESSION['role'] === 2) {

                                            echo "<input type='hidden' name='numg' value='{$numg}'>
                                            <button  class='action supp-doc' title=' suprimer  document " . $document['nom_AM'] . "'   type='submit' name='supp-doc' value='" . $document['code_DAM'] . " '> 
                                         <img id='supp' class='action-icon' src='./icons/trash.svg' alt='suprimer'>
                                         </button>
                                         </form>
                                          </div>
                                        ";
                                        }
                                    } else {
                                        //  echo "";
                                    }
                                }
                            }


                            ?>
                        </td>

                        <?php if ($_SESSION['role'] === 1 || $_SESSION['role'] === 2) { ?>
                            <td>
                                <?php
                                echo "<form class='modif'  action='?page=modifammendment' method='POST'>
                        <input type='hidden' name='numam' value='{$amendement['num_AM']}'>
                        <input type='hidden' name='typeamdeg' value='{$amendement['designation_typeAM']}'>
                        <input type='hidden' name='typeam' value='{$amendement['type_amendmentcode_typeAM']}'>
                        <input type='hidden' name='dateam' value='{$amendement['date_amendment']}'>
                        <input type='hidden' name='datepro' value='{$amendement['date_progation']}'>
                        <input type='hidden' name='montant' value='{$amendement['montant_AM']}'>
                        <input type='hidden' name='obs' value='{$amendement['observation']}'>
                        <input type='hidden' name='numg' value='{$numg}'>
                        <button type='submit' class='mod action' title='modifier'> <img src='./icons/pencil-square.svg' class='action-icon' width='25' height='25' alt='modifier'></button>
                    </form>";
                                ?>
                                <button class='supp action' title='supprimer'
                                    data-nom='<?php echo htmlspecialchars($amendement['num_AM']) ?>'
                                    data-id='<?php echo htmlspecialchars($amendement['num_AM']) ?>'>
                                    <img id='supp' class='action-icon' src='./icons/trash-fill.svg' width='22' height='22' alt='suprimer'>
                                </button>
                            </td>
                        <?php } ?>
                    </tr>

                <?php } ?>


                <?php


                ?>
            </tbody>
    </div>

    </div>

    <script>
        document.querySelectorAll(".supp").forEach((modBtn) => {
            modBtn.addEventListener("click", (e) => {
                // Prevent the default action
                const code = modBtn.getAttribute("data-nom");

                const id = modBtn.getAttribute("data-id");

                document.getElementById("supp-code").value = code;

                document.getElementById("supp-id").value = id;
                const myModal = new bootstrap.Modal(document.getElementById("modalsupp"));

                // Show the modal
                myModal.show();
            });
        });
        document.querySelectorAll(".add").forEach((modBtn) => {
            modBtn.addEventListener("click", (e) => {

                const id = modBtn.getAttribute("data-id");

                document.getElementById("numg").value = id;
                document.getElementById("numero").innerText = id;
                const myModal = new bootstrap.Modal(document.getElementById("modaldoc"));

                // Show the modal
                myModal.show();
            });
        });
    </script>