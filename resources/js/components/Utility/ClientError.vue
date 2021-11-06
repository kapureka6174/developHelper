<template>
    <div
        class="my-2 px-4 py-3 text-red-700 bg-red-100 border border-red-400 rounded"
        role="alert"
        v-if="errorFlag"
    >
        <strong class="font-bold">{{ text }}</strong>
    </div>
</template>
<script>
    export default {
        props: {
            errorFlag: Boolean,
            text: String,
        },
    };
</script>
