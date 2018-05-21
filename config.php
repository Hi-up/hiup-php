<?php
/* 
	- - - - - - - - - - - - - - - - - - 

	  HiUP Basic PHP Site Configurator
	  Version 3.3.4

	  (c)2018 Iori Tatsuguchi, HiUP
       _   _   _   ____  
      | | | | | | |  _ \ 
      | |_|_| | | | |_) |
      |  _  | | |_| ___/ 
      |_| |_|  \___/  

      H I U P  L L C .

	- - - - - - - - - - - - - - - - - -

	Glossary
	> System Variables 
	  - SITE_VERSION 			サイトのバージョン管理番号
	  - DEV_ENV					開発環境 (DEV_HOST とリクエストURLを比較し判定)
	  - DEV_MODE				開発者モード [true|]
	  							* スイッチ機能あり
								  開発者モード -> リクエスト URL にクエリ文 ?development=true を追加・およびクエリ文無しで且つDEV_HOSTがtrueの場合
								  公開時モード -> リクエスト URL にクエリ文 ?development=false を追加
								* 実際に開発環境にいるかどうかは DEV_ENV [1|] で判断される
	  - ROOT_SRV_PATH			サーバ上のルートディレクトリのパス
	  - ROOT_URL_PATH 			サーバ外のルート URL の相対パス
	  - ROOT_URL_FULLPATH		サーバ外のルート URL の絶対パス
	  - CURRENT_URL_FULLPATH	現ページ URL の絶対パス

	> Meta Information Variables
	  - SITE_NAME
	  - SITE_TITLE
	  - SITE_DESCRIPTION
	  - SITE_KEYWORD
	  - SITE_IMAGE

	- - - - - - - - - - - - - - - - - -

	Tested on:
	PHP Version 5.3.3
				5.4.45
				5.5.27
				5.5.30
				5.6.31

	- - - - - - - - - - - - - - - - - -

	Future development schedules

	  Version 4
	  - Automatic Versioning (SITE_VERSION)
	  - External file switches
	    - Link/Embed
	    - Switch per page-type

	  Version 5
	  - AMP features

	- - - - - - - - - - - - - - - - - -
 */
parse_str($_SERVER['QUERY_STRING'], $queryArray);

/* --------------------- *
 * サイト設定部
 * --------------------- */
date_default_timezone_set("Asia/Tokyo");
define("SITE_VERSION", '0.0.1'); // サイトのバージョン管理番号: 本番環境で外部ファイル名の後にクエリ文として表示
define("SITE_NAME", '[PHP SITE CONFIGURATOR]'); // HEAD 要素内で使用
define("SITE_TITLE", strip_tags($document_title).' | '.SITE_NAME); // HEAD 要素内で使用
define("SITE_DESCRIPTION", '[Workframe for minimal PHP website]'); // HEAD 要素内で使用
define("SITE_KEYWORD", ''); // HEAD 要素内で使用
define("SITE_IMAGE", 'common/site.jpb'); // SNS 上でサムネイルとして使用
define("FB_APP_ID", ''); // facebook app の ID
$link_stylesheet = array( // HEAD 要素ないで読み込むスタイルシート
	//"stylesheets/plugins/font-awesome.min.css",
	"stylesheets/style.css"
);
$script_javascript = array( // BODY 要素最下部で読み込むスクリプト
	"scripts/jquery-3.2.1.min.js",
	"scripts/slick.min.js",
	"scripts/script.js"
	//"scripts/script.min.js"
);
$script_javascript_embed = array( // currently developing: embed script
);
define("PROD_HOST", 'demo.hiup.jp'); // 公開サーバのホスト名
define("PROD_SRV_PATH", 'hiup-php/'); // テストサーバ上のルートパス（URLとして直接反映される）
define("PROD_URL_PATH", PROD_SRV_PATH); // テストサーバ上のURLパス（URLとして直接反映される）
define("DEV_HOST", 'demo.hiup.jp'); // テストサーバのホスト名
define("DEV_SRV_PATH", 'hiup-php/'); // テストサーバ上のルートパス
define("DEV_URL_PATH", DEV_SRV_PATH); // テストサーバ上のURLパス（URLとして直接反映される）

