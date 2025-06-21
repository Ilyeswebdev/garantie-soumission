<div
    class="modal fade"
    id="modaldoc"
    tabindex="-1"
    aria-labelledby="exampleModalLabel"
    aria-hidden="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">ajouter document pour l'ammendment <strong style="color: red;" id="numero"></strong>
                </h5>
                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="index.php?page=amendment" enctype="multipart/form-data" method="post">
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">document</label>
                        <input
                            type="file"
                            class="form-control"
                            id=""
                            name="docam"
                            aria-describedby="codeHelp" />
                    </div>

                    <div class="mb-3">
                        <!-- <label for="exampleInputEmail1" class="form-label">garantie</label> -->
                        <input
                            type="text"
                            class="form-control"
                            id="numg"
                            name="numam"
                            hidden
                            aria-describedby="codeHelp" />
                    </div>
                    <input type='hidden' name='numg' value='<?php echo $numg ?>'>

                    <div class="modal-footer">
                        <button
                            type="button"
                            class="btn btn-secondary"
                            data-bs-dismiss="modal">
                            Fermer
                        </button>
                        <button type="submit" class="btn btn-primary" name="ajouterdocument">
                            ajouter document
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>