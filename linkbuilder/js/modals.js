/**
 * Created by Spencer on 4/9/14.
 */

$(document).ready(function(){
    $(".lb_add_site_modal").colorbox({width:"300px", height:"auto", inline:true, href:"#lb_add_site_content"});
    $(".lb_add_tid_modal").colorbox({width:"300px", height:"auto", inline:true, href:"#lb_add_tid_content"});
    $(".lb_add_ref3_modal").colorbox({width:"300px", height:"auto", inline:true, href:"#lb_add_ref3_content"});
    $(".lb_add_ref4_modal").colorbox({width:"300px", height:"auto", inline:true, href:"#lb_add_ref4_content"});

    // SET CLOSE ONCLICK ON '.colorboxclose'
    $('.colorboxclose').click(function() {
        $.colorbox.close();
    });
    // SET CLOSE ONCLICK ON IFRAME '.ifcolorboxclose'
    $('.ifcolorboxclose').click(function() {
        parent.$.colorbox.close();
    });

    // RETURN FALSE ON CLOLORBOX CLOSE TO PREVENT SCREEN JUMP
    $(document).bind('cbox_closed', function(){
        return false;
    });
});