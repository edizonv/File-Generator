<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>File Checker</title>
	<?php if(basename($_SERVER['PHP_SELF']) != "index.php"): ?>
		<meta HTTP-EQUIV="REFRESH" content="0; url=http://localhost/">
	<?php endif; ?>
	<link rel="stylesheet" href="style.css">
</head>
<body>
<br><br>

<form action="file-checked.php" method="POST" enctype="multipart/form-data">
	<legend><h1>File Generator</h1></legend>
	<dl>
	    <dd><input type="hidden" name="root" value="root" required /></dd>

	    <dt><label for="path">Project Path:</label></dt>
	    <dd><input type="text" id="path" name="path" required /></dd>

	    <!-- <dt><label for="path">Save to :</label></dt> -->
	    <dd><input type="hidden" id="newpath" name="newpath" value="<?php  echo getenv("HOMEDRIVE").getenv("HOMEPATH")."\Desktop\\".date("Ymd").'_files';  ?>" required /></dd>

	    <dt><label for="path">From :</label></dt>
	    <dd>
	    	<ul class="dates">
		    	<li><input type="date" id="from-date" name="from-date" value="<?php echo date("Y-m-d"); ?>" /></li>
		    	<li><input type="text" id="hours" name="hours" value="00" /></li>
		    	<li><input type="text" id="minutes" name="minutes" value="00" /></li>
	    	</ul>
	    </dd>

	    <dt><label for="path">To :</label></dt>
	    <dd><input type="date" id="to-date" name="to-date" value="<?php echo date("Y-m-d"); ?>" /></dd>

    </dl>
    <p><button name="submit-btn">Generate Files</button></p>
    <p><a href="checker">Check Files</a></p>
    <p><a href="beta">Check images without alt</a></p>
    <div id="done"></div>
    <div id="result"></div>
</form>

<script src="jquery.js"></script>
<script>
	$(function() {
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
						btn.text('Generate Files');
						$('#done').removeClass('failed').addClass('block success').text('DONE!');
						console.log('Generating Files complete!');
						$('#result').html(res).hide().fadeIn();
					});
				} else {
					console.log('Fields Empty!');
					btn.text('Generate Again');
					$('#done').removeClass('success').addClass('block failed').text('Empty Fields!');
					$('#result').fadeIn();
				}
			}
		});
	});
</script>
</body>
</html>