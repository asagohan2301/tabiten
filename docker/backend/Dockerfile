FROM php:7.4-fpm

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

# 依存関係のインストール
RUN composer install

# ポート9000を公開
EXPOSE 9000

# PHP-FPMを起動
CMD ["php-fpm"]
