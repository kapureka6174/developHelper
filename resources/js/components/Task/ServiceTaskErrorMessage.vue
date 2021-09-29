<template>
    <div
        class="
            bg-red-100
            border border-red-400
            text-red-700
            px-4
            py-3
            rounded
            my-2
        "
        role="alert"
    >
        <p class="font-bold">
            {{ error }}
        </p>
    </div>
</template>

<script>
export default {
    props: {
        error: String,
    },
};
</script>
