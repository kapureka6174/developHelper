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
