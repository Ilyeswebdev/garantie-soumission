<?php
session_start();

require_once "../app/controllers/UtilisateursController.php";
$utilisateursController = new UtilisateursController();
$action = $_GET['page'] ?? '';
if ($action == 'login') {
    $utilisateursController->Utilisateurslogin();
} elseif (empty($_SESSION['username'])) {
    header("Location: login.php");
} else {
}



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Garantie de Soumission</title>
    <link rel="stylesheet" href="assets\css\bootstrap.min.css">
    <link rel="stylesheet" href="assets\css\styles.css?v=<?php echo time(); ?>">
</head>
<script src="assets\js\jquery.js"></script>
<script src="assets\js\jsfunctions.js"> </script>
<script>
    $('#banque').on('change', function() {
        var banque_id = $(this).val();
        console.log('changed');
        $.ajax({
            url: 'load.php',
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
</script>
<style>

</style>

<body>

    <?php
    ob_start();
    include '..\app\views\partials\navbar.php';

    ?>
    <?php
    if ($_SESSION['role'] === 1) {
        include '..\app\views\partials\sidebar.php';
    } elseif ($_SESSION['role'] === 3) {
        include '..\app\views\partials\sidebarConsultant.php';
    } elseif ($_SESSION['role'] === 2) {
        include '..\app\views\partials\sidebarTraitment.php';
    }

    ?>
    <div class="container-fluid">
        <div class="row">
            <main id="content" class="col mt-2" style="overflow-x: auto; max-width: 100%;">

                <?php
                require_once "../app/controllers/MonnaieController.php";
                require_once "../app/controllers/validiteController.php";
                require_once "../app/controllers/SoumissionerController.php";
                require_once "../app/controllers/BanqueController.php";
                require_once "../app/controllers/AgenceController.php";
                require_once "../app/controllers/GarantieController.php";

                require_once "../app/controllers/authentificationController.php";
                require_once "../app/controllers/amendmentController.php";
                require_once "../app/controllers/mainleveeController.php";

                $controller = new MonnaieController();
                $validiteController = new ValiditeController();
                $soumissionerController = new SoumissionerController();
                $banqueController = new BanqueController();
                $agenceController = new AgenceController();
                $garantieController = new GarantieController();

                $authentificationController = new authentificationController();
                $amendmentController = new amendmentController();
                $mainleveeController = new mainleveeController();


                $action = $_GET['page'] ?? '';

                if ($action == 'monnaie') {
                    if ($_SESSION['role'] === 1) {
                        $controller->showMonnaiePage();
                    }
                    if (isset($_GET['ajout'])) {
                        print_r("<script>success('monnaie', 'ajouter')</script>");
                    } else if (isset($_GET['modif'])) {
                        print_r("<script>success('monnaie', 'modifier')</script>");
                    }
                } elseif ($action == 'insertmonnaie') {
                    if ($_SESSION['role'] === 1) {
                        $controller->insertMonnaie();
                    }
                } elseif ($action == 'deletemonnaie') {
                    if ($_SESSION['role'] === 1) {
                        $controller->deleteMonnaie();
                    }
                } elseif ($action == 'updatemonnaie') {
                    if ($_SESSION['role'] === 1) {
                        $controller->updateMonnaie();
                    }
                } elseif ($action == 'insertvalidite') {
                    if ($_SESSION['role'] === 1) {
                        $validiteController->insertValdite();
                    }
                } elseif ($action == 'validite') {
                    if ($_SESSION['role'] === 1) {
                        $validiteController->selectValidite();
                    }
                    if (isset($_GET['ajout'])) {
                        print_r("<script>success('validite', 'ajouter')</script>");
                    }
                } elseif ($action == 'deletevalidite') {
                    if ($_SESSION['role'] === 1) {
                        $validiteController->deleteValidite();
                    }
                } elseif ($action == 'soumissioner') {
                    if ($_SESSION['role'] === 1) {
                        $soumissionerController->showSoumissioner();
                    }
                    if (isset($_GET['ajout'])) {
                        print_r("<script>success('soumissioner', 'ajouter')</script>");
                    }
                    if (isset($_GET['modif'])) {
                        print_r("<script>success('soumissioner', 'modifier')</script>");
                    }
                } elseif ($action == 'insertsoumissioner') {
                    if ($_SESSION['role'] === 1) {
                        $soumissionerController->insertSoumissioner();
                    }
                } elseif ($action == 'deletesoumissioner') {
                    if ($_SESSION['role'] === 1) {
                        $soumissionerController->deleteSoumissioner();
                    }
                } elseif ($action == 'updatesoumissioner') {
                    if ($_SESSION['role'] === 1) {
                        $soumissionerController->updateSoumissioner();
                    }
                } elseif ($action == 'banque') {
                    if ($_SESSION['role'] === 1) {
                        $banqueController->showBanquePage();
                    }
                    if (isset($_GET['ajout'])) {
                        print_r("<script>success('banque', 'ajouter')</script>");
                    }
                    if (isset($_GET['modif'])) {
                        print_r("<script>success('banque', 'modifier')</script>");
                    }
                } elseif ($action == 'insertbanque') {
                    if ($_SESSION['role'] === 1) {
                        $banqueController->insertBanque();
                    }
                } elseif ($action == 'deletebanque') {
                    if ($_SESSION['role'] === 1) {
                        $banqueController->deleteBanque();
                    }
                } elseif ($action == 'updatebanque') {
                    if ($_SESSION['role'] === 1) {
                        $banqueController->updateBanque();
                    }
                } elseif ($action == 'agence') {
                    if ($_SESSION['role'] === 1) {
                        $agenceController->showAgencePage();
                    }
                    if (isset($_GET['ajout'])) {
                        print_r("<script>success('agence', 'ajouter')</script>");
                    }
                    if (isset($_GET['modif'])) {
                        print_r("<script>success('agence', 'modifier')</script>");
                    }
                } elseif ($action == 'insertagence') {
                    if ($_SESSION['role'] === 1) {
                        $agenceController->insertAgence();
                    }
                } elseif ($action == 'deleteagence') {
                    if ($_SESSION['role'] === 1) {
                        $agenceController->deleteAgence();
                    }
                } elseif ($action == 'updateagence') {
                    if ($_SESSION['role'] === 1) {
                        $agenceController->updateAgence();
                    }
                } elseif ($action == 'garantie') {
                    $garantieController->showGarantiePage();
                    if (isset($_GET['ajout'])) {
                        print_r("<script>success('garantie', 'ajouter')</script>");
                    }
                    if (isset($_GET['modif'])) {
                        print_r("<script>success('garantie', 'modifier')</script>");
                    }
                } elseif ($action == 'insertgarantie') {
                    if ($_SESSION['role'] === 1 || $_SESSION['role'] === 2) {
                        $garantieController->insertGarantie();
                    }
                } elseif ($action == 'deletegarantie') {
                    if ($_SESSION['role'] === 1 || $_SESSION['role'] === 2) {
                        $garantieController->deleteGarantie();
                    }
                } elseif ($action == 'deletDocumentegarantie') {
                    if ($_SESSION['role'] === 1 || $_SESSION['role'] === 2) {
                        $garantieController->deleteDocumentGarantie();
                    }
                } elseif ($action == 'ajouterdocumentgarantie') {
                    if ($_SESSION['role'] === 1 || $_SESSION['role'] === 2) {
                        $garantieController->ajouterDocumentGarantie();
                    }
                } elseif ($action == 'utilisateurs') {
                    if ($_SESSION['role'] === 1) {
                        $utilisateursController->showUtilisateurs();
                    }
                } elseif ($action == 'ajouterutilisateurs') {
                    if ($_SESSION['role'] === 1) {
                        $utilisateursController->ajouterUtilisateurs();
                    }
                } elseif ($action == 'deleteuser') {
                    if ($_SESSION['role'] === 1) {
                        $utilisateursController->deleteUtilisateurs();
                    }
                } elseif ($action == 'updatestatus') {
                    if ($_SESSION['role'] === 1) {
                        $utilisateursController->updateStatus();
                    }
                } elseif ($action == 'ajouterauthentification') {
                    if ($_SESSION['role'] === 1 || $_SESSION['role'] === 2) {
                        $authentificationController->ajouterauthentification();
                    }
                } elseif ($action == 'authentification') {
                    // if ($_SESSION['role'] === 1 || $_SESSION['role'] === 2) {
                    $authentificationController->showAuthentification();
                    // }
                } elseif ($action == 'ajouterDocumentauthentification') {
                    if ($_SESSION['role'] === 1 || $_SESSION['role'] === 2) {
                        $authentificationController->ajouterDocumentAuthentification();
                    }
                } elseif ($action == 'ajouteramendment') {
                    if ($_SESSION['role'] === 1 || $_SESSION['role'] === 2) {
                        $amendmentController->ajouterAmendment();
                    }
                } elseif ($action == 'amendment') {

                    $amendmentController->showAmendment();
                } elseif ($action == 'modifammendment') {

                    $amendmentController->modifAmendment();
                } elseif ($action == 'deletDocumentammendement') {

                    $amendmentController->deleteDocumentAmmendement();
                } elseif ($action == 'mainlevee') {

                    $mainleveeController->mainlevee();
                } elseif ($action == 'logout') {
                    $utilisateursController->logout();
                } else {
                    echo "bienvenue " . $_SESSION['username'];
                }

                ?>

            </main>

        </div>
    </div>



</body>
<script src="assets\js\bootstrap.bundle.min.js"></script>

<script src="assets\js\sweetalert2.all.min.js"></script>

<?php
ob_end_flush();
?>

</html>