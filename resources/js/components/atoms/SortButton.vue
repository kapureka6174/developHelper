<template>
    <div class="md:mt-6 md:ml-12 mt-4 md:ml-6">
        <div class="flex justify-center items-center my-4">
            <div v-for="(tab, index) in tabs" :key="index">
                <div
                    class="cursor-pointer py-2 px-4 text-gray-500 border-b-8"
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
</template>

<script>
import { ref, reactive } from "vue";

export default {
    props: {
        services: Array,
    },
    setup(props, ctx) {
        let activeTab = ref();
        const tabs = reactive(["新着順", "お気に入り数順", "コメント数順"]);

        const order = (tab, index) => {
            activeTab.value = index;
            switch (tab) {
                case "新着順":
                    ctx.emit("dateOrder", "created_at");
                    break;
                case "お気に入り数順":
                    ctx.emit("likeOrder", "likes_count");
                    break;
                case "コメント数順":
                    ctx.emit("commentOrder", "comments_count");
                    break;

                default:
                    break;
            }
        };

        return { activeTab, tabs, order };
    },
};
</script>
