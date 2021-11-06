<template>
    <button class="ml-2 w-12 h-8 text-white hover:bg-indigo-400 bg-indigo-600 rounded" @click="add">
        追加
    </button>
</template>
<script>
    import { inject } from "vue";
    export default {
        setup() {
            const techFields = inject("techFields");
            const newTechField = inject("newTechField");

            // 配列に追加する
            const add = () => {
                techFields.push(newTechField());
            };
            return { add };
        },
    };
</script>
