<?php
/**
 * User: Spencer
 * Date: 4/8/14
 * Time: 10:17 AM
 */
// Connects to Database
mysql_connect("localhost", "root", "mq174023") or die(mysql_error());
mysql_select_db("coupon") or die(mysql_error());

// GET SITES VALUES
$site_option = array();
$query = "SELECT id, name, url FROM cofund_sites";
$result = mysql_query($query) or die(mysql_error());
while ($row = mysql_fetch_array($result)) {
    $site_id = $row['id'];
    $site_name = $row['name'];
    $site_url = $row['url'];
    $site_option[] = '<option value="'.$site_id.'">'.$site_name.'</option>';
}

$site_options = implode('', $site_option);

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
<!doctype html>
<html lang="en">
<head>
    <title>Create a Link</title>
    <link rel="stylesheet" type="text/css" href="css/style.css" />
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script type="text/javascript" src="js/colorbox/jquery.colorbox-min.js"></script>
    <script type="text/javascript" src="js/modals.js"></script>
    <script type="text/javascript" src="js/linkbuilder.js"></script>
</head>
<body>
<div class="lb_wrapper">
    <div class="lb_wrapper_inner">
        <div class="lb_toggle">
            <a id="lb_toggle_new" class="submit_button">Create a New Link</a> or
            <br class="line-break"><a id="lb_toggle_search" class="submit_button">Search Existing Links by Name</a>
        </div>
        <div id="lb_form_wrapper">
            <div class="lb_title">
                Link Builder
            </div>
            <form id="lb_form">
                <input type="text" id="lb_gotcha_input" class="gotcha_input" value="" />
                <input type="text" id="lb_name_input" value="Name Your Link" /><br /><br />
                <select id="lb_site_select">
                    <option value="">-- Select Site --</option>
                    <?=$site_options?>
                </select> <a class="lb_add_site_modal"><span class="submit_button">Add Site</span></a>
                <div id="tid_div"></div>
            </form>
            <div id="lb_notice"></div>
        </div>
        <div id="lb_search_wrapper">
            <div class="lb_title">
                Search Links by Name
            </div>
            <input type="hidden" id="page" value="1" />
            <input type="text" id="lb_search_input" value="Search by Name" />
            <div id="lb_search_results"></div>
        </div>
    </div>
</div>

<!-- MODAL WINDOWS -->
<div style="display:none;">
    <div id="lb_add_site_content" class="standardlbcontent">
        <div class="standardlbtop">
            <span class="standardlbtitle">Add a Site</span><span class="colorboxclose"></span>
            <div style="clear:both;"></div>
        </div>
        <div class="standardlbbottom" id="lb_add_site_bottom">
            <input type="text" id="lb_add_site_gotcha" class="gotcha_input" value="" />
            <input type="text" id="lb_add_site_name" value="Site Name" /><br /><br />
            <input type="text" id="lb_add_site_url" value="Site Url" /><br />
            <div id="lb_add_site_submit" class="submit_button">
                Submit
            </div>
            <div style="clear:both;"></div><br />
            <div id="lb_add_site_error" class="lb_error"></div>
        </div>
    </div>
</div>

<div style="display:none;">
    <div id="lb_add_tid_content" class="standardlbcontent">
        <div class="standardlbtop">
            <span class="standardlbtitle">Add a Tid</span><span class="colorboxclose"></span>
            <div style="clear:both;"></div>
        </div>
        <div class="standardlbbottom" id="lb_add_tid_bottom">
            <input type="text" id="lb_add_tid_gotcha" class="gotcha_input" value="" />
            <input type="text" id="lb_add_tid_name" value="Name" /><br /><br />
            <input type="text" id="lb_add_tid_notes" value="Notes" /><br />
            <div id="lb_add_tid_submit" class="submit_button">
                Submit
            </div>
            <div style="clear:both;"></div><br />
            <div id="lb_add_tid_error" class="lb_error"></div>
        </div>
    </div>
</div>

<div style="display:none;">
    <div id="lb_add_ref3_content" class="standardlbcontent">
        <div class="standardlbtop">
            <span class="standardlbtitle">Add a Ref3</span><span class="colorboxclose"></span>
            <div style="clear:both;"></div>
        </div>
        <div class="standardlbbottom" id="lb_add_ref3_bottom">
            <input type="text" id="lb_add_ref3_gotcha" class="gotcha_input" value="" />
            <input type="text" id="lb_add_ref3_name" value="Name" /><br /><br />
            <textarea id="lb_add_ref3_description">Description</textarea><br />
            <div id="lb_add_ref3_submit" class="submit_button">
                Submit
            </div>
            <div style="clear:both;"></div><br />
            <div id="lb_add_ref3_error" class="lb_error"></div>
        </div>
    </div>
</div>

<div style="display:none;">
    <div id="lb_add_ref4_content" class="standardlbcontent">
        <div class="standardlbtop">
            <span class="standardlbtitle">Add a Ref4</span><span class="colorboxclose"></span>
            <div style="clear:both;"></div>
        </div>
        <div class="standardlbbottom" id="lb_add_ref4_bottom">
            <input type="text" id="lb_add_ref4_gotcha" class="gotcha_input" value="" />
            <input type="text" id="lb_add_ref4_name" value="Name" /><br /><br />
            <textarea id="lb_add_ref4_description">Description</textarea><br />
            <div id="lb_add_ref4_submit" class="submit_button">
                Submit
            </div>
            <div style="clear:both;"></div><br />
            <div id="lb_add_ref4_error" class="lb_error"></div>
        </div>
    </div>
</div>

</body>
</html>