<template>
    <button class="w-28 h-10 text-white hover:bg-indigo-400 bg-indigo-600 rounded" @click="add">
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
