<template>
    <div class="w-full bg-gray-100 rounded py-6 px-2">
        <div class="flex items-center">
            <h2
                class="
                    text-gray-700
                    font-bold
                    text-2xl
                    mx-auto
                    my-1
                    w-4/5
                    text-center
                "
            >
                {{ state }}
            </h2>
            <service-task-add-button :state="state" />
        </div>
        <service-task-edit-detail-card-list
            v-for="task in tasks(state)"
            :key="task.index"
            :editable="!task.decidable"
            :index="task.index"
            :state="state"
        />
    </div>
</template>
<script>
import ServiceTaskAddButton from "./ServiceTaskAddButton.vue";
import ServiceTaskEditDetailCardList from "./ServiceTaskEditDetailCardList.vue";

import { inject } from "vue";

export default {
    components: {
        ServiceTaskAddButton,
        ServiceTaskEditDetailCardList,
    },
    props: {
        state: String,
    },
    setup() {
        const formTasks = inject("tasks");

        const index = (obj) => {
            return formTasks.indexOf(obj);
        };

        const tasks = (type) => {
            const todos = formTasks.filter(
                (e) => e.state == type && !e.isDelete
            );
            return todos.map((todo) => {
                todo.index = index(todo);
                return todo;
            });
        };

        return { tasks };
    },
};
</script>
