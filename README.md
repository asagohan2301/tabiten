# TabiTen

## 概要

本リポジトリは、「地域を選択すると、天気がわかるサービス」を作成したものです。
旅行に行く人が、現地の天気を確認する目的で利用します。

## URL

[TabiTen](https://www.asagohan.net/)

## 機能

- 都市を選択すると、7 日分の天気を表示します。

## 仕様

- 都市が選択されると、今日から 7 日分の範囲で DB を検索して、データがあればそれを表示します。  
  DB に 7 日分のうち一部があれば、ある分は DB のデータを使って表示し、足りない日にち分だけ外部 API から取得して表示し、DB に保存します。  
  DB に 1 日分もなければ、外部 API から 7 日分取得して表示し、DB に保存します。
- 天気情報取得に必要な緯度経度は、事前に cities テーブルの都市名から取得して格納します。以下のコマンドで緯度経度の取得と保存を実行します。

  ```bash
  php artisan update:coordinates
  ```

### 追加したい仕様 (未作成)

- 過去の日付の天気データを自動的に削除。
- DB から天気のデータ取得時に保存日時をチェックし、一定期間以上経過している場合は API から再度最新データを取得し、DB を更新。
- 「晴れのち曇り」など時間ごとの天気を表示。
- 「雨」のなかでも「大雨」「小雨」などを分けて表示。

## DB 構成

### areas

- 「東アジア」などの地域名を格納するテーブル

| カラム名   | データ型    | キー    | NOT NULL | バリデーション | INDEX | 概要     |
| ---------- | ----------- | ------- | -------- | -------------- | ----- | -------- |
| id         | BIGINT      | Primary | 〇       |                | 〇    | ID       |
| area_name  | VARCHAR(50) | Unique  | 〇       | 1 ～ 50 文字   |       | エリア名 |
| order      | INT         |         | 〇       |                |       | 表示順序 |
| created_at | DATETIME    |         | 〇       |                |       | 登録日時 |
| updated_at | DATETIME    |         | 〇       |                |       | 更新日時 |

### countries

- 「日本」などの国名を格納するテーブル

| カラム名     | データ型    | キー    | NOT NULL | バリデーション | INDEX | 概要           |
| ------------ | ----------- | ------- | -------- | -------------- | ----- | -------------- |
| id           | BIGINT      | Primary | 〇       |                | 〇    | ID             |
| country_name | VARCHAR(50) | Unique  | 〇       | 1 ～ 50 文字   |       | 国名           |
| reading      | VARCHAR(50) |         | 〇       | 1 ～ 50 文字   |       | 国名の読み仮名 |
| area_id      | BIGINT      | Foreign | 〇       |                |       | エリア ID      |
| created_at   | DATETIME    |         | 〇       |                |       | 登録日時       |
| updated_at   | DATETIME    |         | 〇       |                |       | 更新日時       |

### cities

- 「東京」などの都市名や、緯度経度を格納するテーブル

| カラム名   | データ型       | キー    | NOT NULL | バリデーション | INDEX | 概要                             |
| ---------- | -------------- | ------- | -------- | -------------- | ----- | -------------------------------- |
| id         | BIGINT         | Primary | 〇       |                | 〇    | ID                               |
| city_name  | VARCHAR(50)    |         | 〇       | 1 ～ 50 文字   |       | 都市名                           |
| reading    | VARCHAR(50)    |         | 〇       | 1 ～ 50 文字   |       | 都市名の読み仮名                 |
| country_id | BIGINT         | Foreign | 〇       |                |       | 国 ID                            |
| latitude   | DECIMAL(9, 6)  |         |          |                |       | 緯度 -90.000000 から 90.000000   |
| longitude  | DECIMAL(10, 6) |         |          |                |       | 経度 -180.000000 から 180.000000 |
| created_at | DATETIME       |         | 〇       |                |       | 登録日時                         |
| updated_at | DATETIME       |         | 〇       |                |       | 更新日時                         |

### weathers

- 日ごとの天気情報を格納するテーブル

| カラム名                  | データ型    | キー    | NOT NULL | バリデーション | INDEX | 概要            |
| ------------------------- | ----------- | ------- | -------- | -------------- | ----- | --------------- |
| id                        | BIGINT      | Primary | 〇       |                | 〇    | ID              |
| city_id                   | BIGINT      | Foreign | 〇       |                | 〇    | 都市 ID         |
| date                      | DATE        |         | 〇       |                | 〇    | 日付            |
| weather_code              | INT         | Foreign | 〇       |                |       | 天気コード(WMO) |
| temp_max                  | FLOAT(4, 1) |         |          |                |       | 最高気温        |
| temp_min                  | FLOAT(4, 1) |         |          |                |       | 最低気温        |
| precipitation_probability | INT         |         |          |                |       | 降水確率        |
| created_at                | DATETIME    |         | 〇       |                |       | 登録日時        |
| updated_at                | DATETIME    |         | 〇       |                |       | 更新日時        |

### weather_codes

- 天気コードごとの天気カテゴリーと説明を格納するテーブル

| カラム名     | データ型    | キー    | NOT NULL | バリデーション | INDEX | 概要            |
| ------------ | ----------- | ------- | -------- | -------------- | ----- | --------------- |
| id           | BIGINT      | Primary | 〇       |                | 〇    | ID              |
| weather_code | INT         | Unique  | 〇       |                | 〇    | 天気コード(WMO) |
| category     | VARCHAR(20) |         | 〇       | 1 ～ 20 文字   | 〇    | 天気の分類      |
| description  | VARCHAR(50) |         | 〇       | 1 ～ 50 文字   |       | 天気の説明      |
| created_at   | DATETIME    |         | 〇       |                |       | 登録日時        |
| updated_at   | DATETIME    |         | 〇       |                |       | 更新日時        |

## 使用技術

- 言語 / FW: PHP 7.4 , Laravel 8.83, Next.js 14.2
- データベース: MySQL
- Web サーバー: Nginx
- インフラ: AWS (ESC, RDS)
- 開発環境: Docker Compose
- ソース管理：GitHub
- 外部 API：
  - 緯度経度の取得: Google Maps Platform API (Geocoding API)
  - 天気の取得: Open-Meteo (Free Weather API)
