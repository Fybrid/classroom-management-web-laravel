# laravel docker template

## 動作確確認環境
mac os

## laravelプロジェクトの作成(docker)
### 1. docker起動
```shell
$ cp -f ./build/docker/.env.example ./build/docker/.env
$ docker compose --env-file ./build/docker/.env up -d --build
```
コンテナ内実行
```shell
$ docker compose --env-file ./build/docker/.env exec workspace bash
```

### 2. laravel作成(コンテナ内)
```shell
$ cd /var/www
$ composer create-project laravel/laravel tmp
$ cp -f ./app/README.md ./tmp/README.md
# 注意：readme等の同一ファイルは上書きされる
$ mv tmp/* tmp/.[!.]* tmp/..?* app/
$ rm -r tmp
```
.envの設定  
.env.docker.exampleファイルにdocker固有の設定を記入しているので、.envにマージすること。  
マージ後下記のコマンドを実行
```shell
$ cp .env .env.docker.example
```

### 3. laravel起動(コンテナ内)
```shell
# 環境依存有
$ cd /var/www/app
$ composer install
$ php artisan key:generate
$ php artisan storage:link
$ chmod -R 775 bootstrap/cache && chmod -R 775 storage
$ chown -R www-data:adm storage && chown -R www-data:adm bootstrap/cache
$ php artisan migrate:fresh --seed
```

### 4. laravel起動確認
https://lvh.me

## コマンドリスト
```shell
```

## ドキュメント
- [git commit rule](./docs/markdown/git/commit.md)
- [git branch rule](./docs/markdown/git/branch.md)
- [git release-drafter document](./docs/markdown/git/release-drafter.md)
- [laravel filament](./docs/markdown/laravel/filament/index.md)
