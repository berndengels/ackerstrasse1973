<?php require_once 'inc/header.php' ?>

<!--div class="row mt-5"-->
    <h1>Doku Ackerstra&szlig;e 1973<br><span><a target="_blank" href="https://de.wikipedia.org/wiki/Berlin-Milieu:_Ackerstra%C3%9Fe_1973">Wikipedia</a></span></h1>
<!--/div-->
<div id="video">
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
    <div class="row">
        <div id="videoWrapper">
            <video class="float-right" poster="/media/ackerstrasse1973.jpg" height="400" controls>
                <source src="/media/ackerstrasse1973.mp4" type="video/mp4">
            </video>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
	var video = document.querySelector('video'),
        $up = $('#up'),
        $down = $('#down'),
        hasPlay = false
    ;
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
		if(!hasPlay) {
			$.get('/api/stat/1').done((resp) => {
				$('#views span').text(resp.countStat);
				hasPlay = true;
			});
        }
    }
});
</script>
<?php require_once 'inc/footer.php' ?>
