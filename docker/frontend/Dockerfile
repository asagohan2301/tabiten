FROM node:18

# コンテナ内の作業ディレクトリを設定
WORKDIR /app

# 依存関係のインストール
COPY package.json package-lock.json ./
RUN npm install

# ローカルのソースコードをコンテナの作業ディレクトリにコピー
COPY . .

# ポート3000を公開
EXPOSE 3000

# 開発サーバーを起動
CMD ["npm", "run", "dev"]
