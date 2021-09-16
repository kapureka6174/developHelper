<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ developer.name }}のサービス一覧
            </h2>
        </template>

        <div>
            <developer-profile
                :username="developer.name"
                :image_url="developer.profile_photo_url"
                :introduction="developer.introduction"
            />
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 px-2">
                <div v-for="service in services" :key="service.id">
                    <service-card
                        :id="service.id"
                        :title="service.title"
                        :description="service.description"
                        :date="service.created_at"
                    />
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
import AppLayout from "../Layouts/AppLayout.vue";
import ServiceCard from "../components/ServiceCard.vue";
import DeveloperProfile from "../components/DeveloperProfile.vue";

export default {
    components: {
        AppLayout,
        ServiceCard,
        DeveloperProfile,
    },
    props: {
        developer: Object,
        services: Array,
    },
};
</script>
