<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                サービス一覧
            </h2>
        </template>

        <div class="mx-2">
            <success-flash-message
                :success="$page.props.flash.success"
                @deleteFlash="
                    () => {
                        $page.props.flash.success = null;
                    }
                "
                @delete="$page.props.flash.success = null"
            />
            <div class="md:mt-6 md:ml-12 mt-4 md:ml-6">
                <h1 class="text-2xl text-indigo-700 font-semibold mb-2">
                    カテゴリー
                </h1>
                <tag
                    v-for="(tag, index) in tags"
                    :key="index"
                    :tagname="tag.tagname"
                    :hover="true"
                    @click="plusSelectedTag(tag.tagname)"
                />
            </div>

            <div
                v-if="selectedTags.length"
                class="md:mt-6 md:ml-12 mt-4 md:ml-6"
            >
                <h1 class="text-2xl text-indigo-700 font-semibold mb-2">
                    選択中
                </h1>
                <selected-tag
                    v-for="(selectedTag, index) in selectedTags"
                    :key="index"
                    :tagname="selectedTag"
                    @selectTag="(index) => selectedTags.splice(index, 1)"
                />
            </div>

            <!-- 並び替え -->
            <sort-button
                :services="services"
                @dateOrder="order"
                @likeOrder="order"
                @commentOrder="order"
            />

            <!-- サービス一覧の表示 -->
            <div
                class="
                    flex
                    items-center
                    flex-col
                    md:grid md:grid-cols-2
                    lg:grid-cols-3
                    md:gap-4
                    px-2
                "
            >
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
                    v-show="existSelectedTag(service.tags)"
                />
            </div>
        </div>
    </app-layout>
</template>

<script>
import AppLayout from "../Layouts/AppLayout.vue";
import ServiceCard from "../components/ServiceCard.vue";
import SortButton from "../components/atoms/SortButton.vue";
import Tag from "../components/atoms/Tag.vue";
import SelectedTag from "../components/atoms/SelectedTag.vue";
import SuccessFlashMessage from "../components/atoms/SuccessFlashMessage";

import { reactive } from "vue";

export default {
    components: {
        AppLayout,
        ServiceCard,
        SortButton,
        Tag,
        SelectedTag,
        SuccessFlashMessage,
    },
    props: {
        services: Array,
        tags: Array,
    },
    setup(props) {
        // カテゴリーを選択中に追加する
        const selectedTags = reactive([]);
        const plusSelectedTag = (name) => {
            if (!selectedTags.includes(name)) selectedTags.push(name);
        };

        // 該当カテゴリーの検索（選択中のカテゴリーがサービスが個別に持つタグと一致しているかどうか）
        const existSelectedTag = (tags) => {
            let flag = true;
            if (selectedTags.length) {
                let count = 0;
                for (let i = 0; i < tags.length; i++) {
                    if (selectedTags.includes(tags[i].tagname)) count++;
                }
                flag = count == selectedTags.length ? true : false;
            }
            return flag;
        };

        // 並び替え
        const order = (type) => {
            // eslint-disable-next-line vue/no-mutating-props
            props.services.sort((a, b) => {
                return a[type] < b[type] ? 1 : a[type] > b[type] ? -1 : 0;
            });
        };

        return {
            selectedTags,
            plusSelectedTag,
            existSelectedTag,
            order,
        };
    },
};
</script>
