<template>
    <button
        v-if="
            $page.props.user !== null &&
            $page.props.user.id == $page.props.service.user_id
        "
        class="bg-indigo-600 hover:bg-indigo-400 h-8 w-12 text-white rounded"
        @click="taskSubmit"
    >
        保存
    </button>
</template>
<script>
import { inject } from "vue";
import { Inertia } from "@inertiajs/inertia";

export default {
    setup() {
        const form = inject("form");

        // TaskControllerにformを渡す
        const taskSubmit = () => {
            Inertia.put(route("Task"), form, {
                errorBag: "tasks",
                preserveScroll: true,
            });
        };
        return { taskSubmit };
    },
};
</script>
