<template>
    <button
        v-if="
            $page.props.user !== null &&
            $page.props.user.id == $page.props.service.user_id
        "
        class="bg-indigo-600 hover:bg-indigo-400 h-8 w-12 text-white rounded"
        @click="taskButton"
    >
        保存
    </button>
</template>
<script>
export default {
    setup(props, ctx) {
        const taskButton = () => {
            ctx.emit("taskButton");
        };
        return { taskButton };
    },
};
</script>
