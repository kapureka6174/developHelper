<template>
    <svg
        class="h-8 w-8 text-blue-500 hover:text-blue-300"
        fill="none"
        viewBox="0 0 24 24"
        stroke="currentColor"
        @click="addTask"
    >
        <path
            stroke-linecap="round"
            stroke-linejoin="round"
            stroke-width="2"
            d="M12 4v16m8-8H4"
        />
    </svg>
</template>

<script>
import { inject } from "vue";

export default {
    props: {
        state: String,
    },
    setup(props) {
        const tasks = inject("tasks");

        const addTask = () => {
            tasks.push({
                taskname: "",
                state: props.state,
                decidable: false,
                isDelete: false,
            });
        };

        return { addTask };
    },
};
</script>
