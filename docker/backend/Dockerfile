FROM php:7.4-fpm as base

# 必要なパッケージをOSにインストール
RUN apt-get update && apt-get install -y \
  curl \
  unzip \
  git \
  zip \
  libonig-dev \
  && docker-php-ext-install pdo pdo_mysql mbstring

# 新しいユーザーを追加
RUN useradd -m tabiten

# コンテナ内の作業ディレクトリを設定
# このディレクトリは、後続のCOPYやRUNコマンドの基準となる
WORKDIR /var/www

# Composerをインストール
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# ローカルのソースコードをコンテナの作業ディレクトリにコピー
COPY . .
# 作業ディレクトリ以下の所有者を新しいユーザーに変更
RUN chown -R tabiten:tabiten /var/www

# 新しいユーザーに切り替え
USER tabiten

# 開発環境用のビルドステージ
FROM base as development

# 依存関係のインストール
RUN composer install

# ポート9000を公開
EXPOSE 9000

# PHP-FPMを起動
CMD ["php-fpm"]

# 本番環境用のビルドステージ
FROM base as production

# 依存関係のインストール（本番用）
RUN composer install --no-dev --optimize-autoloader

# キャッシュをクリアし、オプティマイズコマンドを実行
RUN php artisan config:cache && php artisan route:cache && php artisan view:cache

# ポート9000を公開
EXPOSE 9000

# PHP-FPMを起動
CMD ["php-fpm"]