/* --------------------- *
 * 固定値の定義部
 * --------------------- */
// Environment definitions
define("DEV_ENV", (strpos($_SERVER['HTTP_HOST'], DEV_HOST) !== false));
if (array_key_exists('development', $queryArray)) {
	if ($queryArray['development'] === 'false')
		define("DEV_MODE", '');
	elseif ($queryArray['development'] === 'true')
		define("DEV_MODE", true);
} else {
	define("DEV_MODE", DEV_ENV);
}
// URL definitions
define("SITE_PROTOCOL", (isset($_SERVER['HTTPS']) ? "https" : "http").'://');
define("CURRENT_URL_FULLPATH", SITE_PROTOCOL.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
define("ROOT_URL_PATH", DEV_ENV ? '/'.DEV_URL_PATH : '/'.PROD_URL_PATH);
define("ROOT_URL_FULLPATH", SITE_PROTOCOL.$_SERVER['HTTP_HOST'].ROOT_URL_PATH);
define("ROOT_SRV_PATH", dirname(__FILE__).'/');

/* --------------------- *
 * 公開時モード設定
 * --------------------- */
if (!DEV_MODE) {
	define("URL_TRAILING", '?v='.SITE_VERSION);
} else {
	define("URL_TRAILING", '');
	error_reporting(E_ALL);
    ini_set('display_errors', 1);
}

/* --------------------- *
 * Config 値出力
 * --------------------- */
$showConfigTerms = false; // 使える設定値を出力
$config_terms = array(
	"Configurations" => array(
		"meta" => array(
			"SITE_VERSION",
			"SITE_NAME",
			"SITE_TITLE",
			"SITE_DESCRIPTION",
			"SITE_KEYWORD",
			"SITE_IMAGE",
			"FB_APP_ID"
		),
		"server" => array(
			"PROD_HOST",
			"PROD_SRV_PATH",
			"PROD_URL_PATH",
			"DEV_HOST",
			"DEV_SRV_PATH",
			"DEV_URL_PATH"
		)
	),
	"Environment Definitions" => array (
		"DEV_ENV",
		"DEV_MODE",
	),
	"URL Definitions" => array (
		"SITE_PROTOCOL",
		"CURRENT_URL_FULLPATH",
		"ROOT_URL_PATH",
		"ROOT_URL_FULLPATH",
		"ROOT_SRV_PATH",
		"URL_TRAILING"
	)
);
function printConfigTerms() {
	global $config_terms;
	foreach ($config_terms as $main_cat_name => $main_cat_content):?>
			<meta charset="utf-8">
			<table>
				<thead>
					<tr>
						<th colspan="10"><h1><?php echo $main_cat_name;?></h1></th>
					</tr>
				</thead>
				<tbody>
			<?php
			foreach($main_cat_content as $sub_cat_name => $sub_cat_content):
				if (is_array($sub_cat_content)):
					$count = 0;
					foreach ($sub_cat_content as $sub_sub_cat_name => $sub_sub_cat_content):?>
						<tr>
						<?php if ($count == 0): $count++; ?>
							<th rowspan="<?php echo sizeof($sub_cat_content)?>"><h2><?php echo $sub_cat_name;?></h2></th>
						<?php endif;?>
							<td><b><?php echo $sub_sub_cat_content;?></b></td>
							<td><?php echo constant($sub_sub_cat_content);?></td>
						</tr>
					<?php endforeach;
				else: ?>
						<tr>
							<td><b><?php echo $sub_cat_content;?></b></td>
							<td><?php echo constant($sub_cat_content);?></td>
						</tr>
				<?php endif;
			endforeach;?>
				</tbody>
			</table> <?php
		endforeach;
}
if ($showConfigTerms)
	printConfigTerms();


?>