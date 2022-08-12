# laravel イベント管理システム
## ダウンロード方法

git clone https://github.com/fs1204/laravel_event.git

git cloneのブランチを指定してダウンロードする場合
git clone -b ブランチ名 https://github.com/fs1204/laravel_event.git

もしくは、zipファイルでダウンロードしてください。


## インストール方法

- cd laravel_event
- composer install
- npm install
- npm run dev

.env.exampleをコピーして、.envファイルを作成。

.envファイルの中の下記をご利用の環境に合わせて変更してください。

DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=laravel_event
DB_USERNAME=sail
DB_PASSWORD=password

XAMPP/MAMP または 他の開発環境でDBを起動した後に

php artisan migrate:fresh --seed

と実行してください。（データベーステーブルとダミーデータが追加されればOK）

最後に、

php artisan key:generate

と入力してキーを生成後、

php artisan serve

で簡易サーバーを立ち上げ、表示確認してください。


## インストール後の実施事項

画像のリンク
php artisan storage:link

Tailwindcss 3.xの、JustInTime機能により、
使ったHTML内クラスのみ反映されるようになっていますので、
HTMLを編集する際は、
npm run watch も実行しながら、編集するようにしてください。
