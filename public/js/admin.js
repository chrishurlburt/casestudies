$(document).ready(function(){

    tinymce.init({
        selector: '.editor',
        menubar: false,
        plugins: 'autolink link',
        toolbar: 'undo redo | styleselect | bold italic underline | alignleft aligncenter alignright | bullist numlist | link unlink'
    });

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

    $('.course').click(function(e){
        e.preventDefault();

        $('#course').modal('show');

        var url = $(this).attr('href');

        ajax.get(url, function(data) {

            console.log(data);

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

    $('.delete').click(function(e){
        e.preventDefault();

        var resource = $(this).closest('table').attr('data-resource');

        var route = $(this).attr('href');

        $('.warning-message').empty().append('Are you sure you want to delete this '+resource+'?');

        $('#delete').modal('show');
        $('form').attr('action', route);

    });

});


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

}