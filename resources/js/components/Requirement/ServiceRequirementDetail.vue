<template>
    <details class="mb-1 w-full">
        <summary class="font-semibold bg-gray-200 rounded-md py-2 px-4">
            {{ title }}
        </summary>
        <p
            class="
                text-grey-600
                font-bold
                p-4
                rounded-md
                bg-gray-100
                border-2 border-white
            "
        >
            {{ content }}
        </p>
    </details>
</template>

<script>
export default {
    props: {
        title: String,
        content: String,
    },
};
</script>
