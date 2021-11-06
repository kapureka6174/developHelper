<template>
    <div
        class="
            material-card
            my-3
            max-w-sm
            h-80
            bg-white
            border-4 border-gray-200
            rounded-lg
            shadow-lg
        "
    >
        <img class="w-full h-48 rounded-t" :src="content.image" />
        <div class="px-6 py-4">
            <div class="text-xl font-bold tracking-wide">
                {{ content.title }}
            </div>
            <p class="text-gray-700 text-base">
                {{ content.description }}
            </p>
        </div>
    </div>
</template>
<script>
    export default {
        props: {
            type: Number,
        },
        setup(props) {
            const content = {};
            switch (props.type) {
                case 1:
                    content.title = "開発者登録";
                    content.description =
                        "紹介文、得意な言語、プログラミング歴などのプロフィールを設定してみましょう。";
                    content.image =
                        "https://web-service-hub.herokuapp.com/storage/images/プロフィール.png";
                    break;
                case 2:
                    content.title = "サービス登録";
                    content.description =
                        "作ってみたいサービス、作成中のサービス、公開済みのサービスを技術や設計も含めて登録してみよう。";
                    content.image =
                        "https://web-service-hub.herokuapp.com/storage/images/サービス登録.png";
                    break;
                case 3:
                    content.title = "質問・アドバイス";
                    content.description =
                        "開発中のサービスにはアドバイスや技術選定や設計に関する質問をしてみよう。";
                    content.image =
                        "https://web-service-hub.herokuapp.com/storage/images/コメント.png";
                    break;
                default:
                    break;
            }
            return { content };
        },
    };
</script>
