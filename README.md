# 📝 techmeets-blog

techmeets の Week 6〜17 で作成するブログアプリのリポジトリです。
Week 6 では、Docker（Docker Compose）を使って Laravel の開発環境を構築しました。

---

## 🛠️ 使用技術

| 分類 | 技術 |
|---|---|
| フレームワーク | Laravel 12 |
| 言語 | PHP 8.2（PHP-FPM） |
| Web サーバー | Nginx |
| データベース | MySQL 8.0 / phpMyAdmin |
| 環境 | Docker / Docker Compose |

---

## 🐳 コンテナ構成

| サービス名 | 役割 | URL・ポート |
|---|---|---|
| `nginx` | Web サーバー。ブラウザからのリクエストを受け付ける | http://localhost |
| `app` | PHP-FPM。Laravel（PHP）を実行する | 9000（コンテナ内のみ） |
| `db` | MySQL。データを保存する | localhost:3306 |
| `phpmyadmin` | ブラウザから MySQL を操作する管理ツール | http://localhost:8080 |

リクエストの流れ：ブラウザ → `nginx` → `app` → `db`

---

## 📁 ディレクトリ構成

```
laravel-docker-app/
├── docker/
│   ├── nginx/
│   │   └── default.conf    # Nginx の設定
│   └── php/
│       └── Dockerfile      # PHP（app コンテナ）のイメージ設定
├── src/                    # Laravel プロジェクト
├── docker-compose.yml      # コンテナの構成
├── .env.example            # Docker 用の環境変数のサンプル
└── README.md
```

---

## 🚀 セットアップ手順

### 前提

- Docker Desktop をインストールし、起動して「Engine running」になっていること
- ポート 80・3306・8080 がほかのソフト（XAMPP など）で使われていないこと

### 1. リポジトリをクローンする

```bash
git clone https://github.com/erika1230s0125-cpu/techmeets-blog.git
cd techmeets-blog
```

### 2. Docker 用の `.env` を作る

```bash
cp .env.example .env
```

ポート番号を変えたい場合は、`.env` の値を書き換えます。

### 3. コンテナを起動する

```bash
docker compose up -d --build
```

初回はイメージのビルドがあるため、数分かかります。`docker compose ps` で 4 つのコンテナが `running` になっていれば OK です。

### 4. Laravel のパッケージをインストールする

`src/vendor/` は Git で管理していないため、Composer でインストールします。

```bash
docker compose exec -e COMPOSER_PROCESS_TIMEOUT=0 app composer install
```

> 💡 Windows では、ファイルの展開に時間がかかり、Composer が時間切れ（300秒）で止まることがあります。`COMPOSER_PROCESS_TIMEOUT=0` で制限時間をなくしています。

### 5. Laravel 用の `.env` を作る

```bash
cp src/.env.example src/.env
```

`src/.env` のデータベース設定を、次のように書き換えます（`DB_HOST` は docker-compose.yml のサービス名 `db`）。

```ini
DB_CONNECTION=mysql
DB_HOST=db
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=root
DB_PASSWORD=secret
```

### 6. アプリケーションキーを作り、権限を設定する

```bash
docker compose exec app php artisan key:generate
docker compose exec app chown -R www-data:www-data storage bootstrap/cache
docker compose exec app chmod -R 775 storage bootstrap/cache
```

### 7. マイグレーションを実行する

```bash
docker compose exec app php artisan migrate
```

### 8. ブラウザで確認する

| URL | 確認すること |
|---|---|
| http://localhost | Laravel のウェルカムページが表示される |
| http://localhost:8080 | phpMyAdmin で `laravel` データベースのテーブルが見える |

### 作業を終えるとき

```bash
docker compose down
```

データベースのデータは `db-data` ボリュームに保存されるため、コンテナを削除しても消えません。

---

## 🧰 よく使うコマンド

| やりたいこと | コマンド |
|---|---|
| コンテナを起動する | `docker compose up -d` |
| コンテナを停止・削除する | `docker compose down` |
| コンテナの状態を見る | `docker compose ps` |
| ログを見る | `docker compose logs app` |
| app コンテナに入る | `docker compose exec app bash` |
| Artisan コマンドを実行する | `docker compose exec app php artisan <コマンド>` |

---

## ⚠️ トラブルシューティング

| 症状 | 対処 |
|---|---|
| `failed to connect to the docker API` | Docker Desktop を起動する |
| `port is already allocated` | 同じポートを使っているソフトを止めるか、`.env` のポート番号を変える |
| Composer が `exceeded the timeout of 300 seconds` で止まる | 手順4のように `COMPOSER_PROCESS_TIMEOUT=0` を付けて `composer install` をやり直す |
| `No application encryption key has been specified.` | `docker compose exec app php artisan key:generate` を実行する |
| データベースに接続できない | `src/.env` の `DB_CONNECTION` が `mysql`、`DB_HOST` が `db` になっているか確認する |
| `Permission denied` | 手順6の `chown` と `chmod` をもう一度実行する |
