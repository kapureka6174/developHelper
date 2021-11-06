<template>
    <button
        class="
            mouse
            group
            fixed
            bottom-10
            right-4
            flex
            items-center
            justify-center
            p-0
            w-10
            h-10
            bg-white
            border-2 border-red-500
            rounded-full
            focus:outline-none
            active:shadow-lg
            shadow-xl
            cursor-pointer
            transition
            duration-200
            ease-in
            md:hidden
        "
    >
        <svg
            class="relative w-8 h-8 text-red-500"
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
        <div
            v-if="$page.props.user == null"
            class="
                absolute
                bottom-full
                mb-2
                px-3
                py-2
                w-20
                text-center text-gray-600 text-xs
                bg-gray-200
                rounded-lg
                opacity-0
                group-hover:opacity-100
                pointer-events-none
            "
        >
            ログインが必要です
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
