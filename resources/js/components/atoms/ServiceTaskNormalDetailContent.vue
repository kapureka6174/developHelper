<template>
    <div class="my-2">
        <p
            class="
                text-gray-600
                font-semibold
                mx-auto
                py-3
                w-4/5
                bg-blue-200
                rounded
                text-center
            "
        >
            {{ content }}
        </p>
    </div>
</template>

<script>
export default {
    props: {
        content: String,
    },
};
</script>
