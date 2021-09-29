<template>
    <div class="ml-2">
        <button
            class="
                bg-indigo-600
                hover:bg-indigo-400
                h-8
                w-12
                text-white
                rounded
            "
            v-if="!description.decidable"
            @click="input"
        >
            決定
        </button>
        <button
            class="
                bg-indigo-600
                hover:bg-indigo-400
                h-8
                w-12
                text-white
                rounded
            "
            v-else
            @click="description.decidable = false"
        >
            編集
        </button>
    </div>
</template>
<script>
import { inject } from "vue";
export default {
    setup() {
        const description = inject("description");

        const input = () => {
            if (!description.content) {
                description.error = true;
            } else {
                description.error = false;
                description.decidable = true;
            }
        };
        return { description, input };
    },
};
</script>
