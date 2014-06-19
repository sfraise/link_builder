<?php
/**
 * User: Spencer
 * Date: 4/8/14
 * Time: 10:42 PM
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
$tid_id = escape($_POST['tid_id']);
$ref3_id = escape($_POST['ref3_id']);

// GET REF4 VALUES
$ref4_option = array();
$query = "SELECT id, name, description FROM cofund_ref4 WHERE site_id = $site_id AND (tid_id = $tid_id OR tid_id = 0)";
$result = mysql_query($query) or die(mysql_error());
while ($row = mysql_fetch_array($result)) {
    $ref4_id = $row['id'];
    $ref4_name = $row['name'];
    $ref4_description = $row['description'];
    $ref4_option[] = '<option value="'.$ref4_id.'" title="'.$ref4_description.'">'.$ref4_name.'</option>';
}

$ref4_options = implode('', $ref4_option);
?>

<select id="lb_ref4_select" onchange="ref4Select();">
    <option value="">-- Select Ref4 --</option>
    <option value="0">None</option>
    <?=$ref4_options?>
</select> <a class="lb_add_ref4_modal"><span class="submit_button">Add Ref4</span></a>
<div id="lb_submit_div"></div>