<div class="modal-body">
    <div class="d-flex justify-content-between">
        <h3 class="mb-3">modifier amendement Num :
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
    <form id="form" action="index.php?page=modifammendment" enctype="multipart/form-data" method="post">
        <div class="mb-3">

            <label for="numauth" class="form-label">numero d'amendement</label>
            <input
                type="text"
                class="form-control"
                id="numam"
                readonly
                placeholder="numero d'amendement"
                name="numam"
                <?php if (!empty($numam)):
                ?>
                <?php echo " value='" . htmlspecialchars(trim($numam)) . "'"
                ?>
                <?php endif;
                ?> />

            <!-- <?php if (!empty($error['numam'])): ?>
                <small class="help" id="codehelp">
                    <?php echo htmlspecialchars($error['numam']); ?></small>
            <?php endif; ?> -->

        </div>
        <!--    NUMERO GARANTIE  -->
        <input type="hidden" name="numg" value="<?php echo "$numg" ?>">



        <div class="col">
            <label for="typeam">type:</label>
            <select class="form-select" name="typeam" id="typeam">
                <?php if (!empty($typeam)) {
                    echo " <option value=" . $typeam . ">" . $typeamdeg   . "</option>";
                } else {
                    echo "<option value='-1'>Type :</option>";
                }
                ?>

                <?php foreach ($types as $type) {
                    echo "<option value='{$type['code_typeAM']} '>{$type['designation_typeAM']}</option>";
                ?>

                <?php } ?>
            </select>
            <?php if (!empty($error['typeam'])): ?>
                <small class=" help" id="codehelp"><?php echo htmlspecialchars($error['typeam']); ?></small>
            <?php endif; ?>
        </div>
        <div class="mb-3">
            <label for="dateauth" class="form-label">date d'amendement </label>
            <input
                type="date"

                class="form-control"
                id="dateauth"
                name="dateam"
                <?php if (!empty($dateam)):
                ?>
                <?php echo " value='" . htmlspecialchars(trim($dateam)) . "'"
                ?>
                <?php endif;
                ?> />

            <?php if (!empty($error['dateam'])):
            ?>
                <small class="help" id="codehelp"><?php echo htmlspecialchars($error['dateam']);
                                                    ?></small>
            <?php endif;
            ?>

        </div>
        <div class="mb-3">
            <label for="datedepo" class="form-label"> date de progation d'ammendment </label>
            <input
                type="date"
                placeholder="username"
                class="form-control"
                id="datedepo"
                name="datepro"
                <?php if (!empty($datepro)):
                ?>
                <?php echo " value='" . htmlspecialchars(trim($datepro)) . "'"
                ?>
                <?php endif;
                ?> />

            <?php if (!empty($error['datepro'])):
            ?>
                <small class="help" id="codehelp"><?php
                                                    echo htmlspecialchars($error['datepro']);
                                                    ?></small>
            <?php
            endif;
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
            <!-- <input
                type="text"
                class="form-control"
                id="numam"

                placeholder="montant"
                name="numam"
           /> -->
            <textarea class="form-control" id="obs" name="obs" rows="3">
            <?php if (!empty($obs)):
            ?>
                <?php echo   htmlspecialchars(trim($obs));
                ?>
                <?php endif;
                ?> 
            </textarea>




            <button type="submit" class="btn btn-success" name="modifier">
                Modifier
            </button>
        </div>




    </form>
</div>