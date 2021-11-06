<template>
    <h2
        v-if="finished"
        class="
            leading-sm
            inline-flex
            items-center
            justify-center
            mx-2
            my-1
            px-3
            py-1
            w-16
            h-8
            text-green-700 text-xs
            font-bold
            bg-green-200
            rounded-full
            uppercase
            md:hidden
        "
    >
        完了
    </h2>
    <h2
        v-else
        class="
            leading-sm
            inline-flex
            items-center
            justify-center
            mx-2
            my-1
            px-3
            py-1
            w-16
            h-8
            text-pink-700 text-xs
            font-bold
            bg-pink-200
            rounded-full
            uppercase
            md:hidden
        "
    >
        開発中
    </h2>
</template>
<script>
    export default {
        props: {
            finished: Boolean,
        },
    };
</script>
