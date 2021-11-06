<template>
    <!-- 編集と通常表示との切り替え -->
    <div class="ml-2">
        <button
            class="w-12 h-8 text-white hover:bg-indigo-400 bg-indigo-600 rounded"
            v-if="!description.decidable"
            @click="input"
        >
            決定
        </button>
        <button
            class="w-12 h-8 text-white hover:bg-indigo-400 bg-indigo-600 rounded"
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
                    description.error = "サービスの概要が入力されていません。";
                } else {
                    description.error = "";
                    description.decidable = true;
                }
            };
            return { description, input };
        },
    };
</script>
