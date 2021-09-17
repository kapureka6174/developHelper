<template>
    <div>
        <div class="flex items-center mb-2">
            <section-title title="タスク" />
            <!-- タスクの保存ボタン -->
            <service-task-save-button @taskButton="taskButton" />
        </div>

        <!-- エラー表示 -->
        <div v-if="$page.props.errors.tasks">
            <service-task-error-message
                v-for="(error, index) in Object.values(
                    $page.props.errors.tasks
                )"
                :key="index"
                :error="error"
            />
        </div>

        <!-- 通常表示 -->
        <service-task-normal-detail
            v-if="$page.props.user == null"
            :tasks="classifiedTasks()"
        />

        <!-- 編集表示 -->
        <service-task-edit-detail
            v-else-if="$page.props.user.id == $page.props.service.user_id"
        />
    </div>
</template>

<script>
import SectionTitle from "./SectionTitle.vue";
import ServiceTaskSaveButton from "./ServiceTaskSaveButton.vue";
import ServiceTaskErrorMessage from "./ServiceTaskErrorMessage.vue";
import ServiceTaskNormalDetail from "./ServiceTaskNormalDetail.vue";
import ServiceTaskEditDetail from "./ServiceTaskEditDetail.vue";

export default {
    components: {
        SectionTitle,
        ServiceTaskSaveButton,
        ServiceTaskErrorMessage,
        ServiceTaskNormalDetail,
        ServiceTaskEditDetail,
    },
    props: {
        tasks: Array,
        id: Number,
    },
    setup(props, ctx) {
        const taskButton = () => {
            ctx.emit("taskButton");
        };

        const classifiedTasks = () => {
            const results = [];
            const states = ["やるべきこと", "開発中", "完了"];

            states.forEach((name) => {
                results.push({
                    state: name,
                    contents: props.tasks.filter((e) => e.state == name),
                });
            });

            return results;
        };

        return { taskButton, classifiedTasks };
    },
};
</script>
