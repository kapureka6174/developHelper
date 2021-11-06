<template>
    <button class="ml-2 w-12 h-8 text-white hover:bg-indigo-400 bg-indigo-600 rounded" @click="add">
        追加
    </button>
</template>
<script>
    import { inject } from "vue";
    export default {
        setup() {
            const uris = inject("uris");
            const newUri = inject("newUri");

            const add = () => {
                uris.push(newUri());
            };

            return { add };
        },
    };
</script>
