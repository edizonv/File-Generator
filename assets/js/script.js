$(function() {

    $('#hours, #minutes').on('load blur keyup', function() {
        if ($(this).val() == "") {
            $(this).val(00);
        }
    });


    var btn = $('button');
    btn.on('click', function(e) {
        e.preventDefault();
        var form = $('form'),
            data = form.serialize(),
            action = form.attr('action'),
            method = form.attr('method'),
            fromDate = $('#from-date').val(),
            toDate = $('#to-date').val();

        splitFromDate = fromDate.split('-');
        splitToDate = toDate.split('-');

        dateFrom = splitFromDate[0]+splitFromDate[1]+splitFromDate[2];
        dateTo = splitToDate[0]+splitToDate[1]+splitToDate[2];

        
        if (dateTo < dateFrom) {
            console.log('Change the date!');
            btn.text('Generate Again');
            $('#done').removeClass('success').addClass('block failed').text('Please change the date!');
            $('#result').fadeIn();
        } else {
            if ($('#path').val().length != 0) {
                var ajax = $.ajax({
                    type: method,
                    data: data,
                    url: action,
                    beforeSend: function() {
                        btn.text('Generating Files...');
                        console.log('Generating Files...');
                    }
                });
                ajax.done(function(res) {
                    if (res != "") {
                        btn.text('Generate Files');
                        $('#done').removeClass('failed').addClass('block').html('<div class="alert alert-success">Done!</div>');
                        $('#result').addClass('good').html(res).hide().fadeIn();
                    } else {
                        btn.text('Generate Files');
                        $('#done').removeClass('failed').addClass('block').html('<div class="alert alert-warning">No Files found! Double check the date & time.</div>');
                    }
                });
            } else {
                console.log('Fields Empty!');
                btn.text('Generate Again');
                $('#done').removeClass('success').addClass('block').html('<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Empty Fields!</div>');
                $('#result').fadeIn();
            }
        }
    });
    $('[data-toggle="tooltip"]').tooltip(); 
});