<div class="modal-body">
    <div class="d-flex justify-content-between">
        <h3 class="mb-3">Voire La Mainlevée pour la garantie :
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

        <?php if (empty($mainlevee)) {
            echo "<p  style='width: fit-content;'> cette garantie ne dispose pas d'un ammendment? :</p>
         <form style='width: fit-content;' class='my-2' action='?page=mainlevee' method='post'>
    <input type='hidden' name='numg' value='$numg'>
    <button style='color: white;' type='submit' name='mainlevee' value='ajouterpage' class='auth action p-2' title='authentifier'>
        Ajouter une Mainlevée
        <img id='auth' class='action-icon' src='./icons/hand1.svg' width='22' height='22' alt='suprimer'>
    </button>
</form>
 ";
        }  ?>
    <?php } ?>

    <form id="form" action="index.php?page=mainlevee" enctype="multipart/form-data" method="post">
        <div class="mb-3">

            <label for="numml" class="form-label">numero Mainlevée</label>
            <input
                type="text"
                class="form-control"
                id="numml"

                readonly
                placeholder="numero Mainlevée"
                name="numml"
                <?php foreach ($mainlevee as $ml) {
                ?>
                <?php echo "value='" . htmlspecialchars($ml['num_ML']) . "'";
                ?>
                <?php };
                ?> />



        </div>
        <!--    NUMERO GARANTIE  -->
        <input type="hidden" name="numg" value="<?php echo "$numg" ?>">



        <div class="col">
            <label for="typeam">type:</label>
            <input
                type="text"
                class="form-control"
                id="typeml"
                readonly
                placeholder="numero d'amendement"
                name="typeml"
                <?php foreach ($mainlevee as $ml) {
                ?>
                <?php echo "value='" . htmlspecialchars($ml['type_mainleveecode_typeML']) . "'";
                ?>
                <?php };
                ?> />
            </select>

        </div>
        <div class="mb-3">
            <label for="dateml" class="form-label">date Mainlevée </label>
            <input
                type="date"
                readonly
                class="form-control"
                id="dateml"
                name="dateml"
                <?php foreach ($mainlevee as $ml) {
                ?>
                <?php echo "value='" . htmlspecialchars($ml['date_ML']) . "'";
                ?>
                <?php };
                ?> />



        </div>

        <div class="mb-3">

            <label for="montantml" class="form-label">montant :</label>
            <input
                type="number"
                class="form-control"
                id="montantml"
                readonly
                placeholder="montant"
                name="montantml"
                <?php foreach ($mainlevee as $ml) {
                ?>
                <?php echo "value='" . htmlspecialchars($ml['montant_ML']) . "'";
                ?>
                <?php };
                ?> />



        </div>
        <div class="mb-3">

            <label for="obs" class="form-label">observation:</label>

            <textarea class="form-control" id="obs" name="obs" readonly>
            <?php foreach ($mainlevee as $ml) {
            ?>
                <?php echo htmlspecialchars(trim($ml['observaation']));
                ?>
                <?php };
                ?> 
            </textarea>

            <label for="docauth" class="form-label"> document d'ammendment</label>
            <?php
            if (isset($documentMl)) {
                foreach ($documentMl as $document) {
                    echo " <div class='inline-container'>
                <a  target='_blank' class='link' href='" . $document['chemin_ML'] . "'>" . $document['nom_ML'] . " </a>";
                    if ($_SESSION['role'] === 1 || $_SESSION['role'] === 2) {
                        echo " <button   class='supp action'  type='submit' name='mainlevee' value='sup'> 
                    <input type='hidden' name='id' value='" . $document['code_DML'] . "'>
                <img id='supp' class='action-icon' src='./icons/trash-fill.svg' width='12' height='12' alt='suprimer'>
                </button>
                </div>";
                    }
                }
            }
            ?>
            <?php if ($_SESSION['role'] === 1 || $_SESSION['role'] === 2) { ?>
                <div class="mb-3">
                    <label for="docml" class="form-label"> autre document d'ammendment</label>
                    <input
                        type="file"
                        placeholder="document d'authentification"
                        class="form-control"
                        id="docml"
                        name="docml"
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


                <button type="submit" id="submit" class="btn btn-primary" name="mainlevee" value="ajouterdocument">
                    Ajouter autre document d'authentification
                </button>

            <?php } ?>



    </form>

</div>