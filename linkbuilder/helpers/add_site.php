<?php
/**
 * User: Spencer
 * Date: 4/9/14
 * Time: 12:01 PM
 */

// Connects to Database
mysql_connect("localhost", "root", "mq174023") or die(mysql_error());
mysql_select_db("coupon") or die(mysql_error());

// SANITIZE FUNCTION
function escape($string)
{
    return mysql_real_escape_string($string);
}

// GET SITE VALUES
$site_name = escape($_POST['site_name']);
$site_url = escape($_POST['site_url']);

// ADD NEW SITE TO DB
$query = "INSERT INTO cofund_sites (name, url) VALUES ('$site_name', '$site_url')";
$result = mysql_query($query) or die(mysql_error());

if ($result) {
    // GET SITES VALUES
    $site_option = array();
    $query = "SELECT id, name, url FROM cofund_sites";
    $result = mysql_query($query) or die(mysql_error());
    while ($row = mysql_fetch_array($result)) {
        $site_id = $row['id'];
        $site_name = $row['name'];
        $site_url = $row['url'];
        $site_option[] = '<option value="' . $site_id . '">' . $site_name . '</option>';
    }

    $site_options = implode('', $site_option);
    ?>
    <option value="">-- Select Site --</option>
    <option value="0">None</option>
    <?= $site_options ?>
<?php } ?>