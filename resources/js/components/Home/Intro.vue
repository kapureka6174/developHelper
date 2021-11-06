i
<template>
    <div class="flex justify-center py-2">
        <div class="pb-2 pt-8 px-8 max-w-4xl text-center border-4 border-gray-200 rounded-lg">
            <div class="text-xl font-bold md:text-2xl">
                {{ content.title }}
            </div>
            <inertia-link :href="route(content.url)" class="flex justify-center my-6 h-12">
                <div
                    class="
                        absolute
                        flex
                        px-4
                        py-2
                        text-white text-lg
                        font-medium
                        hover:bg-blue-400
                        bg-blue-600
                        rounded
                        shadow-md
                        cursor-pointer
                    "
                >
                    {{ content.button }}
                </div>
            </inertia-link>
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
                    content.title = "みんなのサービスを見てみたい！";
                    content.button = "サービス一覧";
                    content.url = "Services";
                    break;
                case 2:
                    content.title = "どんな人がいるのか見てみたい！";
                    content.button = "開発者一覧";
                    content.url = "Users";
                    break;
                case 3:
                    content.title = "とりあえず試してみたい方は！";
                    content.button = "ゲストログイン";
                    content.url = "Guest_Login";
                    break;
                default:
                    break;
            }
            return { content };
        },
    };
</script>
