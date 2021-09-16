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
            border-red-500 border-2
            shadow-xl
        "
    >
        <svg
            class="h-8 w-8 text-red-500"
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
            <path
                v-if="liked_by_user"
                d="M12 20l-7 -7a4 4 0 0 1 6.5 -6a.9 .9 0 0 0 1 0a4 4 0 0 1 6.5 6l-7 7"
                fill="rgba(239, 68, 68, var(--tw-text-opacity))"
            />
            <path
                v-else
                d="M12 20l-7 -7a4 4 0 0 1 6.5 -6a.9 .9 0 0 0 1 0a4 4 0 0 1 6.5 6l-7 7"
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
            お気に入りに追加
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
    </button>
</template>

<script>
export default {
    props: {
        liked_by_user: Boolean,
    },
};
</script>
