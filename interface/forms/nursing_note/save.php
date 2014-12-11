<?php

$fake_register_globals=false;
$sanitize_all_escapes=true;

include_once("../../globals.php");
include_once("$srcdir/api.inc");
include_once("$srcdir/forms.inc");

if ($encounter == "") $encounter = date("Ymd");

if ($_GET["mode"] == "new"){
	$newid = formSubmit("form_nursing_note", $_POST, $_GET["id"], $userauthorized);
	addForm($encounter, "Nursing Note", $newid, "nursing_note", $pid, $userauthorized);

}elseif ($_GET["mode"] == "update") {

	sqlInsert("update form_nursing_note
	set pid = ?,groupname=?,user=?,authorized=?,activity=1, date = NOW(),
	pain=?, acuity_od=?, acuity_os=?, acuity_ou=?, acuity_correction=?,	ishihara=?, 
	injection_mfr=?, injection_lot=?, injection_loc=?, injection_exp=?, ecg=?, abi=?, svn=?, 
	venipuncture=?, allergy_testing=?, suture_removal=?, wound_care=?, tb_test=?, rx_refill=?, 
	patient_edu=?, notes=?",
	array($_SESSION["pid"],
		  $_SESSION["authProvider"],
		  $_SESSION["authUser"],
		  $userauthorized,

		  $_POST["pain"],
		  $_POST["acuity_od"],
		  $_POST["acuity_os"],
		  $_POST["acuity_ou"],
		  $correction, 
		  $_POST["ishihara"], 

		  $_POST["injection_mfr"], 
		  $_POST["injection_lot"], 
		  $_POST["injection_loc"],	
		  $_POST["injection_exp"], 
		  $_POST["ecg"], 
		  $_POST["abi"], 
		  $_POST["svn"], 

		  $_POST["venipuncture"], 
		  $_POST["allergy_testing"],
		  $_POST["suture_removal"], 
		  $_POST["wound_care"], 
		  $_POST["tb_test"], 
		  $_POST["rx_refill"], 
		  $_POST["patient_edu"], 
		  $_POST["notes"],
		  )); 
} 
$_SESSION["encounter"] = $encounter;
formHeader("Redirecting....");
formJump();
formFooter();
?>
