<template>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <service-task-edit-detail-card
            v-for="(state, index) in states"
            :key="index"
            :state="state"
            class="w-full bg-gray-100 rounded p-6"
        />
    </div>
</template>
<script>
import ServiceTaskEditDetailCard from "./ServiceTaskEditDetail.Card.vue";

export default {
    components: {
        ServiceTaskEditDetailCard,
    },
    setup() {
        const states = ["やるべきこと", "開発中", "完了"];
        return { states };
    },
};
</script>
