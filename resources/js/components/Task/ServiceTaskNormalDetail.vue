<template>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <service-task-normal-detail-card
            v-for="(task, index) in tasks"
            :key="index"
            :state="task.state"
            :contents="task.contents"
        />
    </div>
</template>

<script>
import ServiceTaskNormalDetailCard from "./ServiceTaskNormalDetailCard";

export default {
    components: {
        ServiceTaskNormalDetailCard,
    },
    props: {
        tasks: Array,
    },
};
</script>
