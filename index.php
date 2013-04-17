<html>
<head>
	<title>Soundmanager 2 Testing</title>
	<!-- soundManager API -->
	<script src="soundmanager2/script/soundmanager2.js"></script>

</head>
<body style='font-size:2em;'>
	<h4>Soundmanager 2 iOS Test</h4>
	<strong>PHP Delivered:</strong>
	<a href="#" onclick='javascript:playsound("phpmp3");return false;'>mp3</a> | 
	<a href="#" onclick='javascript:playsound("phpm4a");return false;'>m4a</a><br />
	<strong>Direct Linked:</strong>
	<a href="#" onclick='javascript:playsound("directmp3");return false;'>mp3</a> | 
	<a href="#" onclick='javascript:playsound("directm4a");return false;'>m4a</a><br />
	<hr />
	<a href='#' onclick='javascript:soundManager.stopAll();return false;'>Stop sm2 players</a>
	<hr />
	<h4>HTML5 Audio Test</h4>
	<strong>PHP Delivered:</strong>
	<a href='#' onclick='javascript:playhtml5sound("podcast/bunny.mp3");return false;'>mp3</a> | 
	<a href='#' onclick='javascript:playhtml5sound("podcast/bunny.m4a");return false;'>m4a</a><br />
	<strong>Direct linked:</strong>
	<a href='#' onclick='javascript:playhtml5sound("bunny.mp3");return false;'>mp3</a> | 
	<a href='#' onclick='javascript:playhtml5sound("bunny.m4a");return false;'>m4a</a><br />

	<script>	  
		soundManager.setup({
		    flashVersion: 9,
		    preferFlash: false, 
		    url: '../soundmanager2/swf/',
		    onready: function() {
				soundManager.createSound({
					id: 'phpmp3',
					url: 'podcast/bunny.mp3',
					volume: 50
				});

				soundManager.createSound({
					id: 'phpm4a',
					url: 'podcast/bunny.m4a',
					volume: 50
				});

				soundManager.createSound({
					id: 'directmp3',
					url: 'bunny.mp3',
					volume: 50
				});

				soundManager.createSound({
					id: 'directm4a',
					url: 'bunny.m4a',
					volume: 50
				});
		    }
		});

		function playsound(id) {
			console.log('Playing sound..');
			var sound = soundManager.getSoundById(id);
			sound.play();
		}

		function playhtml5sound(file) {
			new Audio(file).play();
		}

	</script>

</body>
</html>
