<?php require_once 'inc/header.php' ?>

<div class="card-header">
    <h5>Doku Ackerstrasse 1973 <span>(<a target="_blank" href="https://de.wikipedia.org/wiki/Berlin-Milieu:_Ackerstra%C3%9Fe_1973">Wikipedia</a>
)</span></h5>
</div>
<div class="card-body">

<div class="row">
    <video class="col-sm-12 col-md-6" poster="/media/ackerstrasse1973.jpg" controls>
        <source src="/media/ackerstrasse1973.mp4" type="video/mp4">
    </video>
</div>
<div class="row mt-3 align-content-center votes">
    <div id="up" class="" title="Gefällt mir">
        <span></span>
    </div>
    <div id="down" class="ml-5" title="Gefällt mir nicht">
        <span></span>
    </div>

    <div id="views" class="ml-5" title="Visits">
        Views: <span></span>
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
