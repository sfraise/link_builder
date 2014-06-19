/**
 * Created by Spencer on 4/8/14.
 */
/*** LINK BUILDER FORM ***/
// INPUT VARS
var active_color = '#000'; // Colour of user provided text
var inactive_color = '#9a9a9a'; // Colour of default text
var limit_color = 'red';

$(document).ready(function() {
    $('#lb_toggle_new').click(function() {
        $('#lb_search_wrapper').hide();
        $('#lb_form_wrapper').show();
    });
    $('#lb_toggle_search').click(function() {
        $('#lb_form_wrapper').hide();
        $('#lb_search_wrapper').show();
    });

    // TEXT INPUTS
    $('input#lb_name_input').css("color", inactive_color);
    $('input#lb_name_input').focus(function() {
        var default_values = 'Name Your Link';
        if (!default_values) {
            default_values = this.value;
        }
        if (this.value == default_values) {
            this.value = '';
            this.style.color = active_color;
        }
        $(this).blur(function() {
            if (this.value == '') {
                this.style.color = inactive_color;
                this.value = default_values;
            }
        });
    });

    $('input#lb_add_site_name').css("color", inactive_color);
    $('input#lb_add_site_name').focus(function() {
        var default_values = 'Site Name';
        if (!default_values) {
            default_values = this.value;
        }
        if (this.value == default_values) {
            this.value = '';
            this.style.color = active_color;
        }
        $(this).blur(function() {
            if (this.value == '') {
                this.style.color = inactive_color;
                this.value = default_values;
            }
        });
    });

    $('input#lb_add_site_url').css("color", inactive_color);
    $('input#lb_add_site_url').focus(function() {
        var default_values = 'Site Url';
        if (!default_values) {
            default_values = this.value;
        }
        if (this.value == default_values) {
            this.value = '';
            this.style.color = active_color;
        }
        $(this).blur(function() {
            if (this.value == '') {
                this.style.color = inactive_color;
                this.value = default_values;
            }
        });
    });

    $('input#lb_add_tid_name').css("color", inactive_color);
    $('input#lb_add_tid_name').focus(function() {
        var default_values = 'Name';
        if (!default_values) {
            default_values = this.value;
        }
        if (this.value == default_values) {
            this.value = '';
            this.style.color = active_color;
        }
        $(this).blur(function() {
            if (this.value == '') {
                this.style.color = inactive_color;
                this.value = default_values;
            }
        });
    });

    $('input#lb_add_tid_notes').css("color", inactive_color);
    $('input#lb_add_tid_notes').focus(function() {
        var default_values = 'Notes';
        if (!default_values) {
            default_values = this.value;
        }
        if (this.value == default_values) {
            this.value = '';
            this.style.color = active_color;
        }
        $(this).blur(function() {
            if (this.value == '') {
                this.style.color = inactive_color;
                this.value = default_values;
            }
        });
    });

    $('input#lb_add_ref3_name').css("color", inactive_color);
    $('input#lb_add_ref3_name').focus(function() {
        var default_values = 'Name';
        if (!default_values) {
            default_values = this.value;
        }
        if (this.value == default_values) {
            this.value = '';
            this.style.color = active_color;
        }
        $(this).blur(function() {
            if (this.value == '') {
                this.style.color = inactive_color;
                this.value = default_values;
            }
        });
    });

    $('input#lb_search_input').css("color", inactive_color);
    $('input#lb_search_input').focus(function() {
        var default_values = 'Search by Name';
        if (!default_values) {
            default_values = this.value;
        }
        if (this.value == default_values) {
            this.value = '';
            this.style.color = active_color;
        }
        $(this).blur(function() {
            if (this.value == '') {
                this.style.color = inactive_color;
                this.value = default_values;
            }
        });
    });

    $('#lb_add_ref3_description').css("color", inactive_color);
    $('#lb_add_ref3_description').focus(function() {
        var default_values = 'Description';
        if (!default_values) {
            default_values = this.value;
        }
        if (this.value == default_values) {
            this.value = '';
            this.style.color = active_color;
        }
        $(this).blur(function() {
            if (this.value == '') {
                this.style.color = inactive_color;
                this.value = default_values;
            }
        });
    });

    $('input#lb_add_ref4_name').css("color", inactive_color);
    $('input#lb_add_ref4_name').focus(function() {
        var default_values = 'Name';
        if (!default_values) {
            default_values = this.value;
        }
        if (this.value == default_values) {
            this.value = '';
            this.style.color = active_color;
        }
        $(this).blur(function() {
            if (this.value == '') {
                this.style.color = inactive_color;
                this.value = default_values;
            }
        });
    });

    $('#lb_add_ref4_description').css("color", inactive_color);
    $('#lb_add_ref4_description').focus(function() {
        var default_values = 'Description';
        if (!default_values) {
            default_values = this.value;
        }
        if (this.value == default_values) {
            this.value = '';
            this.style.color = active_color;
        }
        $(this).blur(function() {
            if (this.value == '') {
                this.style.color = inactive_color;
                this.value = default_values;
            }
        });
    });

    // SITES SELECT
    $('#lb_site_select').on('change', function() {
        var site_id = $(this).val();

        // GET TID SELECT
        $('#tid_div').html('<img class="loading" src="/linkbuilder/images/loading6.gif" alt="Loading" title="Loading" />');
        $.ajax({
            url: 'helpers/site_select.php',
            type: 'POST',
            data: {site_id: site_id},
            success: function (data) {
                $('#tid_div').html(data);
            },
            error: function (errorThrown) {
                $('#lb_notice').html('<div class="lb_error">' + errorThrown + '</div>');
            }
        });
    });

    // ADD SITE
    $('#lb_add_site_submit').on('click', function() {
        var site_name = $('#lb_add_site_name').val();
        var site_url = $('#lb_add_site_url').val();

        // GET TID SELECT
        $('#lb_site_select').html('<img class="loading" src="/linkbuilder/images/loading6.gif" alt="Loading" title="Loading" />');
        $.ajax({
            url: 'helpers/add_site.php',
            type: 'POST',
            data: {site_name: site_name, site_url: site_url},
            success: function (data) {
                $('#lb_site_select').html(data);
                $.colorbox.close();
                $('#lb_site_select option:last').prop('selected',true).change();
            },
            error: function (errorThrown) {
                $('#lb_add_site_error').html('<div class="lb_error">' + errorThrown + '</div>');
            }
        });
    });

    // ADD TID
    $('#lb_add_tid_submit').on('click', function() {
        var tid_name = $('#lb_add_tid_name').val();
        var tid_notes = $('#lb_add_tid_notes').val();

        // GET TID SELECT
        $('#lb_tid_select').html('<img class="loading" src="/linkbuilder/images/loading6.gif" alt="Loading" title="Loading" />');
        $.ajax({
            url: 'helpers/add_tid.php',
            type: 'POST',
            data: {tid_name: tid_name, tid_notes: tid_notes},
            success: function (data) {
                $('#lb_tid_select').html(data);
                $.colorbox.close();
                $('#lb_tid_select option:last').prop('selected',true).change();
            },
            error: function (errorThrown) {
                $('#lb_add_tid_error').html('<div class="lb_error">' + errorThrown + '</div>');
            }
        });
    });

    // ADD REF3
    $('#lb_add_ref3_submit').on('click', function() {
        var ref3_name = $('#lb_add_ref3_name').val();
        var ref3_description = $('#lb_add_ref3_description').val();
        var ref3_site_id = $('#lb_site_select').val();
        var ref3_tid_id = $('#lb_tid_select').val();

        // GET TID SELECT
        $('#lb_ref3_select').html('<img class="loading" src="/linkbuilder/images/loading6.gif" alt="Loading" title="Loading" />');
        $.ajax({
            url: 'helpers/add_ref3.php',
            type: 'POST',
            data: {ref3_name: ref3_name, ref3_description: ref3_description, ref3_site_id: ref3_site_id, ref3_tid_id: ref3_tid_id},
            success: function (data) {
                $('#lb_ref3_select').html(data);
                $.colorbox.close();
                $('#lb_ref3_select option:last').prop('selected',true).change();
            },
            error: function (errorThrown) {
                $('#lb_add_ref3_error').html('<div class="lb_error">' + errorThrown + '</div>');
            }
        });
    });

    // ADD REF4
    $('#lb_add_ref4_submit').on('click', function() {
        var ref4_name = $('#lb_add_ref4_name').val();
        var ref4_description = $('#lb_add_ref4_description').val();
        var ref4_site_id = $('#lb_site_select').val();
        var ref4_tid_id = $('#lb_tid_select').val();

        // GET TID SELECT
        $('#lb_ref4_select').html('<img class="loading" src="/linkbuilder/images/loading6.gif" alt="Loading" title="Loading" />');
        $.ajax({
            url: 'helpers/add_ref4.php',
            type: 'POST',
            data: {ref4_name: ref4_name, ref4_description: ref4_description, ref4_site_id: ref4_site_id, ref4_tid_id: ref4_tid_id},
            success: function (data) {
                $('#lb_ref4_select').html(data);
                $.colorbox.close();
                $('#lb_ref4_select option:last').prop('selected',true).change();
            },
            error: function (errorThrown) {
                $('#lb_add_ref4_error').html('<div class="lb_error">' + errorThrown + '</div>');
            }
        });
    });

    // SEARCH BY NAME
    $('#lb_search_input').keyup(function() {
        if( this.value.length < 4 ) return;
        paginate();
    });
});

