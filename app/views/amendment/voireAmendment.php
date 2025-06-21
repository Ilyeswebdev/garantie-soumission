<div class="modal-body">
    <div class="d-flex justify-content-between">
        <h3 class="mb-3">Voire L'ammendment pour la garantie :
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
    <!-- 
    <a href="?page=ajouterauthentification">
        <button
            type="submit"
            name="retour"
            type="button"
            class="btn btn-primary ">
            <img height="25" width="25" src="icons\box-arrow-left.svg" alt="">
            Ajouter une authentification
        </button>
    </a> -->
    <?php if ($_SESSION['role'] === 1 || $_SESSION['role'] === 2) { ?>
        <?php if (empty($amendement)) {
            echo "<p  style='width: fit-content;'> cette garantie ne dispose pas d'un ammendment? :</p>
         <form style='width: fit-content;' class='my-2' action='?page=ajouteramendment' method='post'>
    <input type='hidden' name='numg' value='$numg'>
    <button style='color: white;' type='submit' class='auth action p-2' title='authentifier'>
        Ajouter un ammendment
        <img id='auth' class='action-icon' src='./icons/wrench.svg' width='22' height='22' alt='suprimer'>
    </button>
</form>
 ";
        }  ?>
    <?php } ?>

    <form id="form" action="index.php?page=amendment" enctype="multipart/form-data" method="post">
        <div class="mb-3">

            <label for="numauth" class="form-label">numero d'amendement</label>
            <input
                type="text"
                class="form-control"
                id="numam"
                readonly
                placeholder="numero d'amendement"
                name="numam"
                <?php foreach ($amendement as $am) {
                ?>
                <?php echo "value='" . htmlspecialchars($am['num_AM']) . "'";
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
                id="typeam"
                readonly
                placeholder="numero d'amendement"
                name="typeam"
                <?php foreach ($amendement as $am) {
                ?>
                <?php echo "value='" . htmlspecialchars($am['designation_typeAM']) . "'";
                ?>
                <?php };
                ?> />
            </select>

        </div>
        <div class="mb-3">
            <label for="dateauth" class="form-label">date d'amendement </label>
            <input
                type="date"
                readonly
                class="form-control"
                id="dateauth"
                name="dateam"
                <?php foreach ($amendement as $am) {
                ?>
                <?php echo "value='" . htmlspecialchars($am['date_amendment']) . "'";
                ?>
                <?php };
                ?> />



        </div>
        <div class="mb-3">
            <label for="datedepo" class="form-label"> date de progation d'ammendment </label>
            <input
                type="date"
                placeholder="username"
                readonly
                class="form-control"
                id="datedepo"
                name="datepro"
                <?php foreach ($amendement as $am) {
                ?>
                <?php echo "value='" . htmlspecialchars($am['date_progation']) . "'";
                ?>
                <?php };
                ?> />



        </div>
        <div class="mb-3">

            <label for="numauth" class="form-label">montant :</label>
            <input
                type="number"
                class="form-control"
                id="numam"
                readonly
                placeholder="montant"
                name="montant"
                <?php foreach ($amendement as $am) {
                ?>
                <?php echo "value='" . htmlspecialchars($am['montant_AM']) . "'";
                ?>
                <?php };
                ?> />



        </div>
        <div class="mb-3">

            <label for="obs" class="form-label">observation:</label>
            <!-- <input
                type="text"
                class="form-control"
                id="numam"

                placeholder="montant"
                name="numam"
             /> -->
            <textarea class="form-control" id="obs" name="obs" readonly>
            <?php foreach ($amendement as $am) {
            ?>
                <?php echo htmlspecialchars(trim($am['observation']));
                ?>
                <?php };
                ?> 
            </textarea>

            <label for="docauth" class="form-label"> document d'ammendment</label>
            <?php
            if (isset($documentam)) {
                foreach ($documentam as $document) {
                    echo " <div class='inline-container'>
                <a  target='_blank' class='link' href='" . $document['chemin_AM'] . "'>" . $document['nom_AM'] . " </a>";
                    if ($_SESSION['role'] === 1 || $_SESSION['role'] === 2) {
                        echo " <button   class='supp action'  type='submit' name='sup' value='" . $document['code_DAM'] . " '> 
                <img id='supp' class='action-icon' src='./icons/trash-fill.svg' width='12' height='12' alt='suprimer'>
                </button>
                </div>";
                    }
                }
            }
            ?>

            <?php if ($_SESSION['role'] === 1 || $_SESSION['role'] === 2) { ?>
                <div class="mb-3">
                    <label for="docauth" class="form-label"> autre document d'ammendment</label>
                    <input
                        type="file"
                        placeholder="document d'authentification"
                        class="form-control"
                        id="docauth"
                        name="docam"
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


                <button type="submit" id="submit" class="btn btn-primary" name="ajouterdocument">
                    Ajouter autre document d'authentification
                </button>
        </div>

    <?php } ?>


    </form>

</div>