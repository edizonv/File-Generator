<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Delivery File Checker</title>
	<link rel="stylesheet" href="../style.css">
</head>
<body>
<br><br>
	<form action="upload.php" method="POST">
		<legend><h1>Delivery File Checker</h1></legend>
		<br>
		<dl>
			<dt><label for="path">Folder Path:</label></dt>
			<dd><input type="text" name="path" id="path"></dd>
			<dt><label for="list">Filelist Path:</label></dt>
			<dd><input type="text" name="list" id="list"></dd>
			<dd><button>Check Files</button></dd>
		</dl>
		<p><a href="../">Generate deliver files</a></p>
		<div id="done"></div>
    	<div id="result"></div>
	</form>

	<script src="../jquery.js"></script>
	<script>
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
	</script>
</body>
</html>
