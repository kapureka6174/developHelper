<template>
    <button
        class="
            p-0
            w-10
            h-10
            bg-white
            rounded-full
            active:shadow-lg
            mouse
            shadow-xl
            transition
            ease-in
            duration-200
            focus:outline-none
            fixed
            bottom-10
            right-4
            md:hidden
            flex
            items-center
            justify-center
            border-red-500 border-2
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
    </button>
</template>
<script>
export default {
    props: {
        liked_by_user: Boolean,
    },
};
</script>
