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
        const uris = inject("uris");
        const newUri = inject("newUri");

        const add = () => {
            uris.push(newUri());
        };

        return { add };
    },
};
</script>
