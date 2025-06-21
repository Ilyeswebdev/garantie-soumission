<div class="modal-body">
    <h1>ajouter Banque</h1>
    <form id="form" action="index.php?page=insertbanque" method="post">
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">nom</label>
            <input
                type="text"
                class="form-control"
                id="code"
                aria-describedby="codeHelp"
                placeholder="nom"
                name="code"
                <?php if (!empty($code)): ?>
                <?php echo " value='" . htmlspecialchars(trim($code)) . "'" ?>
                <?php endif; ?> />

            <?php if (!empty($error['code'])): ?>
                <small class=" help" id="codehelp"><?php echo htmlspecialchars($error['code']); ?></small>
            <?php endif; ?>

        </div>

        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">address</label>
            <input
                type="text"
                placeholder="address"
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