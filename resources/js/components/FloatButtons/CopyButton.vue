<template>
    <button
        class="
            group
            relative
            flex
            inline-block
            items-center
            justify-center
            my-4
            w-12
            h-12
            bg-white
            border-2 border-gray-500
            rounded-full
            shadow-xl
            cursor-pointer
        "
    >
        <svg class="w-8 h-8 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                d="M8 5H6a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2v-1M8 5a2 2 0 002 2h2a2 2 0 002-2M8 5a2 2 0 012-2h2a2 2 0 012 2m0 0h2a2 2 0 012 2v3m2 4H10m0 0l3-3m-3 3l3 3"
            />
        </svg>

        <!-- ホバー時に表示する説明文 -->
        <div
            class="
                absolute
                bottom-full
                mb-2
                px-3
                py-2
                w-28
                text-center text-gray-600 text-xs
                bg-gray-200
                rounded-lg
                opacity-0
                group-hover:opacity-100
                pointer-events-none
            "
        >
            リンクをコピーする
            <svg
                class="absolute left-0 top-full w-full h-2 text-gray-200"
                x="0px"
                y="0px"
                viewBox="0 0 255 255"
                xml:space="preserve"
            >
                <polygon class="fill-current" points="0,0 127.5,127.5 255,0" />
            </svg>
        </div>

        <!-- コピー完了時のメッセージ -->
        <div
            v-if="copied"
            class="
                absolute
                top-10
                px-3
                py-2
                w-32
                text-center text-gray-600 text-xs
                rounded-lg
                pointer-events-none
            "
        >
            コピーが完了しました
        </div>
    </button>
</template>

<script>
    export default {
        props: {
            copied: Boolean,
        },
    };
</script>
