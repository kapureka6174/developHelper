<template>
    <div class="flex items-center justify-center my-4">
        <div v-for="(tab, index) in tabs" :key="index">
            <div
                class="px-4 py-2 text-gray-500 border-b-8 cursor-pointer"
                :class="activeTab === index ? 'text-green-500 border-green-500' : ''"
                @click="order(tab, index)"
            >
                {{ tab }}
            </div>
        </div>
    </div>
</template>

<script>
    import { ref, reactive } from "vue";

    export default {
        props: {
            type: String,
        },
        setup(props, ctx) {
            let activeTab = ref();
            const tabsContent =
                props.type === "developer"
                    ? ["お気に入り数順", "コメント数順"]
                    : ["新着順", "お気に入り数順", "コメント数順"];
            const tabs = reactive(tabsContent);

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
