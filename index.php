<?php
$document_title = "TOP";
$page_type = "top";
$body_class = "";
require 'config.php';

// Do something special to this document

require ROOT_SRV_PATH.'header.php';
?>
<main id="site-main">
	<div class="container">
		<div class="row">
			<style>
				section {
					margin-bottom: 30px;
				}
				table {
					margin-bottom: 15px;
				}
			</style>
			<section>
				<h1><?php echo $document_title;?></h1>
				[page_type: <?php echo $page_type;?>, #site-main]<br>
				<a href="<?php echo ROOT_URL_PATH;?>subdirectory/">to subdirectory</a>
			</section>
			<section>
				<h1>使える環境変数一覧</h1>
				<?php printConfigTerms();?>
				<table>
					<thead>
						<tr>
							<th colspan="2"><h4>Configurations (page-defined)</h4></th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>$document_title（ページ名）</td>
							<td><?php echo $document_title;?></td>
						</tr>
						<tr>
							<td>$page_type（ページ種）</td>
							<td><?php echo $page_type;?></td>
						</tr>
						<tr>
							<td>$body_class (付加クラス)</td>
							<td><?php echo $body_class;?></td>
						</tr>
					</tbody>
				</table>
			</section>
			<section>
				<h1>PHP 情報</h1>
				<?php phpinfo();?>
			</section>
		</div>
	</div>
</main>
<?php 
	require ROOT_SRV_PATH.'sidebar.php';
	require ROOT_SRV_PATH.'footer.php';
?>