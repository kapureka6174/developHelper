<template>
    <button
        class="
            bg-white
            rounded-full
            flex
            items-center
            justify-center
            w-12
            h-12
            my-4
            group
            cursor-pointer
            relative
            inline-block
            border-gray-500 border-2
            shadow-xl
        "
    >
        <svg
            class="h-8 w-8 text-gray-500"
            fill="none"
            viewBox="0 0 24 24"
            stroke="currentColor"
        >
            <path
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                d="M8 5H6a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2v-1M8 5a2 2 0 002 2h2a2 2 0 002-2M8 5a2 2 0 012-2h2a2 2 0 012 2m0 0h2a2 2 0 012 2v3m2 4H10m0 0l3-3m-3 3l3 3"
            />
        </svg>
        <div
            class="
                opacity-0
                w-28
                bg-gray-200
                text-gray-600 text-center text-xs
                rounded-lg
                py-2
                absolute
                group-hover:opacity-100
                bottom-full
                mb-2
                px-3
                pointer-events-none
            "
        >
            リンクをコピーする
            <svg
                class="absolute text-gray-200 h-2 w-full left-0 top-full"
                x="0px"
                y="0px"
                viewBox="0 0 255 255"
                xml:space="preserve"
            >
                <polygon class="fill-current" points="0,0 127.5,127.5 255,0" />
            </svg>
        </div>
        <div
            v-if="copied"
            class="
                w-32
                text-gray-600 text-center text-xs
                rounded-lg
                py-2
                absolute
                top-10
                px-3
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
