<template>
    <button class="ml-2 w-12 h-8 text-white hover:bg-indigo-400 bg-indigo-600 rounded" @click="add">
        追加
    </button>
</template>
<script>
    import { inject } from "vue";
    export default {
        setup() {
            const requirements = inject("requirements");
            const newRequirement = inject("newRequirement");

            const add = () => {
                requirements.push(newRequirement());
            };

            return { add };
        },
    };
</script>
