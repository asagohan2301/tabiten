# ベースイメージ
FROM nginx:alpine as base

# 開発環境用ステージ
FROM base as development
COPY default.dev.conf /etc/nginx/conf.d/default.conf

# 本番環境用ステージ
FROM base as production
COPY default.prod.conf /etc/nginx/conf.d/default.conf
