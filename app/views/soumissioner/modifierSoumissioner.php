<h1>modifier Soumissioner :</h1>
<div class="modal-body">

    <form id="modif-form" action="?page=updatesoumissioner" method="post">
        <div class="mb-3">
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Pays :</label>
                <select class="form-select" name="payscode" id="pays">


                    <?php if (!empty($paysCode)):
                    ?>
                        <?php echo "<option  value='" . $paysCode . "'>{$pay1}</option>"
                        ?>
                    <?php endif;
                    ?>
                    <?php

                    foreach ($pays as $pay) {
                        echo "<option  value='" . $pay['code_pay'] . "'>" . $pay['designation_pays'] . "</option>";
                    }
                    ?>
                </select>

                <?php if (!empty($error['payscode'])): ?>
                    <small class=" help" id="codehelp"><?php echo htmlspecialchars($error['payscode']); ?></small>
                <?php endif; ?>

            </div>

            <div class="mb-3">
                <label for="numregistre" class="form-label">num registre :</label>
                <input
                    type="text"
                    placeholder="num registre"
                    class="form-control"
                    id="numregistre"
                    name="numregistre"
                    <?php if (!empty($numRegistre)): ?>
                    <?php echo " value='" . htmlspecialchars(trim($numRegistre)) . "'" ?>
                    <?php endif; ?> />

                <?php if (!empty($error['numregistre'])): ?>
                    <small class="help" id="codehelp"><?php echo htmlspecialchars($error['numregistre']); ?></small>
                <?php endif; ?>

            </div>
            <div class="mb-3">
                <label for="nom" class="form-label">nom soumissioner :</label>
                <input
                    type="text"
                    placeholder="nom soumissioner"
                    class="form-control"
                    id="nom"
                    name="nom"
                    <?php if (!empty($nom)): ?>
                    <?php echo " value='" . htmlspecialchars(trim($nom)) . "'" ?>
                    <?php endif; ?> />

                <?php if (!empty($error['nom'])): ?>
                    <small class="help" id="codehelp"><?php echo htmlspecialchars($error['nom']); ?></small>
                <?php endif; ?>

            </div>


            <input
                type="hidden"
                class="form-control"
                id="modif-id"
                name="modif-id"
                <?php if (!empty($id)): ?>
                <?php echo " value='" . htmlspecialchars(trim($id)) . "'" ?>
                <?php endif; ?> />
            <input
                type="hidden"
                class="form-control"
                id="modif-id"
                name="update" />
            <input
                type="hidden"
                class="form-control"
                id="modif-id"
                name="pay"
                <?php if (!empty($pay1)): ?>
                <?php echo " value='" . htmlspecialchars($pay1) . "'" ?>
                <?php endif; ?> />


            <div class="modal-footer">

                <button type="submit" class="btn btn-success" name="modifier">
                    Modifier
                </button>
            </div>
    </form>
</div>