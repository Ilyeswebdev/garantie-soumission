<div class="modal-body">
    <h1 class="mb-3">ajouter utilisateurs</h1>
    <form id="form" action="index.php?page=ajouterutilisateurs" method="post">
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">nom</label>
            <input
                type="text"
                class="form-control"
                id="nom"
                aria-describedby="nomHelp"
                placeholder="nom"
                name="nom"
                <?php if (!empty($nom)): ?>
                <?php echo " value='" . htmlspecialchars(trim($nom)) . "'" ?>
                <?php endif; ?> />

            <?php if (!empty($error['nom'])): ?>
                <small class=" help" id="codehelp"><?php echo htmlspecialchars($error['nom']); ?></small>
            <?php endif; ?>

        </div>

        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">prenom:</label>
            <input
                type="text"
                placeholder="prenom"
                class="form-control"
                id="prenom"
                name="prenom"
                <?php if (!empty($prenom)): ?>
                <?php echo " value='" . htmlspecialchars(trim($prenom)) . "'" ?>
                <?php endif; ?> />

            <?php if (!empty($error['prenom'])): ?>
                <small class="help" id="codehelp"><?php echo htmlspecialchars($error['prenom']); ?></small>
            <?php endif; ?>

        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">username:</label>
            <input
                type="text"
                placeholder="username"
                class="form-control"
                id="username"
                name="username"
                <?php if (!empty($username)): ?>
                <?php echo " value='" . htmlspecialchars(trim($username)) . "'" ?>
                <?php endif; ?> />

            <?php if (!empty($error['username'])): ?>
                <small class="help" id="codehelp"><?php echo htmlspecialchars($error['username']); ?></small>
            <?php endif; ?>

        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">mot de passe :</label>
            <input
                type="password"
                placeholder="password"
                class="form-control"
                id="password"
                name="password" />

            <?php if (!empty($error['password'])): ?>
                <small class="help" id="codehelp"><?php echo htmlspecialchars($error['password']); ?></small>
            <?php endif; ?>

        </div>
        <div class="mb-3">
            <label for="confirmpassword" class="form-label">confirmer mot de passe :</label>
            <input
                type="password"
                placeholder="mot de passe"
                class="form-control"
                id="confirmpassword"
                name="confirmpassword" />

            <?php if (!empty($error['confirmpassword'])): ?>
                <small class="help" id="codehelp"><?php echo htmlspecialchars($error['confirmpassword']); ?></small>
            <?php endif; ?>

        </div>






        <label for="role">role :</label>
        <select class="form-select" name="role" id="role">
            <option id="role" value="-1">Choisire role:</option>
            <?php foreach ($roles as $role) {
                echo "<option value='{$role['id']} '>{$role['label']}  </option>";
            ?>

            <?php } ?>
        </select>

        <?php if (!empty($error['role'])): ?>
            <small class=" help" id="codehelp"><?php echo htmlspecialchars($error['role']); ?></small>
        <?php endif; ?>
</div>

<button type="submit" id="submit" class="btn btn-primary" name="ajouter">
    Ajouter
</button>
</div>




</form>
</div>