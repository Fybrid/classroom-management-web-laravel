# laravel filament

## 動作確確認環境
mac os

## 初期設定
### 1. docker起動
```shell
$ cp -f ./build/docker/.env.example ./build/docker/.env
$ docker compose --env-file ./build/docker/.env up -d --build
```
コンテナ内実行
```shell
$ docker compose --env-file ./build/docker/.env exec workspace bash
```

### 2. laravel起動(コンテナ内)
```shell
# 環境依存有
$ cd /var/www/app
$ composer install
$ cp .env.docker.example .env
$ php artisan key:generate
$ php artisan storage:link
$ chmod -R 775 bootstrap/cache && chmod -R 775 storage
$ chown -R www-data:adm storage && chown -R www-data:adm bootstrap/cache
$ php artisan migrate:fresh --seed
```

### 3. laravel起動確認
http://lvh.me

## コマンドリスト
```shell
```

## ドキュメント(必読!)
- [git commit rule](./docs/markdown/git/commit.md)
- [git branch rule](./docs/markdown/git/branch.md)
- [git release-drafter document](./docs/markdown/git/release-drafter.md)
- [laravel filament](./docs/markdown/laravel/filament/index.md)