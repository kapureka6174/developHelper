<template>
    <input
        type="text"
        v-model="tasks[index].taskname"
        @keyup.enter="addContent($event, index)"
        class="
            appearance-none
            block
            w-4/5
            bg-white
            text-gray-700
            border border-gray-200
            rounded
            py-3
            mx-auto
            leading-tight
            focus:outline-none
            focus:ring-1
            focus:ring-blue-500
            focus:border-blue-500
        "
    />
</template>
<script>
import { inject } from "vue";

export default {
    props: {
        index: Number,
    },
    setup() {
        const tasks = inject("tasks");

        // クライアント側のバリデーション（空文字なら追加しない）
        const addContent = (e, index) => {
            if (e.target.value && e.target.value.match(/\S/g))
                tasks[index].decidable = true;
        };
        return { tasks, addContent };
    },
};
</script>
