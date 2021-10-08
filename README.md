#  開発者のためのコミュニティサービス Web Service Hub 

## 1.アプリの概要

Web Service Hub とは個人でWebサービスを開発している方のための**コミュニティサービス**です。
サービスを登録したり、みんなのサービスを見て**Webサービスの開発を学んで品質向上**を目指す場です。

![image](https://user-images.githubusercontent.com/58462002/136169980-c984311b-bb5e-4edb-801c-e541f4c28971.png)

URL ➡　https://web-service-hub.herokuapp.com/

- スマホからもご覧いただけます。
- 「ログイン画面」から**ゲストログイン**できます。

----

### 開発に至った経緯

- **どんなサービスを作ったらいいのか分からない**
- **一通り学んだ後に個人開発しようとしてもどこから手を付けるべきか分からない**
- **周りにプログラミングが分かる人がいないためモチベが続かない**

以上の3つの問題を解決したいと思い、サービスを開発するに至りました。

## 2.使用技術

#### フロントエンド
- Vue.js 3.0.5
  - vue-scrollto 2.20.0 (コメントへのスクロール移動をするため)
- Tailwind CSS 2.0.1
  - @tailwindcss/line-clamp 0.2.1（文字数を制限して省略表示するため）
- Eslint 7.30.0
- Prettier 2.3.2

#### バックエンド
- PHP 8.0
- Laravel 8.40
  - Jetstream 2.3 （ログイン、セッション管理機能のため）
  - Sanctum 2.6 (CSRF対策のため)
  - Socialite 5.2 （Google,Githubでのログインをするため）
  - s-ichikawa/laravel-sendgrid-driver （メール送信にsendgridを使用するため）
- Inertiajs 0.4.2 （APIを作成せずにLaravelアプリと同じように作成するため）
- MySQL (Heroku ClearDB)

#### インフラ
- Heroku
- AWS(S3)

#### その他
- Git 2.33.0
- XAMPP
- VsCode

## 3.機能一覧

### メイン機能
- サービス登録/編集/削除機能
- お気に入り登録機能
- コメント機能
- 並び替え機能（日付、お気に入り数、コメント数）
- フィルター機能（開発中 or 完成）
- 保存・削除時の通知機能 

### 認証系
- ユーザー登録・ログイン・ログアウト
- Google、Githubアカウントを使ったソーシャルログイン機能
- ゲストログイン機能
- パスワード再設定機能
- プロフィール編集機能
- アカウント削除機能

## 4.使用画面

### ログイン画面
![image](https://user-images.githubusercontent.com/58462002/136170374-18463cb4-e411-484e-9453-e33b55d2868e.png)

### サービス画面
- カテゴリーごとに表示できます。
- 並び替え機能（新着順、お気に入り数、コメント数の多い順に並び替えます。）
- フィルター機能（開発中、完成状態のサービスのみを表示します。）

![image](https://user-images.githubusercontent.com/58462002/136170911-337c7747-76fa-4eea-9062-1c04910bacb2.png)

### サービス詳細画面
- お気に入り登録、ツイッターへの共有、リンクのコピー、コメントの投稿ができます。
- タスクの管理機能（段階に分けてタスクを登録/編集/削除できます）

![image](https://user-images.githubusercontent.com/58462002/136500138-841be1cf-344b-450b-80e8-fddae1b43099.png)


### サービス新規作成・編集画面
- ヒントボタンをホバー（スマホではクリック）すると説明文が表示されます。

![image](https://user-images.githubusercontent.com/58462002/136499321-7fc9e34e-c565-4637-8420-13ea10ac3db1.png)

### 通知機能
- サービスの作成・編集などを保存が完了すると以下のようなフラッシュメッセージが表示されます。

![image](https://user-images.githubusercontent.com/58462002/136498641-ab9e823c-1f4f-4543-b4b1-628d0a827e70.png)

- 入力された値を受け取り、サーバー側でバリデーションを行いエラーが発生した場合の表示です。

![image](https://user-images.githubusercontent.com/58462002/136498204-ef50a263-4a0a-46f2-84a9-0ee8c0563d3f.png)


## 5.ER図
![image](https://user-images.githubusercontent.com/58462002/136184384-6f103473-6128-4cd3-a89c-958501517e1f.png)
