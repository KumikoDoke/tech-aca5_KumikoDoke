# テーマ3 : 掲示板1

## ディレクトリ名

* board1


## 基本要件

### PHPMyAdmin

* GUIでDBとテーブルをつくり、データを入れてみる
* SQLで SELECT / INSERT / UPDATE / DELETE してみる

### プログラム(PDO)

* DB接続する
* SELECT / INSERT / UPDATE / DELETE する

## 応用要件
* 既に投稿された「ユーザ名」と「本文」を表示できる
* 「ユーザ名」と「本文」を投稿できる
* データの保存にはデータベースを使う
  - テーブル定義は「掲示板のテーブル定義」シートに従う
  - ただし、型とその他項目は各自考える
* SQLインジェクション対策ができている（PDOを使用している）
* XSS対策ができている（htmlspecialcharsを使用している）
* 使用する言語はPHPとHTML

## 手順
1. データベース（以下DB）とは何かを学習する
1. SQLを学習する
1. PHPMyAdminでDBとテーブルを作成し、テストデータを入れておく
　※「掲示板のテーブル定義」シートに従う
1. PHPからDBに接続し、保存されている内容を取得する
1. PHPを使い、DBに保存されている内容をWebの画面に表示する
1. PHPでPOSTした内容をDBに保存する
1. 掲示板として機能させる"


## テーブル定義について

### データベース名

* board1_db

### テーブル名

* post_table
  - 投稿内容

### カラム構成

#### post_table（投稿内容を保存するテーブル）

  | カラム名 | 型           | その他                | カラムの内容     |
  |----------|--------------|-----------------------|------------------|
  | id       | int          | primary key, not null | 投稿ID           |
  | name     | varchar(255) |                       | 投稿した人の名前 |
  | contents | text         |                       | 投稿された本文   |