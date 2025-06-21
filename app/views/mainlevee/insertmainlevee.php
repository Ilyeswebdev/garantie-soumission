<div class="modal-body">
    <div class="d-flex justify-content-between">
        <h3 class="mb-3">ajouter une mainlevee pour la garantie :
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
    <form id="form" action="index.php?page=mainlevee" enctype="multipart/form-data" method="post">
        <div class="mb-3">

            <label for="numml" class="form-label">numero Mainlevée</label>
            <input
                type="text"
                class="form-control"
                id="numml"

                placeholder="numero Mainlevée"
                name="numml"
                <?php if (!empty($numml)):
                ?>
                <?php echo " value='" . htmlspecialchars(trim($numml)) . "'"
                ?>
                <?php endif;
                ?> />

            <?php if (!empty($error['numml'])): ?>
                <small class="help" id="codehelp">
                    <?php echo htmlspecialchars($error['numml']); ?></small>
            <?php endif; ?>

        </div>
        <!--    NUMERO GARANTIE  -->
        <input type="hidden" name="numg" value="<?php echo "$numg" ?>">



        <div class="col">
            <label for="typeml">type Mainlevée :</label>
            <select class="form-select" name="typeml" id="typeml">
                <option value="-1">Type :</option>
                <?php foreach ($types as $type) {
                    echo "<option value='{$type['code_typeML']} '>{$type['designation_typeML']}</option>";
                ?>

                <?php } ?>
            </select>
            <?php if (!empty($error['typeml'])): ?>
                <small class=" help" id="codehelp"><?php echo htmlspecialchars($error['typeml']); ?></small>
            <?php endif; ?>
        </div>
        <div class="mb-3">
            <label for="dateml" class="form-label">date de Mainlevée </label>
            <input
                type="date"

                class="form-control"
                id="dateml"
                name="dateml"
                <?php if (!empty($dateml)):
                ?>
                <?php echo " value='" . htmlspecialchars(trim($dateml)) . "'"
                ?>
                <?php endif;
                ?> />

            <?php if (!empty($error['dateml'])):
            ?>
                <small class="help" id="codehelp"><?php echo htmlspecialchars($error['dateml']);
                                                    ?></small>
            <?php endif;
            ?>

        </div>

        <div class="mb-3">

            <label for="montant" class="form-label">montant :</label>
            <input
                type="number"
                class="form-control"
                id="montant"

                placeholder="montant"
                name="montant"
                <?php if (!empty($montant)):
                ?>
                <?php echo " value='" . htmlspecialchars(trim($montant)) . "'"
                ?>
                <?php endif;
                ?> />

            <?php if (!empty($error['montant'])): ?>
                <small class="help" id="codehelp">
                    <?php echo htmlspecialchars($error['montant']); ?></small>
            <?php endif; ?>

        </div>
        <div class="mb-3">

            <label for="obs" class="form-label">observation:</label>

            <textarea class="form-control" id="obs" name="obs" rows="3">
            <?php if (!empty($obs)):
            ?>
                <?php echo   htmlspecialchars(trim($obs))
                ?>
                <?php endif;
                ?> 
            </textarea>


            <div class="mb-3">
                <label for="docml" class="form-label"> document de Mainlevée </label>
                <input
                    type="file"
                    placeholder="document de Mainlevée"
                    class="form-control"
                    id="docml"
                    name="docml" />

                <?php if (!empty($error['userfile'])):
                ?>
                    <small class="help" id="codehelp"><?php
                                                        echo htmlspecialchars($error['userfile']);
                                                        ?></small>
                <?php
                endif;
                ?>

            </div>


            <button type="submit" id="submit" class="btn btn-primary" name="mainlevee" value="ajouter">
                Ajouter
            </button>
        </div>




    </form>
</div>