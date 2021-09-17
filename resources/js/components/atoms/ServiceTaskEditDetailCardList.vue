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
import ServiceTaskEditDetailCardListInput from "./ServiceTaskEditDetailCardListInput.vue";
import ServiceTaskEditDetailCardListShow from "./ServiceTaskEditDetailCardListShow.vue";
import ServiceTaskDeleteButton from "./ServiceTaskDeleteButton.vue";

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