// TID SELECT
function tidSelect() {
    $(document).ready(function() {
        var site_id = $('#lb_site_select').val();
        var tid_id = $('#lb_tid_select').val();

        // GET TID SELECT
        $('#ref3_div').html('<img class="loading" src="/linkbuilder/images/loading6.gif" alt="Loading" title="Loading" />');
        $.ajax({
            url: 'helpers/tid_select.php',
            type: 'POST',
            data: {site_id: site_id, tid_id: tid_id},
            success: function (data) {
                $('#ref3_div').html(data);
            },
            error: function (errorThrown) {
                $('#lb_notice').html('<div class="lb_error">' + errorThrown + '</div>');
            }
        });
    });
}

// REF3 SELECT
function ref3Select() {
    $(document).ready(function() {
        var site_id = $('#lb_site_select').val();
        var tid_id = $('#lb_tid_select').val();
        var ref3_id = $('#lb_ref3_select').val();

        // GET TID SELECT
        $('#ref4_div').html('<img class="loading" src="/linkbuilder/images/loading6.gif" alt="Loading" title="Loading" />');
        $.ajax({
            url: 'helpers/ref3_select.php',
            type: 'POST',
            data: {site_id: site_id, tid_id: tid_id, ref3_id: ref3_id},
            success: function (data) {
                $('#ref4_div').html(data);
            },
            error: function (errorThrown) {
                $('#lb_notice').html('<div class="lb_error">' + errorThrown + '</div>');
            }
        });
    });
}

