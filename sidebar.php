<aside id="site-sidebar">
	<div class="container">
		<div class="row">
		<?php if ($page_type == "top"):?>
			<section>
				Sidebar contents for BODY[data-page-type="top"].
			</section>
		<?php elseif ($page_type == "default"):?>
			<section>
				Sidebar contents for BODY[data-page-type="default"].
			</section>
		<?php endif;?>
			<section>
				[page_type: <?php echo $page_type;?>, #site-sidebar]
			</section>
		</div>
	</div>
</aside>