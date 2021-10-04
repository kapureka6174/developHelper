<template>
    <select
        class="
            w-32
            rounded
            border border-gray-200
            focus:outline-none
            focus:ring-1
            focus:ring-blue-500
            focus:border-blue-500
            mb-3
        "
        v-model="comment.type"
    >
        <option value="質問">質問</option>
        <option value="アドバイス">アドバイス</option>
        <option value="感想">感想</option>
    </select>
</template>
<script>
import { inject } from "vue";
export default {
    setup() {
        const comment = inject("comment");
        return { comment };
    },
};
</script>