// REF4 SELECT
function ref4Select() {
    $(document).ready(function() {
        var site_id = $('#lb_site_select').val();
        var tid_id = $('#lb_tid_select').val();
        var ref3_id = $('#lb_ref3_select').val();
        var ref4_id = $('#lb_ref4_select').val();

        // GET TID SELECT
        $('#lb_submit_div').html('<img class="loading" src="/linkbuilder/images/loading6.gif" alt="Loading" title="Loading" />');
        $.ajax({
            url: 'helpers/ref4_select.php',
            type: 'POST',
            data: {site_id: site_id, tid_id: tid_id, ref3_id: ref3_id, ref4_id: ref4_id},
            success: function (data) {
                $('#lb_submit_div').html(data);
            },
            error: function (errorThrown) {
                $('#lb_notice').html('<div class="lb_error">' + errorThrown + '</div>');
            }
        });
    });
}

// SUBMIT FORM
function lbSubmitForm() {
    // RESET ERROR
    $('#lb_notice').html('');

    // GET VALUES
    var gotcha = $('#lb_gotcha_input').val();
    var name = $('#lb_name_input').val();
    var site = $('#lb_site_select').val();
    var tid = $('#lb_tid_select').val();
    var ref3 = $('#lb_ref3_select').val();
    var ref4 = $('#lb_ref4_select').val();

    // VALIDATE FORM
    if(gotcha !== '') {
        $('#lb_notice').html('<div class="lb_error">No bots allowed!</div>');
    } else if(!name || name == 'Name') {
        $('#lb_notice').html('<div class="lb_error">Please enter a name!</div>');
    } else if(!site) {
        $('#lb_notice').html('<div class="lb_error">Please enter a link!</div>');
    } else {
        // SEND THE FORM
        $('#lb_notice').html('<img class="loading" src="/linkbuilder/images/loading6.gif" alt="Loading" title="Loading" />');
        $.ajax({
            url: 'helpers/linkbuilder.php',
            type: 'POST',
            data: {name: name, site: site, tid: tid, ref3: ref3, ref4: ref4},
            success: function (data) {
                $('#lb_notice').html(data);
            },
            error: function (errorThrown) {
                $('#lb_notice').html('<div class="lb_error">' + errorThrown + '</div>');
            }
        });
    }
    return false;
}

// PAGINATION FUNCTIONS
function increase() {
    var page = $('#page').val();
    $('#page').val(++page);
    paginate();
}

function decrease() {
    var page = $('#page').val();
    $('#page').val(--page);
    paginate();
}

function start() {
    $('#page').val('1');
    paginate();
}

function resetpage() {
    $('page').val('1');
    paginate();
}

function paginate() {
    var limit = '20';
    var page = $('#page').val();
    var lb_search_value = $('#lb_search_input').val();

    // SUBMIT SEARCH VALUE
    $('#lb_search_results').html('<img class="loading" src="/linkbuilder/images/loading6.gif" alt="Loading" title="Loading" />');
    $.ajax({
        url: 'helpers/search.php',
        type: 'POST',
        data: {limit: limit, page: page, lb_search_value: lb_search_value},
        success: function (data) {
            $('#lb_search_results').html(data);
        },
        error: function (errorThrown) {
            $('#lb_search_results').html('<div class="lb_error">' + errorThrown + '</div>');
        }
    });
}