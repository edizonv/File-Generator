$(function() {
    var btn = $('button');
    btn.on('click', function(e) {
        e.preventDefault();

        var form = $('form'),
            url = form.attr('action'),
            method = form.attr('method'),
            data = form.serialize(),
            folderPath = $('#path').val(),
            listPath = $('#list').val();

        if (folderPath.length > 0 || listPath.length > 0 ) {
            var ajax = $.ajax({
                type: method,
                data: data,
                url: url,
                beforeSend: function() {
                    btn.text('Checking Files...');
                    console.log('Checking Files...');
                }
            });

            ajax.done(function(res) {
                btn.text('Check Files');
                //$('#done').removeClass('failed').addClass('block success').text('DONE!');
                console.log('Checking files complete!');
                $('#result').html(res).hide().fadeIn();
            });
        } else {
            btn.text('Check Again');
            console.log('Check Again');
            //$('#done').removeClass('success').addClass('block failed').text('Empty Fields!');
            $('#result').hide().fadeIn();
        }

    });
});