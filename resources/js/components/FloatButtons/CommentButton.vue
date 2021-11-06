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
            border-2 border-green-500
            rounded-full
            shadow-xl
            cursor-pointer
        "
    >
        <svg class="w-8 h-8 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"
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
            コメントを投稿する
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
    </button>
</template>
