<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                開発者の個人画面
            </h2>
        </template>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div v-for="service in services" :key="service.id">
                <service-card
                    :id="service.id"
                    :title="service.title"
                    :description="service.description"
                />
            </div>
        </div>
    </app-layout>
</template>

<script>
import AppLayout from "../Layouts/AppLayout.vue";
import ServiceCard from "../components/ServiceCard.vue";

export default {
    components: {
        AppLayout,
        ServiceCard,
    },
    props: {
        services: {
            type: Array,
        },
    },
};
</script>
