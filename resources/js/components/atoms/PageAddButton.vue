<template>
    <button
        class="bg-indigo-600 hover:bg-indigo-400 h-10 w-28 text-white rounded"
        @click="add"
    >
        ページを追加
    </button>
</template>
<script>
import { inject } from "vue";
export default {
    setup() {
        const pages = inject("pages");
        const newPage = inject("newPage");

        const add = () => {
            pages.push(newPage());
        };

        return { add };
    },
};
</script>
