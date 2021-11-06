<template>
    <button
        v-if="$page.props.user !== null && $page.props.user.id == $page.props.service.user_id"
        class="w-12 h-8 text-white hover:bg-indigo-400 bg-indigo-600 rounded"
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
                    preserveScroll: true,
                });
            };
            return { taskSubmit };
        },
    };
</script>
