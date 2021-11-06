<template>
    <button
        :type="type"
        class="
            inline-flex
            items-center
            px-4
            py-2
            hover:text-gray-500
            text-gray-700
            active:text-gray-800
            text-xs
            font-semibold
            tracking-widest
            active:bg-gray-50
            bg-white
            border
            focus:border-blue-300
            border-gray-300
            rounded-md
            focus:outline-none
            shadow-sm
            disabled:opacity-25
            uppercase
            transition
            focus:ring focus:ring-blue-200
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
                default: "button",
            },
        },
    };
</script>
