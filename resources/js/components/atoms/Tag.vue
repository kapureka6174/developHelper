<template>
    <div
        class="
            text-xs
            inline-flex
            items-center
            font-bold
            leading-sm
            uppercase
            px-3
            py-1
            bg-blue-200
            text-blue-700
            rounded-full
            mx-2
            my-1
            hover:bg-blue-100
        "
    >
        {{ tagname }}
    </div>
</template>

<script>
export default {
    props: {
        tagname: String,
    },
};
</script>
