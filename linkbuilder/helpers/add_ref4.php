<?php
/**
 * User: Spencer
 * Date: 4/9/14
 * Time: 3:24 PM
 */

// Connects to Database
mysql_connect("localhost", "root", "mq174023") or die(mysql_error());
mysql_select_db("coupon") or die(mysql_error());

// SANITIZE FUNCTION
function escape($string)
{
    return mysql_real_escape_string($string);
}

// GET REF4 VALUES
$ref4_name = escape($_POST['ref4_name']);
$ref4_description = escape($_POST['ref4_description']);
$ref4_site_id = escape($_POST['ref4_site_id']);
$ref4_tid_id = escape($_POST['ref4_tid_id']);

// ADD NEW REF4 TO DB
$query = "INSERT INTO cofund_ref4 (name, description, site_id, tid_id) VALUES ('$ref4_name', '$ref4_description', '$ref4_site_id', '$ref4_tid_id')";
$result = mysql_query($query) or die(mysql_error());

if ($result) {
    // GET REF4 VALUES
    $ref4_option = array();
    $query = "SELECT id, name, description FROM cofund_ref4 WHERE site_id = $ref4_site_id AND (tid_id = $ref4_tid_id OR tid_id = 0)";
    $result = mysql_query($query) or die(mysql_error());
    while ($row = mysql_fetch_array($result)) {
        $ref4_id = $row['id'];
        $ref4_name = $row['name'];
        $ref4_description = $row['description'];
        $ref4_option[] = '<option value="'.$ref4_id.'" title="'.$ref4_description.'">'.$ref4_name.'</option>';
    }

    $ref4_options = implode('', $ref4_option);
    ?>
    <option value="">-- Select Ref4 --</option>
    <option value="0">None</option>
    <?= $ref4_options ?>
<?php } ?>