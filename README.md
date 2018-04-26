# hiup-php
HiUP Basic PHP Site Configurator
-HiUP PHP サイトのテンプレ

## Glossary

### System Variables 
#### SITE_VERSION
サイトのバージョン管理番号
#### DEV_ENV
開発環境 (DEV_HOST とリクエストURLを比較し判定)
#### DEV_MODE
開発者モード [true|]
* スイッチ機能あり
開発者モード -> リクエスト URL にクエリ文 ?development=true を追加・およびクエリ文無しで且つDEV_HOSTがtrueの場合
公開時モード -> リクエスト URL にクエリ文 ?development=false を追加
* 実際に開発環境にいるかどうかは DEV_ENV [1|] で判断される
#### ROOT_SRV_PATH
サーバ上のルートディレクトリのパス
#### ROOT_URL_PATH
サーバ外のルート URL の相対パス
#### ROOT_URL_FULLPATH
サーバ外のルート URL の絶対パス
#### CURRENT_URL_FULLPATH
現ページ URL の絶対パス

### Meta Information Variables
#### SITE_NAME
#### SITE_TITLE
#### SITE_DESCRIPTION
#### SITE_KEYWORD
#### SITE_IMAGE

- - - - - - - - - - - - - - - - - -

Tested on PHP Version:
- 5.3.3
- 5.4.45
- 5.5.27
- 5.5.30
- 5.6.31

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
