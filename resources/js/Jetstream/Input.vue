<template>
    <input
        class="
            border-gray-300
            focus:border-indigo-300
            rounded-md
            shadow-sm
            focus:ring focus:ring-indigo-200 focus:ring-opacity-50
        "
        :value="modelValue"
        @input="$emit('update:modelValue', $event.target.value)"
        :placeholder="placeholder"
        ref="input"
    />
</template>

<script>
    export default {
        props: ["modelValue", "placeholder"],

        emits: ["update:modelValue"],

        methods: {
            focus() {
                this.$refs.input.focus();
            },
        },
    };
</script>
