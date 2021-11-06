<template>
    <button
        :type="type"
        class="
            inline-flex
            items-center
            justify-center
            px-4
            py-2
            text-white text-xs
            font-semibold
            tracking-widest
            hover:bg-red-500
            bg-red-600
            active:bg-red-600
            border
            focus:border-red-700
            border-transparent
            rounded-md
            focus:outline-none
            disabled:opacity-25
            uppercase
            transition
            focus:ring focus:ring-red-200
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
