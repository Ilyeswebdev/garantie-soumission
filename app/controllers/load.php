<?php
require_once  '..\..\config\Database.php';
require_once '..\..\app\models\GarantieModel.php';
$database = new Database();
$db = $database->connect();
$model = new GarantieModel($db);
$banqueid = $_POST['banque_id'];
$agences = $model->selectAgence($banqueid);
echo '<option value="-1">Choisire agence:</option>';
foreach ($agences as $agence) {
    echo "<option value='{$agence['code_AG']}'>{$agence['adress_AG']}</option>";
}
