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
                :likes="developer.likes_count"
                :comments="developer.comments_count"
                :twitter="developer.twitter_account"
                :github="developer.github_account"
                :fav_lang="developer.fav_lang"
                :dev_years="developer.dev_years"
            />
            <div
                v-if="
                    $page.props.user !== null &&
                    $page.props.user.id === developer.id
                "
                class="flex items-center justify-center mt-3"
            >
                <inertia-link :href="route('Create')">
                    <button
                        class="
                            bg-indigo-600
                            hover:bg-indigo-400
                            text-white
                            rounded
                            px-3
                            py-3
                        "
                    >
                        新規サービスを作る
                    </button>
                </inertia-link>
                <inertia-link :href="route('profile.show')">
                    <button
                        class="
                            bg-indigo-600
                            hover:bg-indigo-400
                            text-white
                            rounded
                            px-3
                            py-3
                            ml-12
                        "
                    >
                        プロフィールの編集
                    </button>
                </inertia-link>
            </div>
            <section-title
                v-if="services.length"
                class="ml-4"
                :title="`${developer.name}のサービス`"
            />
            <div
                class="
                    grid grid-cols-1
                    items-center
                    md:grid md:grid-cols-2
                    lg:grid-cols-3
                    md:gap-4
                    px-2
                "
            >
                <div v-for="service in services" :key="service.id">
                    <service-card
                        :id="service.id"
                        :title="service.title"
                        :description="service.description"
                        :date="service.created_at"
                        :likes="service.likes_count"
                        :comments="service.comments_count"
                    />
                </div>
            </div>
            <section-title
                v-if="fav_services.length"
                class="ml-4"
                title="お気に入りのサービス`"
            />
            <div
                class="
                    grid grid-cols-1
                    items-center
                    md:grid md:grid-cols-2
                    lg:grid-cols-3
                    md:gap-4
                    px-2
                "
            >
                <div v-for="service in fav_services" :key="service.id">
                    <service-card
                        :id="service.id"
                        :title="service.title"
                        :description="service.description"
                        :user="service.user"
                        :date="service.created_at"
                        :likes="service.likes_count"
                        :comments="service.comments_count"
                    />
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
import AppLayout from "../Layouts/AppLayout";
import ServiceCard from "../components/Utility/ServiceCard";
import DeveloperProfile from "../components/Developer/DeveloperProfile";
import SectionTitle from "../components/Utility/SectionTitle";

export default {
    components: {
        AppLayout,
        ServiceCard,
        DeveloperProfile,
        SectionTitle,
    },
    props: {
        developer: Object,
        services: Array,
        fav_services: Array,
    },
};
</script>
