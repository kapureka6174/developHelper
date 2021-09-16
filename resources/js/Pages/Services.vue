<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                サービス一覧
            </h2>
        </template>

        <div class="mx-2">
            <!-- タグ一覧の表示 -->
            <div class="md:mt-6 md:ml-12 mt-4 md:ml-6">
                <h1 class="text-2xl text-indigo-700 font-semibold mb-2">
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
            <div v-if="categories.length" class="md:mt-6 md:ml-12 mt-4 md:ml-6">
                <h1 class="text-2xl text-indigo-700 font-semibold mb-2">
                    選択中
                </h1>
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

            <!-- 並び替え -->
            <div class="md:mt-6 md:ml-12 mt-4 md:ml-6">
                <div class="flex justify-center items-center my-4">
                    <div v-for="(tab, index) in tabs" :key="index">
                        <div
                            class="
                                cursor-pointer
                                py-2
                                px-4
                                text-gray-500
                                border-b-8
                            "
                            :class="
                                activeTab === index
                                    ? 'text-green-500 border-green-500'
                                    : ''
                            "
                            @click="order(tab, index)"
                        >
                            {{ tab }}
                        </div>
                    </div>
                </div>
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
                    :user="service.user"
                    :date="service.created_at"
                    :likes="service.likes_count"
                    :comments="service.comments_count"
                    v-show="existCategory(service.tags)"
                />
            </div>
        </div>
    </app-layout>
</template>

<script>
import AppLayout from "../Layouts/AppLayout.vue";
import ServiceCard from "../components/ServiceCard.vue";
import { reactive, ref } from "vue";

export default {
    components: {
        AppLayout,
        ServiceCard,
    },
    props: {
        services: Array,
        tags: Array,
    },
    setup(props) {
        // カテゴリーを選択中に追加する
        const categories = reactive([]);
        const plusCategory = (name) => {
            if (!categories.includes(name)) categories.push(name);
        };

        // 選択中のカテゴリーがサービスが個別に持つタグと一致しているかどうか
        const existCategory = (tags) => {
            let flag = true;
            if (categories.length) {
                let count = 0;
                for (let i = 0; i < tags.length; i++) {
                    if (categories.includes(tags[i].tagname)) count++;
                }
                flag = count == categories.length ? true : false;
            }
            return flag;
        };

        let activeTab = ref();
        const tabs = reactive(["新着順", "お気に入り数順", "コメント数順"]);

        const order = (tab, index) => {
            activeTab.value = index;
            console.log(activeTab);
            switch (tab) {
                case "新着順":
                    // eslint-disable-next-line vue/no-mutating-props
                    props.services.sort((a, b) => {
                        let dateA = a.created_at;
                        let dateB = b.created_at;
                        return dateA < dateB ? 1 : dateA > dateB ? -1 : 0;
                    });
                    break;
                case "お気に入り数順":
                    // eslint-disable-next-line vue/no-mutating-props
                    props.services.sort((a, b) => {
                        return a.likes_count < b.likes_count
                            ? 1
                            : a.likes_count > b.likes_count
                            ? -1
                            : 0;
                    });
                    break;
                case "コメント数順":
                    // eslint-disable-next-line vue/no-mutating-props
                    props.services.sort((a, b) => {
                        return a.comments_count < b.comments_count
                            ? 1
                            : a.comments_count > b.comments_count
                            ? -1
                            : 0;
                    });
                    break;

                default:
                    break;
            }
        };

        return {
            categories,
            plusCategory,
            existCategory,
            activeTab,
            tabs,
            order,
        };
    },
};
</script>
