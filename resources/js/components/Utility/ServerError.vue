<template>
    <div v-if="errorFlag">
        <div
            v-for="(error, index) in errors"
            :key="index"
            class="my-2 px-4 py-3 text-red-700 bg-red-100 border border-red-400 rounded"
            role="alert"
        >
            <p class="font-bold">
                {{ error[1] }}
            </p>
        </div>
    </div>
</template>
<script>
    export default {
        props: {
            errorFlag: Boolean,
            errors: Array,
        },
    };
</script>
