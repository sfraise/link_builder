<?php
/**
 * User: Spencer
 * Date: 4/9/14
 * Time: 2:44 PM
 */

// Connects to Database
mysql_connect("localhost", "root", "mq174023") or die(mysql_error());
mysql_select_db("coupon") or die(mysql_error());

// SANITIZE FUNCTION
function escape($string)
{
    return mysql_real_escape_string($string);
}

// GET REF3 VALUES
$ref3_name = escape($_POST['ref3_name']);
$ref3_description = escape($_POST['ref3_description']);
$ref3_site_id = escape($_POST['ref3_site_id']);
$ref3_tid_id = escape($_POST['ref3_tid_id']);

// ADD NEW REF3 TO DB
$query = "INSERT INTO cofund_ref3 (name, description, site_id, tid_id) VALUES ('$ref3_name', '$ref3_description', '$ref3_site_id', '$ref3_tid_id')";
$result = mysql_query($query) or die(mysql_error());

if ($result) {
    // GET REF3 VALUES
    $ref3_option = array();
    $query = "SELECT id, name, description FROM cofund_ref3 WHERE site_id = $ref3_site_id AND (tid_id = $ref3_tid_id OR tid_id = 0)";
    $result = mysql_query($query) or die(mysql_error());
    while ($row = mysql_fetch_array($result)) {
        $ref3_id = $row['id'];
        $ref3_name = $row['name'];
        $ref3_description = $row['description'];
        $ref3_option[] = '<option value="'.$ref3_id.'" title="'.$ref3_description.'">'.$ref3_name.'</option>';
    }

    $ref3_options = implode('', $ref3_option);
    ?>
    <option value="">-- Select Ref3 --</option>
    <option value="0">None</option>
    <?= $ref3_options ?>
<?php } ?>