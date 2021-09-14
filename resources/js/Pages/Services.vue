<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                サービス一覧
            </h2>
        </template>

        <!-- タグ一覧の表示 -->
        <div>
            <div class="m-3">
                <h1 class="text-2xl text-indigo-700 font-semibold">
                    カテゴリー
                </h1>
                <div
                    v-for="(tag, index) in tags"
                    :key="index"
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

            <!-- 選択中のタグ一覧の表示 -->
            <div v-if="categories.length" class="m-3">
                <h1 class="text-2xl text-indigo-700 font-semibold">選択中</h1>
                <div
                    v-for="(category, index) in categories"
                    :key="index"
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
                    @click="categories.splice(index, 1)"
                >
                    {{ category }}
                </div>
            </div>

            <div class="m-3">
                <h1 class="text-2xl text-indigo-700 font-semibold">並び替え</h1>
            </div>

            <!-- サービス一覧の表示 -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 px-2">
                <service-card
                    v-for="service in services"
                    :key="service.id"
                    :id="service.id"
                    :title="service.title"
                    :description="service.description"
                    :tags="service.tags"
                    v-show="existCategory(service.tags)"
                />
            </div>
        </div>
    </app-layout>
</template>

<script>
import AppLayout from "../Layouts/AppLayout.vue";
import ServiceCard from "../components/ServiceCard.vue";
import { reactive } from "vue";

export default {
    components: {
        AppLayout,
        ServiceCard,
    },
    props: {
        services: Array,
        tags: Array,
    },
    setup() {
        // カテゴリーを選択中に追加する
        const categories = reactive([]);
        const plusCategory = (name) => {
            if (!categories.includes(name)) categories.push(name);
        };

        // 選択中のカテゴリーがサービスが個別に持つタグと一致しているかどうか
        const existCategory = (tags) => {
            let flag = true;
            if (categories.length) {
                flag = false;
                for (let i = 0; i < tags.length; i++) {
                    if (categories.includes(tags[i].tagname)) flag = true;
                }
            }
            return flag;
        };

        return {
            categories,
            plusCategory,
            existCategory,
        };
    },
};
</script>
