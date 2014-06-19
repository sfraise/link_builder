<?php
/**
 * User: Spencer
 * Date: 4/8/14
 * Time: 11:06 AM
 */

// Connects to Database
mysql_connect("localhost", "root", "mq174023") or die(mysql_error());
mysql_select_db("coupon") or die(mysql_error());

// SANITIZE FUNCTION
function escape($string) {
    return mysql_real_escape_string($string);
}

$name = escape($_POST['name']);
$site_id = escape($_POST['site']);
$tid_id = escape($_POST['tid']);
$ref3_id = escape($_POST['ref3']);
$ref4_id = escape($_POST['ref4']);

// GET SITE URL
$query = "SELECT url FROM cofund_sites WHERE id = $site_id";
$result = mysql_query($query) or die(mysql_error());
while ($row = mysql_fetch_array($result)) {
    $site_url = rtrim($row['url'], '/');
}

if(preg_match("/[?]/", $site_url)) {
    $seperator = '&';
} else {
    $seperator = '?';
}

if(!$tid_id) {
    $tid_id = 0;
    $tid = '';
} else {
    $tid = $seperator . 'tid=' . $tid_id;
}
if(!$ref3_id) {
    $ref3_id = 0;
    $ref3 = '';
} else {
    if(!$tid_id || $tid_id == 0) {
        $ref3 = $seperator . 'ref3=' . $ref3_id;
    } else {
        $ref3 = '&ref3=' . $ref3_id;
    }
}
if(!$ref4_id) {
    $ref4_id = 0;
    $ref4 = '';
} else {
    if((!$tid_id || $tid_id == 0) && (!$ref3_id || $ref3_id == 0)) {
        $ref4 = $seperator . 'ref4=' . $ref4_id;
    } else {
        $ref4 = '&ref4=' . $ref4_id;
    }
}

// CHECK FOR UNIQUE NAME
$existing_name = '';
$query = "SELECT name FROM cofund_links WHERE name = '$name'";
$result = mysql_query($query) or die(mysql_error());
while ($row = mysql_fetch_array($result)) {
    $existing_name = $row['name'];
}

if($name == $existing_name) {
    echo 'The link name already exists, please choose a unique name';
} else {
    $full_link = $site_url . $tid . $ref3 . $ref4;

    $query = "INSERT INTO cofund_links (name, link, tid_id, ref3_id, ref4_id, site_id) VALUES ('$name', '$full_link', '$tid_id', '$ref3_id', '$ref4_id', '$site_id')";
    mysql_query($query) or die(mysql_error());
    echo $name . ' link:<br />' . $full_link;
}
?>