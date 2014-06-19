<?php
/**
 * User: Spencer
 * Date: 4/8/14
 * Time: 7:48 PM
 */
?>
<script type="text/javascript" src="js/modals.js"></script>
<?php
// Connects to Database
mysql_connect("localhost", "root", "mq174023") or die(mysql_error());
mysql_select_db("coupon") or die(mysql_error());

// SANITIZE FUNCTION
function escape($string) {
    return mysql_real_escape_string($string);
}

// GET SITE ID
$site_id = escape($_POST['site_id']);

// GET TID VALUES
$tid_option = array();
$query = "SELECT id, tid_name FROM perks_tid";
$result = mysql_query($query) or die(mysql_error());
while ($row = mysql_fetch_array($result)) {
    $tid_id = $row['id'];
    $tid_name = $row['tid_name'];
    $tid_option[] = '<option value="'.$tid_id.'">'.$tid_name.'</option>';
}

$tid_options = implode('', $tid_option);
?>

<select id="lb_tid_select" onchange="tidSelect();">
    <option value="">-- Select Tid --</option>
    <option value="0">None</option>
    <?=$tid_options?>
</select> <a class="lb_add_tid_modal"><span class="submit_button">Add Tid</span></a>
<div id="ref3_div"></div>