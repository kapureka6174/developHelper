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
            border-2 border-red-500
            rounded-full
            shadow-xl
            cursor-pointer
        "
    >
        <svg
            class="w-8 h-8 text-red-500"
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
            <path v-else d="M12 20l-7 -7a4 4 0 0 1 6.5 -6a.9 .9 0 0 0 1 0a4 4 0 0 1 6.5 6l-7 7" />
        </svg>

        <!-- ホバー時に表示する説明文 -->
        <div
            class="
                absolute
                bottom-full
                mb-2
                px-3
                py-2
                w-32
                text-center text-gray-600 text-xs
                bg-gray-200
                rounded-lg
                opacity-0
                group-hover:opacity-100
                pointer-events-none
            "
        >
            {{ $page.props.user ? "お気に入りに追加" : "ログインが必要です" }}
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

<script>
    export default {
        props: {
            liked_by_user: Boolean,
        },
    };
</script>
