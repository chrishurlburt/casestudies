/* ========================================================================
 * DOM-based Routing
 * Based on http://goo.gl/EUTi53 by Paul Irish
 *
 * Only fires on body classes that match. If a body class contains a dash,
 * replace the dash with an underscore when adding it to the object below.
 *
 * .noConflict()
 * The routing is enclosed within an anonymous function so that you can
 * always reference jQuery with $, even when in .noConflict() mode.
 * ======================================================================== */


 // @TODO: clear app search forms on back button

(function($) {

    var ajax = {
        get: function(url, success, error) {
            $.ajax({
                type: "GET",
                url: url,
                dataType: "json",
                success: success,
                error: error,
            });
        },
    };

    var app = {
        'common' : {
        //common fires on every page
            init     : function(){

                tinymce.init({
                    selector: '.editor',
                    menubar: false,
                    plugins: 'autolink link',
                    toolbar: 'undo redo | styleselect | bold italic underline | alignleft aligncenter alignright | bullist numlist | link unlink'
                });

                $('.delete').click(function(e){
                    e.preventDefault();

                    var resource = $(this).closest('table').attr('data-resource');

                    var route = $(this).attr('href');

                    $('.warning-message').empty().append('Are you sure you want to delete this '+resource+'?');

                    if(resource == 'case study' || resource == 'draft') {
                        $('.warning-desc').empty().append('The study will moved to the trash.');
                    } else {
                        $('.warning-desc').empty().append('It will be permanently deleted.');
                    }


                    $('#delete').modal('show');
                    $('form').attr('action', route);

                });
            },
            finalize : function(){ }
        },
        'manage_case_studies' : {
            init     : function(){

                $('.case-study').click(function(e){
                    e.preventDefault();

                    $('#study').modal('show');

                    var url = $(this).attr('href');

                    ajax.get(url, function(data) {

                        $('.study-title').empty().append(data.study.title);
                        $('.problem').empty().append(data.study.problem);
                        $('.solution').empty().append(data.study.solution);
                        $('.analysis').empty().append(data.study.analysis);

                        $('.keywords').empty();

                        $.each(data.keywords, function(index){

                            $('.keywords').append('<li>'+data.keywords[index].name+'</li>')

                        });

                        $('.edit').attr('href', url+'/edit');
                    });
                    return false;
                });
            },
            finalize : function(){ }
        },
        'manage_outcomes' : {
            init     : function(){
                $('.outcome').click(function(e){
                    e.preventDefault();

                    $('#outcome').modal('show');

                    var url = $(this).attr('href');

                    ajax.get(url, function(data) {

                        console.log(data);

                        $('.outcome-name').empty().append(data.name);

                        if(!data.description) {
                            $('.course-description').closest('h4').detach();
                        } else {
                            $('.outcome-description').empty().append(data.description);
                        }

                        $('.edit').attr('href', url+'/edit');

                    });

                    return false;

                });
            },
            finalize : function(){ }
        },
        'manage_courses' : {
            init     : function(){
                $('.course').click(function(e){
                    e.preventDefault();

                    $('#course').modal('show');

                    var url = $(this).attr('href');

                    ajax.get(url, function(data) {

                        // console.log(data);

                        $('.course-name').empty().append(data.name);

                        if(!data.description) {
                            $('.course-description').closest('h4').detach();
                        } else {
                            $('.course-description').empty().append(data.description);
                        }

                        $('.edit').attr('href', url+'/edit');

                    });

                    return false;

                });
            },
            finalize : function(){ }
        },
        'manage_users' : {
            init : function(){

                $('.deactivate').click(function(e){
                    e.preventDefault();

                    var resource = $(this).closest('table').attr('data-resource');

                    var route = $(this).attr('href');

                    $('.warning-message').empty().append('Are you sure you want to deactivate '+resource+'?');
                    $('.warning-desc').empty().append('This user can later be reactivated.');
                    $('.btn-danger').empty().append('Deactivate');

                    $('#delete').modal('show');
                    $('form').attr('action', route);

                });

            },
            finalize : function() {}
        }
    };

    // The routing fires all common scripts, followed by the page specific scripts.
    // Add additional events for more control over timing e.g. a finalize event
    var UTIL = {
        fire: function(func, funcname, args) {
            var fire;
            var namespace = app;
            funcname = (funcname === undefined) ? 'init' : funcname;
            fire = func !== '';
            fire = fire && namespace[func];
            fire = fire && typeof namespace[func][funcname] === 'function';

            if (fire) {
                namespace[func][funcname](args);
            }
        },
        loadEvents: function() {
            // Fire common init JS
            UTIL.fire('common');

            // Fire page-specific init JS, and then finalize JS
            $.each(document.body.className.replace(/-/g, '_').split(/\s+/), function(i, classnm) {
                UTIL.fire(classnm);
                UTIL.fire(classnm, 'finalize');
            });

            // Fire common finalize JS
            UTIL.fire('common', 'finalize');
        }
    };

    // Load Events
    $(document).ready(UTIL.loadEvents);

})(jQuery); // Fully reference jQuery after this point.