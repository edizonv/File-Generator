<style>
	#hidden {
		display: none;
	}
	small {
		color: blue;
		font-size: 10px;
		display: block;
		margin-bottom: 30px;
	}
	.red {
		color: #fff;
		background-color: red;
	}
	.green {
		color: #fff;
		background: green;
	}
</style>
<?php

function phpCurl($url) {
	$ch = curl_init($url);
	curl_setopt($ch, CURLOPT_USERPWD, "wacoal:tcapwacoal2016!");
	$response = curl_getinfo($ch, CURLINFO_HTTP_CODE);
	$output = curl_exec($ch);
	curl_close($ch);
	return $output;
}

$url = "http://wacoal.tcapdmwis.com/ballerina/camp/";

echo "<div id='hidden'>";
$html = phpCurl($url);
echo "</div>";


?>
<input type="hidden" id="hiddenurl">


<div id="result"></div>

<script src="../jquery.js"></script>
<script>
	$(function() {
		var images = $('img');
		var array = [];
		$(images).each(function() {
			var imgs = $(this).attr('src') + "<br/>";
			var alts = $(this).attr('alt') + "";

			if (alts == "") {
				array.push(imgs + '<small class="red">no alt</small>');
			} else {
				array.push(imgs + '<small class="green">'+alts+'</small>');
			}

			
		})

		$('#result').html(array);

	});
</script>