<template>
    <button
        class="
            bg-indigo-600
            hover:bg-indigo-400
            h-8
            w-12
            text-white
            rounded
            ml-2
        "
        @click="add"
    >
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
