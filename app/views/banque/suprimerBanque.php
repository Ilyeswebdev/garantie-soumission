<div
    class="modal fade"
    id="modalsupp"
    tabindex="-1"
    aria-labelledby="exampleModalLabel"
    aria-hidden="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Êtes-vous sûr(e) de supprimer cette Banque ?</h5>
                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="index.php?page=deletebanque" method="post">
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">nom</label>
                        <input
                            type="text"
                            class="form-control"
                            id="supp-code"
                            aria-describedby="codeHelp"
                            disabled />
                    </div>



                    <input
                        type="hidden"
                        class="form-control"
                        id="supp-id"
                        name="supp-id" />


                    <div class="modal-footer">
                        <button
                            type="button"
                            class="btn btn-secondary"
                            data-bs-dismiss="modal">
                            Fermer
                        </button>
                        <button type="submit" class="btn btn-danger" name="supp">
                            Suprimer
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>