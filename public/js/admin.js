$(document).ready(function(){

    $('.case-study').click(function(e){
        e.preventDefault();

        $('#study').modal('show');

        var url = $(this).attr('href');

        $.ajax({
            type: "GET",
            url: url,
            dataType: "json",
            success: function(data) {

                // console.log(data.study);
                // console.log(data.keywords);

                $('.study-title').empty().append(data.study.title);
                $('.problem').empty().append(data.study.problem);
                $('.solution').empty().append(data.study.solution);
                $('.analysis').empty().append(data.study.analysis);

                $('.keywords').empty();

                $.each(data.keywords, function(index){

                    $('.keywords').append('<li>'+data.keywords[index].name+'</li>')

                });

                $('.edit').attr('href', url+'/edit');

            }
        });

        return false;

    });

    $('.delete').click(function(e){
        e.preventDefault();

        var route = $(this).attr('href');

        $('#delete').modal('show');
        $('form').attr('action', route);

    });

});
