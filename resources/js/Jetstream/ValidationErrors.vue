<template>
    <div v-if="hasErrors">
        <div class="text-red-600 font-medium">問題が発生しました。</div>

        <ul class="mt-3 text-red-600 text-sm list-inside list-disc">
            <li v-for="(error, key) in errors" :key="key">{{ error }}</li>
        </ul>
    </div>
</template>

<script>
    export default {
        computed: {
            errors() {
                return this.$page.props.errors;
            },

            hasErrors() {
                return Object.keys(this.errors).length > 0;
            },
        },
    };
</script>
