<?php
$document_title = "TEST";
$page_type = "default";
$body_class = "";
require 'config.php';

// Do something special to this document

require ROOT_SRV_PATH.'header.php';
?>
<main id="site-main">
	<div class="container">
		<section id="transition-override-test" class="row">
			<div class="col-xs-6 add default">
				New Classname/rule: added
			</div>
			<div class="col-xs-6 replace default">
				New Classname/rule: replaced
			</div>
		</section>
<section id="mq-test">
<div class="hidden-xs">hidden-xs</div>
<div class="hidden-sm">hidden-sm</div>
<div class="hidden-md">hidden-md</div>
<div class="hidden-lg">hidden-lg</div>
</section>
		<button id="toggle-action">Translition!</button>
		<script>
			document.getElementById('toggle-action').addEventListener(function(){
				
			});
		</script>
	</div>
</main>
<?php 
	require ROOT_SRV_PATH.'sidebar.php';
	require ROOT_SRV_PATH.'footer.php';
?>
