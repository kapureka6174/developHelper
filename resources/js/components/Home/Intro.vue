i
<template>
    <div class="flex py-2 justify-center">
        <div
            class="
                pt-8
                pb-2
                px-8
                text-center
                max-w-4xl
                border-gray-200 border-4
                rounded-lg
            "
        >
            <div class="md:text-2xl text-xl font-bold">
                {{ content.title }}
            </div>
            <inertia-link
                :href="route(content.url)"
                class="my-6 flex justify-center h-12"
            >
                <div
                    class="
                        flex
                        shadow-md
                        font-medium
                        absolute
                        py-2
                        px-4
                        text-white
                        cursor-pointer
                        bg-blue-600
                        hover:bg-blue-400
                        rounded
                        text-lg
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
