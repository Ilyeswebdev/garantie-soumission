<button
    type="button"
    class="btn btn-primary m-2">
    <a href="?page=ajouterutilisateurs" role="button">Ajouter un(e) utilisateur</a>
</button>


<!-- TABLE -->



<h1>liste des utilisateurs :</h1>
<table class="table table-bordered table-hover">
    <thead class="table-dark">
        <tr>
            <th scope="col">nom</th>
            <th scope="col">prenom</th>
            <th scope="col">username</th>
            <th scope="col">account</th>
            <th scope="col">role</th>
            <th scope="col">suprimmer</th>
        </tr>
    </thead>
    <tbody>


        <?php foreach ($utilisateurs as $utilisateur) { ?>

            <tr>
                <td><?php echo htmlspecialchars($utilisateur['nom']) ?> </td>
                <td><?php echo htmlspecialchars($utilisateur['prenom']) ?> </td>
                <td><?php echo htmlspecialchars($utilisateur['username']) ?> </td>
                <td><?php echo "<form method='POST' action='?page=updatestatus'>
                        <input type='hidden' name='id' value='" . $utilisateur['id'] . "'>
                        <input type='hidden' name='status' value='" . $utilisateur['account'] . "'>
                        <button class='status action ' id='status' title='appuyer pour changer leta de cette utilisateur' type='submit' name='account'>" .
                        ($utilisateur['account'] == 'active' ? 'active' : 'inactive') . "</button>
                    </form>" ?> </td>
                <td><?php echo htmlspecialchars(trim($utilisateur['label'])) ?> </td>
                <td>
                    <form action="?page=deleteuser" method="post">
                        <!-- <input type="text" name='id' value="<?php $utilisateur['id'] ?>"> -->
                        <button class='supp action' type='submit' name='sup' value='<?php echo $utilisateur['id'] ?> '>
                            <img id='supp' class='action-icon' src='./icons/trash-fill.svg' width='12' height='12' alt='suprimer'>
                        </button>
                    </form>
                </td>
            </tr>

        <?php } ?>
    </tbody>





    <script>
        document.addEventListener(" DOMContentLoaded", () => {
            document.querySelectorAll(".supp").forEach((modBtn) => {
                modBtn.addEventListener("click", (e) => {
                    // Prevent the default action

                    const code = modBtn.getAttribute("data-code");

                    const id = modBtn.getAttribute("data-id");

                    document.getElementById("supp-code").value = code;

                    document.getElementById("supp-id").value = id;
                    const myModal = new bootstrap.Modal(document.getElementById("modalsupp"));

                    // Show the modal
                    myModal.show();
                });
            });

            document.querySelector("status").classList.contains("active")
        });
    </script>