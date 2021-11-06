<template>
    <select
        class="
            mb-3
            w-32
            border
            focus:border-blue-500
            border-gray-200
            rounded
            focus:outline-none focus:ring-1 focus:ring-blue-500
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
