<h1>modifier Banque :</h1>
<div class="modal-body">
    <form id="modif-form" action="?page=updatebanque" method="post">
        <div class="mb-3">
            <label for="modif-code" class="form-label">nom</label>
            <input
                type="text"
                class="form-control"
                id="modif-code"
                placeholder="nom"
                name="code"
                <?php if (!empty($code)): ?>
                <?php echo " value='" . htmlspecialchars(trim($code)) . "'" ?>
                <?php endif; ?> />

            <?php if (!empty($error['code'])): ?>
                <small class=" help" id="codehelp"><?php echo htmlspecialchars($error['code']); ?></small>
            <?php endif; ?>
            <!-- <small class="help" id="modif-codehelp"></small> -->
        </div>
        <div class="mb-3">
            <label for="designation" class="form-label">address</label>
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


        <div class="modal-footer">

            <button type="submit" class="btn btn-success" name="modifier">
                Modifier
            </button>
        </div>
    </form>
</div>