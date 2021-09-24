<template>
    <div class="flex justify-center items-center my-4">
        <div v-for="(tab, index) in tabs" :key="index">
            <div
                class="cursor-pointer py-2 px-4 text-gray-500 border-b-8"
                :class="
                    activeTab === index ? 'text-pink-500 border-pink-500' : ''
                "
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
        const tabs = reactive(["全て", "開発中", "完成"]);

        const order = (tab, index) => {
            activeTab.value = index;
            switch (tab) {
                case "全て":
                    ctx.emit("all", 2);
                    break;
                case "開発中":
                    ctx.emit("develop", 0);
                    break;
                case "完成":
                    ctx.emit("finished", 1);
                    break;

                default:
                    break;
            }
        };

        return { activeTab, tabs, order };
    },
};
</script>
