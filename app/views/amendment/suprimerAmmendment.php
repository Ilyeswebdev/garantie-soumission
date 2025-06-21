<div
    class="modal fade"
    id="modalsupp"
    tabindex="-1"
    aria-labelledby="exampleModalLabel"
    aria-hidden="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Êtes-vous sûr(e) de supprimer cette ammendment ?</h5>
                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="index.php?page=amendment" method="post">
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">ammendment</label>
                        <input
                            type="text"
                            class="form-control"
                            id="supp-code"
                            name="supp-code"
                            aria-describedby="codeHelp"
                            readonly />
                    </div>

                    <input type='hidden' name='numg' value='<?php echo $numg ?>'>

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
                        <button type="submit" class="btn btn-danger" name="suprimeramendment">
                            Suprimer
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>