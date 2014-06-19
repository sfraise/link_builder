<?php
/**
 * User: Spencer
 * Date: 4/8/14
 * Time: 9:56 PM
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

// GET VALUES
$site_id = escape($_POST['site_id']);
$tid_id = escape($_POST['tid_id']);

// GET REF3 VALUES
$ref3_option = array();
$query = "SELECT id, name, description FROM cofund_ref3 WHERE site_id = $site_id AND (tid_id = $tid_id OR tid_id = 0)";
$result = mysql_query($query) or die(mysql_error());
while ($row = mysql_fetch_array($result)) {
    $ref3_id = $row['id'];
    $ref3_name = $row['name'];
    $ref3_description = $row['description'];
    $ref3_option[] = '<option value="'.$ref3_id.'" title="'.$ref3_description.'">'.$ref3_name.'</option>';
}

$ref3_options = implode('', $ref3_option);
?>

<select id="lb_ref3_select" onchange="ref3Select();">
    <option value="">-- Select Ref3 --</option>
    <option value="0">None</option>
    <?=$ref3_options?>
</select> <a class="lb_add_ref3_modal"><span class="submit_button">Add Ref3</span></a>
<div id="ref4_div"></div>