<template>
    <svg
        class="h-8 w-8 text-blue-500 flex-shrink-0 hover:text-blue-300"
        width="24"
        height="24"
        viewBox="0 0 24 24"
        stroke-width="2"
        stroke="currentColor"
        fill="none"
        stroke-linecap="round"
        stroke-linejoin="round"
        @click="tasks[index].state = state"
    >
        <path stroke="none" d="M0 0h24v24H0z" />
        <polyline points="9 6 15 12 9 18" />
    </svg>
</template>

<script>
import { inject } from "vue";

export default {
    props: {
        state: String,
        index: Number,
    },
    setup() {
        const tasks = inject("tasks");
        return { tasks };
    },
};
</script>
