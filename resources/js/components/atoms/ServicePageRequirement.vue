<template>
    <div class="w-full">
        <p
            class="
                font-bold
                text-gray-600
                bg-gray-200
                rounded-md
                py-2
                px-4
                w-4/5
                mx-auto
                mb-4
                text-center
            "
        >
            {{ title }}
        </p>
    </div>
</template>
<script>
export default {
    props: {
        title: String,
    },
};
</script>
