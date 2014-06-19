<?php
/**
 * User: Spencer
 * Date: 4/8/14
 * Time: 11:13 PM
 */

// SANITIZE FUNCTION
function escape($string) {
    return mysql_real_escape_string($string);
}

// GET SITE ID
$site_id = escape($_POST['site_id']);
$tid_id = escape($_POST['tid_id']);
$ref3_id = escape($_POST['ref3_id']);
$ref4_id = escape($_POST['ref4_id']);
?>
<a id="lb_form_submit" class="submit_button" onclick="lbSubmitForm();">Create</a>