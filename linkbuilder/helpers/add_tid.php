<?php
/**
 * User: Spencer
 * Date: 4/9/14
 * Time: 2:36 PM
 */

// Connects to Database
mysql_connect("localhost", "root", "mq174023") or die(mysql_error());
mysql_select_db("coupon") or die(mysql_error());

// SANITIZE FUNCTION
function escape($string)
{
    return mysql_real_escape_string($string);
}

// GET TID VALUES
$tid_name = escape($_POST['tid_name']);
$tid_notes = escape($_POST['tid_notes']);

// ADD NEW TID TO DB
$query = "INSERT INTO perks_tid (tid_name, tid_notes, last_updated) VALUES ('$tid_name', '$tid_notes', NOW())";
$result = mysql_query($query) or die(mysql_error());

if ($result) {
    // GET TID VALUES
    $site_option = array();
    $query = "SELECT id, tid_name, tid_notes FROM perks_tid";
    $result = mysql_query($query) or die(mysql_error());
    while ($row = mysql_fetch_array($result)) {
        $tid_id = $row['id'];
        $tid_name = $row['tid_name'];
        $tid_notes = $row['tid_notes'];
        $tid_option[] = '<option value="'.$tid_id.'" title="'.$tid_notes.'">'.$tid_name.'</option>';
    }

    $tid_options = implode('', $tid_option);
    ?>
    <option value="">-- Select Tid --</option>
    <option value="0">None</option>
    <?= $tid_options ?>
<?php } ?>