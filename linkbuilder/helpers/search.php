<?php
/**
 * User: Spencer
 * Date: 4/10/14
 * Time: 9:38 AM
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
//$limit = escape($_POST['limit']);
$limit = 25;
$search_value = escape($_POST['lb_search_value']);
$page = escape($_POST['page']);
if($page == 1) {
    $start = 0;
} else {
    $start = $limit * $page - $limit + 1;
}

// GET COUNT
$result = mysql_query("SELECT COUNT(*) as total FROM cofund_links WHERE name LIKE '%$search_value%'");
$data = mysql_fetch_assoc($result);
$total = $data['total'];
$pagetotal = ceil($total / $limit);

// GET RESULTS
$link_result = array();
$query = "SELECT name, link FROM cofund_links WHERE name LIKE '%$search_value%' ORDER BY name DESC LIMIT $start, $limit";
$result = mysql_query($query) or die(mysql_error());
while ($row = mysql_fetch_array($result)) {
    $name = $row['name'];
    $link = $row['link'];
    $link_result[] = '<div class="lb_search_item">' . $name . ' - ' . $link . '</div>';
}

echo implode('', $link_result);

// DISPLAY PAGINATION
if(($page == 1) && ($pagetotal > 1)) {
    echo "
        <div style=\"clear:both;\"></div>
        <div class=\"pagination\">
            <img class=\"paginationstartlt\" src=\"images/pagination/startlt.png\" alt=\"First\" title=\"First\" />
            <img class=\"paginationpreviouslt\" src=\"images/pagination/previouslt.png\" alt=\"Previous\" title=\"Previous\" />
            <span class=\"homepageresult\">Page ".$page." of ".$pagetotal."</span>
            <img class=\"paginationnext\" src=\"images/pagination/next.png\" alt=\"Next\" title=\"Next\" onclick=\"increase()\" />
            <img class=\"paginationend\" src=\"images/pagination/end.png\" alt=\"Last\" title=\"Last\" onclick=\"$('#page').val(".$pagetotal."); paginate();\" />
        </div>
        ";
} elseif(($page > 1) && ($page < $pagetotal)) {
    echo "
        <div style=\"clear:both;\"></div>
        <div class=\"pagination\">
            <img class=\"paginationstart\" src=\"images/pagination/start.png\" alt=\"First\" title=\"First\" onclick=\"start();\" />
            <img class=\"paginationprevious\" src=\"images/pagination/previous.png\" alt=\"Previous\" title=\"Previous\" onclick=\"decrease();\" />
            <span class=\"homepageresult\">Page ".$page." of ".$pagetotal."</span>
            <img class=\"paginationnext\" src=\"images/pagination/next.png\" alt=\"Next\" title=\"Next\" onclick=\"increase();\" />
            <img class=\"paginationend\" src=\"images/pagination/end.png\" alt=\"Last\" title=\"Last\" onclick=\"$('#page').val(".$pagetotal."); paginate();\" />
        </div>
        ";
} elseif(($page == $pagetotal) && ($pagetotal > 1)) {
    echo "
        <div style=\"clear:both;\"></div>
        <div class=\"pagination\">
            <img class=\"paginationstart\" src=\"images/pagination/start.png\" alt=\"First\" title=\"First\" onclick=\"start()\" />
            <img class=\"paginationprevious\" src=\"images/pagination/previous.png\" alt=\"Previous\" title=\"Previous\" onclick=\"decrease()\" />
            <span class=\"homepageresult\">Page ".$page." of ".$pagetotal."</span>
            <img class=\"paginationnextlt\" src=\"images/pagination/nextlt.png\" alt=\"Next\" title=\"Next\" />
            <img class=\"paginationendlt\" src=\"images/pagination/endlt.png\" alt=\"Last\" title=\"Last\" />
        </div>";
} elseif($pagetotal == 0) {
} else {
    echo "<div style=\"clear:both;\"></div><div class=\"cbaspagination\">Page ".$page." of ".$pagetotal."</div>";
}
?>