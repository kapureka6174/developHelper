<template>
    <button
        :type="type"
        class="
            inline-flex
            items-center
            px-4
            py-2
            text-white text-xs
            font-semibold
            tracking-widest
            hover:bg-gray-700
            bg-gray-800
            active:bg-gray-900
            border
            focus:border-gray-900
            border-transparent
            rounded-md
            focus:outline-none
            disabled:opacity-25
            uppercase
            transition
            focus:ring focus:ring-gray-300
        "
    >
        <slot></slot>
    </button>
</template>

<script>
    export default {
        props: {
            type: {
                type: String,
                default: "submit",
            },
        },
    };
</script>
