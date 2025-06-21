<?php

include 'suprimerGarantie.php';
include 'ajouterDocumentGarantie.php';
?>

<body>
    <?php if ($_SESSION['role'] === 1 || $_SESSION['role'] === 2) { ?>
        <button
            type="button"
            class="btn btn-primary m-2">
            <a href="?page=insertgarantie" role="button">Ajouter une Garanties</a>
        </button>
    <?php } ?>



    <!-- TABLE -->



    <h1>liste des Garantie :</h1>
    <div class="table-responsive">
        <table class="table border table-hover mt-3">
            <thead class="table-dark ">
                <tr>
                    <th class="border" scope="col">num garentie</th>
                    <th class="border" scope="col">reference_AO</th>
                    <th class="border" scope="col">montant</th>
                    <th class="border" scope="col">Monnaie</th>
                    <th class="border" scope="col">DateDepo</th>
                    <th class="border" scope="col">DateEchu</th>
                    <th class="border" scope="col">agence</th>
                    <th class="border" scope="col">soumissioner</th>
                    <th class="border" scope="col">document</th>
                    <th class="border" scope="col"> Actions</th>

                    <?php if ($_SESSION['role'] === 1 || $_SESSION['role'] === 2) { ?>
                        <th class="border" scope="col">suprimer</th>
                    <?php } ?>
                </tr>
            </thead>
            <tbody>

                <?php
                // print_r($documents);

                foreach ($garanties as $garantie) { ?>

                    <tr>
                        <td><?php echo htmlspecialchars($garantie['num_G']) ?> </td>
                        <td><?php echo htmlspecialchars($garantie['reference_AO']) ?> </td>
                        <td><?php echo htmlspecialchars($garantie['montant']) ?> </td>
                        <td><?php echo htmlspecialchars($garantie['monnaie']) ?> </td>
                        <td><?php echo htmlspecialchars($garantie['date_depo']) ?> </td>
                        <td><?php echo htmlspecialchars($garantie['date_Echu']) ?> </td>
                        <td><?php echo htmlspecialchars($garantie['agence']) ?> </td>
                        <td><?php echo htmlspecialchars($garantie['soumissioner']) ?> </td>
                        <td>
                            <form class="form-btn" action="?page=garantie" method="post">
                                <input type="hidden" name="numg" value="<?php echo htmlspecialchars($garantie['num_G'])  ?>">
                                <button title="voire documents" class="auth action" type="submit">
                                    <img class='action-icon' src='./icons/file-earmark-arrow-down.svg' width='22' height='22' alt='voire documents'>
                                </button>
                            </form>

                            <?php if ($_SESSION['role'] === 1 || $_SESSION['role'] === 2) { ?>

                                <button class='add action' title='ajouter document garantie'
                                    data-id='<?php echo htmlspecialchars($garantie['num_G']) ?>'>
                                    <img id='supp' class='action-icon' src='./icons/file-earmark-plus-fill.svg' width='22' height='22' alt='ajouter document garantie'>
                                </button>
                            <?php } ?>
                            <br>
                            <?php
                            if (isset($documents)) {
                                foreach ($documents as $document) {
                                    if ($garantie['num_G'] === $document['garanienum_G']) {

                                        // echo "<a  target='_blank' class='link' href='" . $document['chemin_G'] . "'>" . $document['nom_G'] . " </a>";
                                        echo "
                                        <div class='inline-container mt-1'>
                                        <a  target='_blank' class='link' href='" . $document['chemin_G'] . "'>" . $document['nom_G'] . " </a>
                                        <form class='form-btn ' class='px-5' action='?page=deletDocumentegarantie' method='post'> 
                                        ";

                                        if ($_SESSION['role'] === 1 || $_SESSION['role'] === 2) {

                                            echo " <button  class='action supp-doc' title=' suprimer ce document " . $document['nom_G'] . "'   type='submit' name='supp-doc' value='" . $document['code_DG'] . " '> 
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
                        <td class="text-nowrap">

                            <form class="form-btn" action="?page=authentification" method="post">
                                <input type="hidden" name="numg" value="<?php echo htmlspecialchars($garantie['num_G']) ?>">
                                <button type="submit" class='auth action' title='authentifier'>

                                    <img id='auth' class='' src='./icons/clipboard-check-fill.svg' width='22' height='22' alt='suprimer'>
                                </button>
                            </form>

                            <form class="form-btn" action="?page=amendment" method="post">
                                <input type="hidden" name="numg" value="<?php echo htmlspecialchars($garantie['num_G']) ?>">
                                <button type="submit" class='auth action' title='Amender'>

                                    <img id='auth' class='action-icon' src='./icons/wrench.svg' width='22' height='22' alt='suprimer'>
                                </button>
                            </form>
                            <form class="form-btn" action="?page=mainlevee" method="post">
                                <input type="hidden" name="numg" value="<?php echo htmlspecialchars($garantie['num_G']) ?>">
                                <button type="submit" class='auth action' name="mainlevee" value="show" title='main levee'>

                                    <img id='auth' class='action-icon' src='./icons/hand1.svg' width='22' height='22' alt='suprimer'>
                                </button>
                            </form>
                        </td>
                        <?php if ($_SESSION['role'] === 1 || $_SESSION['role'] === 2) { ?>
                            <td>
                                <button class='supp action' title='supprimer'
                                    data-nom='<?php echo htmlspecialchars($garantie['num_G']) ?>'
                                    data-id='<?php echo htmlspecialchars($garantie['num_G']) ?>'>
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
    <!-- <td>
                    <button class='table-square document' style='color:white;' title='ajouter document'
                    data-id='" . htmlspecialchars($row['id']) . "' >
                    <img class='table-img'  src='./icons/file-earmark-arrow-down.svg' alt='modifier'>
                    </button>
                    <a  target='_blank'>
                       
                        </a>
                        </td> -->
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