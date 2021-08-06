<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                開発者
            </h2>
        </template>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div v-for="user in users" :key="user.id">
                <developer-card
                    :id="user.id"
                    :name="user.name"
                    :introduction="user.introduction"
                />
            </div>
        </div>
    </app-layout>
</template>

<script>
import AppLayout from "../Layouts/AppLayout.vue";
import DeveloperCard from "../components/DeveloperCard.vue";

export default {
    components: {
        AppLayout,
        DeveloperCard,
    },

    props: {
        users: {
            type: Array,
        },
    },
};
</script>
