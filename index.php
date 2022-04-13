<?php require_once 'inc/header.php' ?>
<div id="outer">
    <div id="videoContainer" class="h-100">
        <div class="row title">
            <h1>Doku Ackerstra&szlig;e 1973</h1>
        </div>
        <div class="row subtitle">
            <h3><a target="_blank" href="https://de.wikipedia.org/wiki/Berlin-Milieu:_Ackerstra%C3%9Fe_1973">>
                    Wikipedia</a></h3>
        </div>
        <div id="videoWrapper">
            <div class="row votes">
                <div id="up" class="" title="Gefällt mir">
                    <span></span>
                </div>
                <div id="down" class="ml-2" title="Gefällt mir nicht">
                    <span></span>
                </div>
                <div id="views" title="Visits">
                    Views: <span></span>
                </div>
            </div>
            <div class="row video">
                <video class="float-right" poster="/media/ackerstrasse1973.jpg" width="522" controls>
                    <source src="/media/ackerstrasse1973.mp4" type="video/mp4">
                </video>
            </div>
        </div>
    </div>
</div>
<script>
	$(document).ready(function () {
		let video = document.querySelector('video')
			$up = $('#up')
			$down = $('#down')
			hasPlay = false

        video.onfullscreenchange = e => {
			console.info("zIndex", e.target.style)
        }

		$.get('/api/vote/values').done((resp) => {
			$('#up span').text(resp.countUp);
			$('#down span').text(resp.countDown);
		});
		$.get('/api/stat/values').done((resp) => {
			$('#views span').text(resp.countStat);
		});

		$up.one('click', () => {
			$.get('/api/vote/1').done((resp) => {
				$('#up span').text(resp.countUp);
			});
		});

		$down.one('click', () => {
			$.get('/api/vote/0').done((resp) => {
				$('#down span').text(resp.countDown);
			});
		});

		video.onplaying = () => {
			if (!hasPlay) {
				$.get('/api/stat/1').done((resp) => {
					$('#views span').text(resp.countStat);
					hasPlay = true;
				});
			}
		}
	});
</script>
<?php require_once 'inc/footer.php' ?>
