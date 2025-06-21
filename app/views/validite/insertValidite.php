<div class="modal-body">
    <h1>ajouter Validite</h1>
    <form id="form" action="index.php?page=insertvalidite" method="post">


        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">label</label>
            <input
                type="text"
                placeholder="label"
                class="form-control"
                id="designation"
                name="designation"
                <?php if (!empty($designation)): ?>
                <?php echo " value='" . htmlspecialchars(trim($designation)) . "'" ?>
                <?php endif; ?> />

            <?php if (!empty($error['designation'])): ?>
                <small class="help" id="codehelp"><?php echo htmlspecialchars($error['designation']); ?></small>
            <?php endif; ?>

        </div>


        <button type="submit" id="submit" class="btn btn-primary" name="ajouter">
            Ajouter
        </button>

    </form>
</div>