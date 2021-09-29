<template>
    <div class="my-2 flex items-center">
        <service-task-edit-detail-card-list-input
            v-if="!tasks[index].decidable"
            :index="index"
        />
        <service-task-edit-detail-card-list-show
            v-else
            :state="state"
            :index="index"
        />
        <service-task-delete-button :index="index" />
    </div>
</template>
<script>
import ServiceTaskEditDetailCardListInput from "./ServiceTaskEditDetailCardListInput";
import ServiceTaskEditDetailCardListShow from "./ServiceTaskEditDetailCardListShow";
import ServiceTaskDeleteButton from "./ServiceTaskDeleteButton";

import { inject } from "vue";

export default {
    components: {
        ServiceTaskEditDetailCardListInput,
        ServiceTaskEditDetailCardListShow,
        ServiceTaskDeleteButton,
    },
    props: {
        index: Number,
        state: String,
    },
    setup() {
        const tasks = inject("tasks");
        return { tasks };
    },
};
</script>
