<!DOCTYPE html>
<html dir="ltr" lang="ja-jp">
<head prefix="og: http://ogp.me/ns# fb: http://ogp.me/ns/fb# article: http://ogp.me/ns/article#">
<?php if (DEV_ENV) : ?>
	<meta name="robots" content="noindex">
<?php endif; ?>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="format-detection" content="telephone=no">
	<!--[if IE]><link rel="shortcut icon" href="<?php echo ROOT_URL_PATH; ?>favicon.ico"><![endif]-->
	<link rel="apple-touch-icon" sizes="180x180" href="<?php echo ROOT_URL_PATH; ?>img/favicons/apple-touch-icon.png">
	<link rel="icon" type="image/png" sizes="32x32" href="<?php echo ROOT_URL_PATH; ?>img/favicons/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="16x16" href="<?php echo ROOT_URL_PATH; ?>img/favicons/favicon-16x16.png">
	<link rel="manifest" href="<?php echo ROOT_URL_PATH; ?>manifest.json">
	<meta name="theme-color" content="#ffffff">

	<title><?php echo SITE_TITLE; ?></title>
	<meta name="description" content="<?php echo SITE_DESCRIPTION; ?>">
	<meta name="keywords" content="<?php echo SITE_KEYWORD; ?>">

	<meta property="og:locale" content="ja_JP">
	<meta property="og:type" content="website">
	<meta property="og:url" content="<?php echo CURRENT_URL_FULLPATH; ?>">
	<meta property="og:title" content="<?php echo SITE_TITLE; ?>">
	<meta property="og:description" content="<?php echo SITE_DESCRIPTION; ?>">
	<meta property="og:site_name" content="<?php echo SITE_NAME; ?>">
	<meta property="og:image" content="<?php echo SITE_IMAGE; ?>">
	<meta property="og:image:width" content="709">
	<meta property="og:image:height" content="72">
	<meta property="fb:app_id" content="<?php echo FB_APP_ID; ?>">
	<meta name="twitter:card" content="summary">

<?php foreach ($link_stylesheet as $link_stylesheet_url) : ?>
    <link rel="stylesheet" href="<?php echo ROOT_URL_PATH.$link_stylesheet_url.URL_TRAILING; ?>">
<?php endforeach; ?>
</head>
<body class="<?php echo $page_type.' '.$body_class; ?>" data-page-type="<?php echo $page_type; ?>">

<div id="drawer-nav-background"></div>

<header id="site-header" class="sp-nav-off">
	<div class="container">
		<div class="row">
			<section>
				[#site-header]
			</section>
			<button id="button-drawer-nav">
				<span class="bar"></span>
				<span class="bar"></span>
				<span class="bar"></span>
			</button>
			<div id="site-header-xs-drawer" class="hidden-lg">
				<nav id="drawer-nav">
					<div class="wrap">
						<ul>
							<li><a href="">[lv1 link #1]</a></li>
							<li><a href="">[lv1 link #2]</a></li>
							<li class="border-top">
								<p>[lv1 tree]</p>
								<ul>
									<a href="">[lv2 link #1]</a>
									<a href="">[lv2 link #2]</a>
									<a href="">[lv2 link #3]</a>
									<a href="">[lv2 link #4]</a>
									<a href="">[lv2 link #5]</a>
								</ul>
							</li>
						</ul>
						<p class="drawer-nav-toggle"><small>[close]</small></p>
					</div>
				</nav>
			</div>
		</div>
	</div>
</header>

