<style>
    section {
        margin: 10px 5px;
    }

    small {
        color: red;
    }

    .hide {
        display: none;
    }

    input[type="number"]::-webkit-outer-spin-button,
    input[type="number"]::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }
</style>


<!-- DEBUT FORMULAIRE -->
<!-- 
  <a
    type="button"
    class="btn btn-info m-2 con"
    id="alertButton">

    Consulter Les Garentie
  </a> -->


<script>
    $(document).ready(function() {

        $('#banque').on('change', function() {
            var banque_id = $(this).val();
            console.log('changed');
            $.ajax({
                // url: 'load.php',
                url: '../app/controllers/load.php',
                type: 'POST',
                data: {
                    banque_id: banque_id
                },
                success: function(data) {
                    $('#agence').html(data);
                    console.log(data);
                }
            });
        });

    })
</script>
<h1>Ajout nouvelle garantie </h1>
<div class="response" id="response"></div>
<section>
    <form id="form" action="?page=insertgarantie" enctype="multipart/form-data" method="post">
        <div class="row">
            <div class="col">
                <label for="num-garentie">Num garentie:</label>
                <input
                    type="text"
                    class="form-control"
                    id="num-garentie"
                    placeholder="Num garentie"
                    name="num-garentie"
                    <?php if (!empty($numGarantie)): ?>
                    <?php echo " value='" . htmlspecialchars(trim($numGarantie)) . "'" ?>
                    <?php endif; ?> />
                <?php if (!empty($error['num-garentie'])): ?>
                    <small class=" help" id="codehelp"><?php echo htmlspecialchars($error['num-garentie']); ?></small>
                <?php endif; ?>
            </div>

            <div class="col">
                <label for="reference-ao">reference AO:</label>
                <input
                    id="ao"
                    name="ao"
                    type="text"
                    class="form-control"
                    placeholder="reference AO"
                    <?php if (!empty($AO)): ?>
                    <?php echo " value='" . htmlspecialchars(trim($AO)) . "'" ?>
                    <?php endif; ?> />
                <?php if (!empty($error['ao'])): ?>
                    <small class=" help" id="codehelp"><?php echo htmlspecialchars($error['ao']); ?></small>
                <?php endif; ?>
            </div>
        </div>
        <div class="row mt-1">
            <div class="col">
                <label for="montant"> Mentant:</label>
                <input
                    id="montant"
                    name="montant"
                    type="number"
                    placeholder="montant"
                    class="form-control"
                    <?php if (!empty($montant)): ?>
                    <?php echo " value='" . htmlspecialchars(trim($montant)) . "'" ?>
                    <?php endif; ?> />
                <?php if (!empty($error['montant'])): ?>
                    <small class=" help" id="codehelp"><?php echo htmlspecialchars($error['montant']); ?></small>
                <?php endif; ?>
            </div>
            <div class="col">
                <label for="monnaie">Monnaie :</label>
                <select class="form-select" id="monnaie" name="monnaie">
                    <option value="-1">Choisire monnaie :</option>
                    <?php foreach ($monnaies as $monnaie) {
                        echo "<option value='{$monnaie['cod_M']}'>{$monnaie['code_monnaie']}  {$monnaie['designation']}</option>";
                    ?>
                    <?php } ?>
                </select>

                <?php if (!empty($error['monnaiesId'])): ?>
                    <small class="help" id="codehelp"><?php echo htmlspecialchars($error['monnaiesId']); ?></small>
                <?php endif; ?>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <label for="date-depo">Date depo:</label>
                <input
                    type="date"
                    class="form-control num"
                    id="date-depo"
                    name="date-depo"
                    placeholder="date depo" />
                <?php if (!empty($error['datedepo'])): ?>
                    <small class=" help" id="codehelp"><?php echo htmlspecialchars($error['datedepo']); ?></small>
                <?php endif; ?>
            </div>

            <div class="col">
                <label class="mb-1" for="date-echu">Date Echu : </label>
                <br>

                <?php

                foreach ($validites as $row) {


                    echo "<div class='form-check form-check-inline'>
                    <input class='form-check-input' type='radio' name='validite' id='" . $row['code_validite'] . "' value='" . $row['disignation_validite'] . "'>
                   <label class='form-check-label' for='" . $row['code_validite'] . "'>" . $row['disignation_validite'] . " jours   .</label>
                  </div>";
                }
                ?>

                <br>
                <?php if (!empty($error['validite'])): ?>
                    <small class=" help" id="codehelp"><?php echo htmlspecialchars($error['validite']); ?></small>
                <?php endif; ?>
            </div>
        </div>

        <div class="row mt-2">



        </div>
        <div class="row mt-2">
            <div class="col">
                <label for="banque">Banque :</label>
                <select class="form-select" name="banque" id="banque">

                    <option value="-1">Choisire banque :</option>


                    <?php foreach ($banques as $banque) {
                        echo "<option value='{$banque['code_bank']} '>{$banque['nom_banque']} </option>";
                    }
                    ?>
                </select>

                <small id="banque-help"> </small>


            </div>

            <div class="col">
                <label for="agence">Agences :</label>


                <select class="form-select" name="agence" id="agence">
                    <option value="-1">Choisire agence :</option>
                    <?php foreach ($agences as $agence) {
                        echo "<option value='{$agence['code_AG']} '>{$agence['designation_AG']} {$agence['nom_banque']} </option>";
                    ?>

                    <?php } ?>
                </select>

                <?php if (!empty($error['agence'])): ?>
                    <small class=" help" id="codehelp"><?php echo htmlspecialchars($error['agence']); ?></small>
                <?php endif; ?>
            </div>
            <div class="row mt-4">
                <div class="col">
                    <label for="document">Scan document</label>
                    <input type="file" name="userfile" id="document" class="form-control" />
                    <?php if (!empty($error['userfile'])): ?>
                        <small class="help" id="document-help"><?php echo htmlspecialchars($error['userfile']); ?></small>
                    <?php endif; ?>

                    <small class="help" id="document-help"> </small>
                </div>
                <div class="col">
                    <label for="soumissioner">Soumissioner:</label>
                    <select class="form-select" name="soumissioner" id="soumissioner">
                        <option value="-1">Choisire soumissioner :</option>
                        <?php foreach ($soumissioners as $soumissioner) {
                            echo "<option value='{$soumissioner['code_som']} '>{$soumissioner['nom_som']} {$soumissioner['designation_pays']} </option>";
                        ?>

                        <?php } ?>
                    </select>
                    <?php if (!empty($error['soumissioner'])): ?>
                        <small class=" help" id="codehelp"><?php echo htmlspecialchars($error['soumissioner']); ?></small>
                    <?php endif; ?>
                </div>

            </div>
            <div class=" row mt-4  ">

                <button
                    type="submit"
                    id="submit-btn"
                    class="btn btn-primary form-control ">
                    AJOUTER UNE GARENTIE
                </button>
            </div>
        </div>

        <!-- </div> -->
        <!-- <div class="row mt-2"> -->


        <!-- </div> -->
        <!-- <div class="row "> -->



        <!-- </div> -->
    </form>
</section>
<!-- FIN FORMULAIRE -->