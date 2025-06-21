<div class="modal-body">
    <div class="d-flex justify-content-between">
        <h3 class="mb-3">ajouter une authentification pour la garantie :
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
    <form id="form" action="index.php?page=ajouterauthentification" enctype="multipart/form-data" method="post">
        <div class="mb-3">

            <label for="numauth" class="form-label">numero d'authentification</label>
            <input
                type="text"
                class="form-control"
                id="numauth"

                placeholder="numero d'authentification"
                name="numauth"
                <?php if (!empty($numauth)):
                ?>
                <?php echo " value='" . htmlspecialchars(trim($numauth)) . "'"
                ?>
                <?php endif;
                ?> />

            <?php if (!empty($error['numauth'])): ?>
                <small class="help" id="codehelp">
                    <?php echo htmlspecialchars($error['numauth']); ?></small>
            <?php endif; ?>

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
                <?php if (!empty($dateauth)):
                ?>
                <?php echo " value='" . htmlspecialchars(trim($dateauth)) . "'"
                ?>
                <?php endif;
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
                <?php if (!empty($datedepo)):
                ?>
                <?php echo " value='" . htmlspecialchars(trim($datedepo)) . "'"
                ?>
                <?php endif;
                ?> />

            <?php if (!empty($error['datedepo'])):
            ?>
                <small class="help" id="codehelp"><?php
                                                    echo htmlspecialchars($error['datedepo']);
                                                    ?></small>
            <?php
            endif;
            ?>

        </div>
        <div class="mb-3">
            <label for="docauth" class="form-label"> document d'authentification </label>
            <input
                type="file"
                placeholder="document d'authentification"
                class="form-control"
                id="docauth"
                name="docauth" />

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
            Ajouter
        </button>
</div>




</form>
</div>