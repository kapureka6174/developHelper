<template>
    <div class="relative flex flex-col items-center justify-center ml-2">
        <div
            class="
                absolute
                mb-2
                px-3
                py-2
                w-max
                text-center text-blue-600 text-xs
                bg-blue-500
                rounded-lg
                pointer-events-none
            "
            :class="show ? 'inline' : 'hidden'"
            :style="{ bottom: '1.6rem' }"
        >
            <p class="text-white text-xs md:text-base" v-html="getMessage(type)"></p>
            <svg
                class="absolute left-0 top-full w-full h-2 text-blue-500"
                x="0px"
                y="0px"
                viewBox="0 0 255 255"
                xml:space="preserve"
            >
                <polygon class="fill-current" points="0,0 127.5,127.5 255,0" />
            </svg>
        </div>
        <svg
            @mouseover="hover"
            @mouseleave="hoverout"
            class="w-8 h-8 text-blue-500"
            fill="none"
            viewBox="0 0 24 24"
            stroke="currentColor"
        >
            <path
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"
            />
        </svg>
    </div>
</template>
<script>
    import { ref } from "vue";
    export default {
        props: {
            type: String,
        },
        setup() {
            let show = ref(false);
            const hover = () => {
                if (show.value == false) {
                    show.value = true;
                }
            };
            const hoverout = () => {
                if (show.value == true) {
                    show.value = false;
                }
            };

            const getMessage = (type) => {
                let message;
                switch (type) {
                    case "サービス名":
                        message =
                            "サービス名は<strong>30字前後以内</strong>で設定してください。<br>どんなサービスなのか想像しやすい名前にしましょう。<br>開発中か完成か<strong>サービスの状態</strong>を選択してください。";
                        break;
                    case "サービスURL":
                        message =
                            "GitHubのURL、サービスが利用できるURLを設定してください。<br>URLを入力する際は<strong>半角</strong>で入力してください。<br>まだ、URLがない場合は入力する必要はありません。";
                        break;
                    case "カテゴリー":
                        message =
                            "サービスのカテゴリーを入力してください。<br>1～4つ設定することを推奨しています。<br>例）SPA,TDD,API,JamStack,モノシリック";
                        break;
                    case "サービス概要":
                        message =
                            "サービスの概要を300字前後で入力してください。<br>サービスを作った経緯や使用場面などを説明してください。";
                        break;
                    case "使用技術":
                        message =
                            "開発に使用する技術を分野に分けて入力してください。<br>例）分野：フロントエンド、バックエンド、インフラ<br>例）技術：React, Git, Go, Laravel, Heroku<br>バージョンがない場合は入力する必要はありません。";
                        break;
                    case "要件定義":
                        message =
                            "サービスに必要な要件・機能名を入力してください。<br>次に設定した機能の詳しい説明を入力してください。<br>簡単な機能の場合は説明を入力する必要はありません。";
                        break;
                    case "ページ":
                        message =
                            "サービスで主に使用するページを設定してください。<br>例）ページ名：サービス画面、ログイン画面<br>全てのページではなく役割毎に作成しましょう。";
                        break;
                    case "URI設計":
                        message =
                            "使用するURI, メソッド, 説明を入力してください。<br>例）URI：/ todos / { id } / edit　 メソッド：PUT<br>例）説明：任意のタスクをフォームを元に変更する。";
                        break;
                    default:
                        break;
                }
                return message;
            };
            return { show, hover, hoverout, getMessage };
        },
    };
</script>
