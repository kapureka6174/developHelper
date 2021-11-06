<template>
    <div
        class="
            leading-sm
            inline-flex
            items-center
            mx-2
            my-1
            px-3
            py-1
            text-blue-700 text-xs
            font-bold
            bg-blue-200
            rounded-full
            uppercase
        "
        :class="hover ? 'text-green-500 border-green-500' : ''"
    >
        {{ tagname }}
    </div>
</template>

<script>
    export default {
        props: {
            tagname: String,
            hover: Boolean,
        },
    };
</script>
