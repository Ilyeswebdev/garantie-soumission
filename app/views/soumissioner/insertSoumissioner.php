<div class="modal-body">
    <h1>ajouter Soumissioner</h1>
    <form id="form" action="index.php?page=insertsoumissioner" method="post">
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Pays :</label>
            <select class="form-select" name="payscode" id="pays">
                <option value="-1">Choisire pays :</option>
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


        <button type="submit" id="submit" class="btn btn-primary" name="ajouter">
            Ajouter
        </button>

    </form>
</div>