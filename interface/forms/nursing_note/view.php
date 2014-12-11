<?php

$fake_register_globals=false;
$sanitize_all_escapes=true;

include_once("../../globals.php");
$returnurl = $GLOBALS['concurrent_layout'] ? 'encounter_top.php' : 'patient_encounter.php';

echo "<html><head>";

html_header_show();
echo "<link rel='stylesheet' href='".$css_header."' type='text/css'>";
echo "</head>";
echo "<body class='body_top'>";
include_once("$srcdir/api.inc");
$obj = formFetch("form_nursing_note", $_GET["id"]);

echo '<form method=post action="'.$rootdir.'/forms/nursing_note/save.php?mode=update&id='.attr($_GET["id"]).'" name="nursing_note_form">';
echo '<span class="title">'.xlt('Nursing Form').'</span><br/><br/>';

echo '<span class=text>'.xlt('Pain Level').': </span><input type="text" cols=5 name="pain" value="'.text($obj{"pain"}).'"/>';
echo '<span class=text>'.xlt('Visual Acuity O.D').': </span><input type="text" cols=5 name="acuity_od" value="'.text($obj{"acuity_od"}).'"/>';
echo '<span class=text>'.xlt('Visual Acuity O.S').': </span><input type="text" cols=5 name="acuity_os" value="'.text($obj{"acuity_os"}).'"/>';
echo '<span class=text>'.xlt('Visual Acuity O.U').': </span><input type="text" cols=5 name="acuity_ou" value="'.text($obj{"acuity_ou"}).'"/>';
echo '<span class=text>'.xlt("Corrected").': <input type="checkbox" name="acuity_correction" value="1" '; 
if($obj{"acuity_correction"} == '1') echo "checked"; 
echo '/><br/>';

echo '<span class=text>'.xlt('ISHAHARA').': </span><input type="text" cols=6 name="ishihara" value="'.text($obj{"ishihara"}).'"/><br/>';

echo '<span class="title">'.xlt('Procedures').'</span><br/>';
echo '<span class=text>'.xlt('Injection').': </span>';
echo '<span class=text>'.xlt('MFR').': </span><input type="text" cols=10 name="injection_mfr" value="'.text($obj{"injection_mfr"}).'"/>';
echo '<span class=text>'.xlt('Lot #').': </span><input type="text" cols=5 name="injection_lot" value="'.text($obj{"injection_lot"}).'"/>';
echo '<span class=text>'.xlt('Location').': </span><input type="text" cols=4 name="injection_loc" value="'.text($obj{"injection_loc"}).'"/>';
echo '<span class=text>'.xlt('Exp').': </span><input type="text" cols=4 name="injection_exp" value="'.text($obj{'injection_exp'}).'"/><br/>';  # <- date field

echo "<span class=text>".xlt('ECG').": <input type='checkbox' name='ecg' value='1' ";
if($obj{"ecg"} == '1') echo 'checked';
echo "/><br/>";

echo "<span class=text>".xlt('ABI').": <input type='checkbox' name='abi' value='1' ";
if($obj{"abi"} == '1') echo 'checked';
echo "/><br/>";

echo "<span class=text>".xlt('SVN').": <input type='checkbox' name='svn' value='1' ";
if($obj{"svn"} == '1') echo 'checked';
echo "/><br/>";

echo "<span class=text>".xlt('Venipuncture').": <input type='checkbox' name='venipuncture' value='1' ";
if($obj{"venipuncture"} == '1') echo 'checked';
echo "/><br/>";

echo "<span class=text>".xlt('Allergy Testing').": <input type='checkbox' name='allergy_testing' value='1' ";
if($obj{"allergy_testing"} == '1') echo 'checked';
echo "/><br/>";

echo "<span class=text>".xlt('Suture Removal').": <input type='checkbox' name='suture_removal' value='1' ";
if($obj{"suture_removal"} == '1') echo 'checked';
echo "/><br/>";

echo "<span class=text>".xlt('Wound Care').": <input type='checkbox' name='wound_care' value='1' ";
if($obj{"wound_care"} == '1') echo 'checked';
echo "/><br/>";

echo "<span class=text>".xlt('TB Test').': ';

if(text($obj{"tb_test"}) == 'i') {
	echo "<input type='radio' name='tb_test'value='i' checked>Inoculate /<input type='radio' name='tb_test'value='r'>Read<br/>";
}elseif(text($obj{"tb_test"}) == 'r'){
	echo "<input type='radio' name='tb_test'value='i' checked>Inoculate /<input type='radio' name='tb_test'value='r' checked>Read<br/>";
}

echo "<span class=text>".xlt('Rx Refill: ')."<input type='checkbox' name='rx_refill' value='1' ";
if($obj{"rx_refill"} == '1') echo 'checked';
echo "/><br/>";

echo "<span class=text>".xlt('Pt Education: ')."<input type='checkbox' name='patient_edu' value='1' ";
if($obj{"patient_edu"} == '1') echo 'checked';
echo "/><br/>";

echo '<span class=text>'.xlt("Additional Notes: ").'</span><br>';
echo '<textarea cols=80 rows=24 wrap=virtual name="notes" >'.text($obj{"notes"}).'</textarea><br>';
echo '<br>';

echo '<a href="javascript:top.restoreSession();document.nursing_note_form.submit();" class="link_submit">['.xlt('Save').']</a>';
echo '<br>';
echo '<a href="'.$rootdir.'/patient_file/encounter/'.$returnurl.'class="link"';
echo 'onclick="top.restoreSession()">['.xlt('Don\'t Save Changes').']</a>';
echo '</form>';
formFooter();
?>