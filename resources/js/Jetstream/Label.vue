<template>
    <label class="block text-gray-700 text-sm font-medium">
        <span v-if="value">{{ value }}</span>
        <span v-else><slot></slot></span>
    </label>
</template>

<script>
    export default {
        props: ["value"],
    };
</script>
