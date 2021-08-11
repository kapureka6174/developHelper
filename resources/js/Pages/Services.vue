<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                サービス一覧
            </h2>
        </template>
        <div class="m-3">
            <h1 class="text-2xl text-indigo-700 font-semibold">カテゴリー</h1>
            <div
                v-for="tag in tags"
                :key="tag.id"
                class="
                    text-xs
                    inline-flex
                    items-center
                    font-bold
                    leading-sm
                    uppercase
                    px-3
                    py-1
                    bg-blue-200
                    text-blue-700
                    rounded-full
                    mx-2
                    my-1
                    hover:bg-blue-100
                "
                @click="plusCategory(tag.tagname)"
            >
                {{ tag.tagname }}
            </div>
        </div>

        <div class="m-3">
            <h1 class="text-2xl text-indigo-700 font-semibold">選択中</h1>
            <div
                v-for="category in categories"
                :key="category"
                class="
                    text-xs
                    inline-flex
                    items-center
                    font-bold
                    leading-sm
                    uppercase
                    px-3
                    py-1
                    bg-blue-300
                    text-blue-700
                    rounded-full
                    mx-2
                    my-1
                    hover:bg-blue-100
                "
                @click="deleteCategory(category)"
            >
                {{ category }}
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <service-card
                v-for="service in services"
                :key="service.id"
                :id="service.id"
                :title="service.title"
                :description="service.description"
                :tags="resultTags(service.id)"
                v-show="existCategory(resultTags(service.id))"
            />
        </div>
    </app-layout>
</template>

<script>
import AppLayout from "../Layouts/AppLayout.vue";
import ServiceCard from "../components/ServiceCard.vue";

export default {
    data: function () {
        return {
            categories: [],
        };
    },
    components: {
        AppLayout,
        ServiceCard,
    },
    props: {
        services: Array,
        tags: Array,
    },
    methods: {
        resultTags(id) {
            return this.tags.filter(function (tag) {
                return tag.service_id === id;
            });
        },
        plusCategory(name) {
            if (!this.categories.includes(name)) this.categories.push(name);
        },
        deleteCategory(name) {
            const index = this.categories.indexOf(name);
            this.categories.splice(index, 1);
        },
        existCategory(tags) {
            let flag = true;
            if (this.categories.length) {
                flag = false;
                for (let i = 0; i < tags.length; i++) {
                    if (this.categories.includes(tags[i].tagname)) flag = true;
                }
            }
            return flag;
        },
    },
};
</script>
