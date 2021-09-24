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
        v-model="finished.state"
    >
        <option :value="false">開発中</option>
        <option :value="true">完成</option>
    </select>
</template>
<script>
import { inject } from "vue";
export default {
    setup() {
        const finished = inject("finished");
        return { finished };
    },
};
</script>
