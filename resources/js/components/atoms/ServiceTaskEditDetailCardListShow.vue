<template>
    <div
        class="
            mx-auto
            bg-blue-200
            w-11/12
            rounded
            text-center
            flex
            items-center
            py-3
            justify-between
        "
    >
        <service-task-left-button
            v-if="state !== 'やるべきこと'"
            :state="stateToLeft()"
            :index="index"
        />
        <p
            class="text-gray-600 font-semibold mx-auto"
            @click="tasks[index].decidable = false"
        >
            {{ tasks[index].taskname }}
        </p>
        <service-task-right-button
            v-if="state !== '完了'"
            :state="stateToRight()"
            :index="index"
        />
    </div>
</template>
<script>
import ServiceTaskLeftButton from "./ServiceTaskLeftButton.vue";
import ServiceTaskRightButton from "./ServiceTaskRightButton.vue";

import { inject } from "vue";

export default {
    components: {
        ServiceTaskLeftButton,
        ServiceTaskRightButton,
    },
    props: {
        index: Number,
        state: String,
    },
    setup(props) {
        const tasks = inject("tasks");
        const stateToLeft = () => {
            let state = props.state;
            if (state == "開発中") {
                state = "やるべきこと";
            } else if (state == "完了") {
                state = "開発中";
            }
            return state;
        };
        const stateToRight = () => {
            let state = props.state;
            if (state == "やるべきこと") {
                state = "開発中";
            } else if (state == "開発中") {
                state = "完了";
            }
            return state;
        };

        return { tasks, stateToLeft, stateToRight };
    },
};
</script>
