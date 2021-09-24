<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                開発者一覧
            </h2>
        </template>

        <div class="mx-2 pt-6">
            <!-- 並び替え -->
            <sort-button
                type="developer"
                @likeOrder="order"
                @commentOrder="order"
            />

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div v-for="user in users" :key="user.id">
                    <developer-card
                        :id="user.id"
                        :name="user.name"
                        :introduction="user.introduction"
                        :likes="user.likes_count"
                        :comments="user.comments_count"
                    />
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
import AppLayout from "../Layouts/AppLayout.vue";
import DeveloperCard from "../components/DeveloperCard.vue";
import SortButton from "../components/atoms/SortButton.vue";

export default {
    components: {
        AppLayout,
        DeveloperCard,
        SortButton,
    },

    props: {
        users: {
            type: Array,
        },
    },

    setup(props) {
        // 並び替え
        const order = (type) => {
            props.users.sort((a, b) => {
                return a[type] < b[type] ? 1 : a[type] > b[type] ? -1 : 0;
            });
        };

        return { order };
    },
};
</script>
