<div class="modal-body">
    <div class="d-flex justify-content-between">
        <h3 class="mb-3">Voire L'authentification pour la garantie :
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

        <?php if (empty($authentification)) {
            echo "<p  style='width: fit-content;'> cette garantie ne dispose pas d'une authentification ? :</p>
         <form style='width: fit-content;' class='my-2' action='?page=ajouterauthentification' method='post'>
    <input type='hidden' name='numg' value='$numg'>
    <button style='color: white;' type='submit' class='auth action p-2' title='authentifier'>
        Ajouter une authentification
        <img id='auth' class='action-icon' src='./icons/clipboard-check-fill.svg' width='22' height='22' alt='suprimer'>
    </button>
</form>
 ";
        }  ?>
    <?php } ?>
    <form id="form" action="index.php?page=ajouterDocumentauthentification" enctype="multipart/form-data" method="post">
        <div class="mb-3">

            <label for="numauth" class="form-label">numero d'authentification</label>
            <input
                type="text"
                class="form-control"
                id="numauth"
                readonly
                placeholder="numero d'authentification"
                name="numauth"
                <?php foreach ($authentification as $auth) {
                ?>
                <?php echo "value='" . htmlspecialchars($auth['num_ANT']) . "'";
                ?>
                <?php };
                ?> />


        </div>
        <!--    NUMERO GARANTIE  -->
        <input type="hidden" name="numg" value="<?php echo "$numg" ?>">


        <div class="mb-3">
            <label for="dateauth" class="form-label">date d'authentification </label>
            <input
                type="date"

                class="form-control"
                id="dateauth"
                name="dateauth"
                readonly
                <?php foreach ($authentification as $auth) {
                ?>
                <?php echo "value='" . htmlspecialchars($auth['date_authentification']) . "'";
                ?>
                <?php };
                ?> />

            <?php if (!empty($error['dateauth'])):
            ?>
                <small class="help" id="codehelp"><?php echo htmlspecialchars($error['dateauth']);
                                                    ?></small>
            <?php endif;
            ?>

        </div>
        <div class="mb-3">
            <label for="datedepo" class="form-label"> date dépôt d'authentification </label>
            <input
                type="date"
                placeholder="username"
                class="form-control"
                id="datedepo"
                name="datedepo"
                readonly
                <?php foreach ($authentification as $auth) {
                ?>
                <?php echo "value='" . htmlspecialchars($auth['date_depo_authentification']) . "'";
                ?>
                <?php };
                ?> />


        </div>



        <!-- Documents Authentification  -->
        <label for="docauth" class="form-label"> document(s) d'authentification : </label>
        <?php
        if (isset($documentauth)) {
            foreach ($documentauth as $document) {
                echo " <div class='inline-container'>
                <a  target='_blank' class='link' href='" . $document['chemin_DA'] . "'>" . $document['nom_DA'] . " </a>";
                if ($_SESSION['role'] === 1 || $_SESSION['role'] === 2) {
                    echo " <button   class='supp action'  type='submit' name='sup' value='" . $document['code_DANT'] . " '> 
                <img id='supp' class='action-icon' src='./icons/trash-fill.svg' width='12' height='12' alt='suprimer'>
                </button>
                </div>";
                }
            }
        }
        ?>

        <?php if ($_SESSION['role'] === 1 || $_SESSION['role'] === 2) { ?>

            <div class="mb-3">
                <label for="docauth" class="form-label"> autre document </label>
                <input
                    type="file"
                    placeholder="document d'authentification"
                    class="form-control"
                    id="docauth"
                    name="docauth"
                    <?php
                    // if (!empty($datedepo)):
                    ?>
                    <?php
                    // echo " value='" . htmlspecialchars(trim($datedepo)) . "'"
                    ?>
                    <?php
                    // endif;

                    ?> />

                <?php if (!empty($error['userfile'])):
                ?>
                    <small class="help" id="codehelp"><?php
                                                        echo htmlspecialchars($error['userfile']);
                                                        ?></small>
                <?php
                endif;
                ?>

            </div>



            <button type="submit" id="submit" class="btn btn-primary" name="ajouter">
                Ajouter autre document d'authentification
            </button>
        <?php } ?>
</div>
</form>

</div>