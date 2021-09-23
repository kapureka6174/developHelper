<template>
    <div class="my-2">
        <p
            class="
                text-gray-600
                font-semibold
                mx-auto
                py-3
                w-11/12
                bg-blue-200
                rounded
                text-center
            "
        >
            {{ taskname }}
        </p>
    </div>
</template>

<script>
export default {
    props: {
        taskname: String,
    },
};
</script>
