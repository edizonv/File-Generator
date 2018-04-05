<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Delivery file checker</title>
	<link rel="stylesheet" href="/assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="/assets/css/bootstrap-theme.min.css">
  <link rel="stylesheet" href="/assets/css/style.css">
</head>
<body>
<br><br>
	<form action="upload.php" method="POST" class="col-md-4 col-md-offset-4">
		<legend><h2>Delivery file checker</h2></legend>
		<br>
		<dl>
			<dt><label for="path">Folder path:</label></dt>
			<dd><input type="text" name="path" id="path" class="form-control"></dd>
			<dt><label for="list">Text file path:</label></dt>
			<dd><input type="text" name="list" id="list" class="form-control"></dd>
			<dd class="text-right"><button class="btn btn-primary btn-lg">Check Files</button></dd>
		</dl>
		<p><a href="../"><< Generate deliver files</a></p>
		<div id="done"></div>
    	<div id="result"></div>
	</form>

	<script src="/assets/js/jquery.js"></script>
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
						console.log('Checking files complete!');
						$('#result').addClass('good').html(res).hide().fadeIn();
          });
          
				} else {
					btn.text('Check Again');
					console.log('Check Again');
					$('#result').hide();
				}

			});
		});
	</script>
</body>
</html>
