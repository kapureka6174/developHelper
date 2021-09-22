<template>
    <textarea
        class="
            autoexpand
            tracking-wide
            py-2
            px-4
            mb-3
            leading-relaxed
            appearance-none
            block
            w-full
            border border-gray-200
            rounded
            focus:outline-none focus:bg-white focus:border-gray-500
        "
        v-model="form.comments.content"
        v-if="!form.comments.decidable"
        rows="10"
    ></textarea>
    <p v-else class="py-2 px-4 mb-3 w-full whitespace-pre-line break-words">
        {{ form.comments.content }}
    </p>
</template>
<script>
import { inject } from "vue";
export default {
    setup() {
        const form = inject("form");

        return { form };
    },
};
</script>
