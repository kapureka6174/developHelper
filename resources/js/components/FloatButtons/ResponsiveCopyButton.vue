<template>
    <button
        class="
            mouse
            fixed
            bottom-10
            left-20
            flex
            items-center
            justify-center
            p-0
            w-10
            h-10
            bg-white
            border-2 border-gray-500
            rounded-full
            focus:outline-none
            active:shadow-lg
            shadow-xl
            transition
            duration-200
            ease-in
            md:hidden
        "
    >
        <svg
            class="relative w-8 h-8 text-gray-500"
            width="24"
            height="24"
            viewBox="0 0 24 24"
            stroke-width="2"
            stroke="currentColor"
            fill="none"
            stroke-linecap="round"
            stroke-linejoin="round"
        >
            <path stroke="none" d="M0 0h24v24H0z" />
            <rect x="8" y="8" width="12" height="12" rx="2" />
            <path d="M16 8v-2a2 2 0 0 0 -2 -2h-8a2 2 0 0 0 -2 2v8a2 2 0 0 0 2 2h2" />
        </svg>

        <!-- コピー完了時のメッセージ -->
        <div
            v-if="copied"
            class="
                absolute
                bottom-10
                px-3
                py-2
                w-32
                text-center text-gray-600 text-xs
                bg-white
                rounded-lg
                pointer-events-none
            "
        >
            リンクをコピーしました
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
