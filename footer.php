
<footer id="site-footer">
	<div class="container">
		<div class="row">
			<section>
				[#site-footer]
			</section>
		</div>
	</div>
</footer>

<div id="vail"></div>

<?php foreach ($script_javascript as $script_javascript_url) : ?>
	<script src="<?php echo ROOT_URL_PATH.$script_javascript_url.URL_TRAILING; ?>"></script>
<?php endforeach; ?>

<?php if (array_key_exists('development', $queryArray)) :?>
	<script>
		<?php if (DEV_ENV && !DEV_MODE) :?>
		var queryString = '?development=false';
		alert('開発環境＋本番モード（開発サーバステージング）で表示しています。\n表示バージョン: <?php echo SITE_VERSION; ?>');
		<?php elseif (!DEV_ENV && DEV_MODE) :?>
		var queryString = '?development=true';
		alert('公開環境＋開発モード（公開サーバステージング）で表示しています。\n表示バージョン: <?php echo SITE_VERSION; ?>');
		<?php endif;?>
		$(function(){
			$('a:not([target="_blank"])').each(function() {
				var href = $(this).attr('href'),
					hashIndex = href.indexOf('#');
				if (hashIndex >= 0) {
					var hrefUrl = href.substr(0, hashIndex),
						hrefHash = href.substr(hashIndex);
				} else {
					var hrefUrl = href,
						hrefHash = "";
				}
				$(this).attr('href', hrefUrl + queryString + hrefHash);
			});
		});
	</script>
<?php endif; ?>
</body>
</html>