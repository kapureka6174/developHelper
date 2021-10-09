<template>
    <div class="flex items-center mb-2">
        <section-title title="タスク" />
        <!-- タスクの保存ボタン -->
        <save-button class="ml-2" />
    </div>

    <!-- エラー表示 -->
    <server-error
        :errorFlag="$page.props.errors.tasks"
        :errors="
            Object.entries($page.props.errors).filter((e) => {
                return /comments/.test(e[0]);
            })
        "
    />
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <div
            v-for="(state, index) in ['やるべきこと', '開発中', '完了']"
            :key="index"
            class="w-full bg-gray-100 rounded py-6 px-2"
        >
            <div class="flex items-center">
                <h2
                    class="
                        text-gray-700
                        font-bold
                        text-2xl
                        mx-auto
                        my-1
                        w-4/5
                        text-center
                    "
                >
                    {{ state }}
                </h2>
                <!-- 追加ボタン -->
                <add-button :state="state" />
            </div>

            <!-- タスク -->
            <div
                v-for="task in tasksIndex(state)"
                :key="task.index"
                class="my-2 flex items-center"
            >
                <input
                    v-if="!task.decidable"
                    type="text"
                    v-model="tasks[task.index].taskname"
                    @keyup.enter="addContent($event, task.index)"
                    class="
                        appearance-none
                        block
                        w-4/5
                        bg-white
                        text-gray-700
                        border border-gray-200
                        rounded
                        py-3
                        mx-auto
                        leading-tight
                        focus:outline-none
                        focus:ring-1
                        focus:ring-blue-500
                        focus:border-blue-500
                    "
                />
                <div
                    v-else
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
                    <to-left-button
                        v-if="state !== 'やるべきこと'"
                        :state="stateToLeft(tasks[task.index].state)"
                        :index="task.index"
                    />
                    <p
                        class="text-gray-600 font-semibold mx-auto"
                        @click="tasks[task.index].decidable = false"
                    >
                        {{ tasks[task.index].taskname }}
                    </p>
                    <to-right-button
                        v-if="state !== '完了'"
                        :state="stateToRight(tasks[task.index].state)"
                        :index="task.index"
                    />
                </div>
                <!-- 削除ボタン -->
                <delete-button :index="task.index" />
            </div>
        </div>
    </div>
</template>
<script>
import ToLeftButton from "./ToLeftButton";
import ToRightButton from "./ToRightButton";
import AddButton from "./AddButton";
import DeleteButton from "./DeleteButton";
import SectionTitle from "../Utility/SectionTitle";
import ServerError from "../Utility/ServerError";
import SaveButton from "./SaveButton";

import { inject } from "vue";
export default {
    components: {
        ToLeftButton,
        ToRightButton,
        AddButton,
        DeleteButton,
        SectionTitle,
        ServerError,
        SaveButton,
    },
    setup() {
        const tasks = inject("tasks");
        console.log(tasks[0]);

        const tasksIndex = (state) => {
            return tasks
                .map((task, index) => {
                    if (!tasks.index) {
                        task.index = index;
                    }
                    return task;
                })
                .filter((task) => task.state == state && !task.isDelete);
        };

        // クライアント側のバリデーション（空文字なら追加しない）
        const addContent = (e, index) => {
            if (e.target.value && e.target.value.match(/\S/g))
                tasks[index].decidable = true;
        };

        const stateToLeft = (state) => {
            if (state == "開発中") {
                state = "やるべきこと";
            } else if (state == "完了") {
                state = "開発中";
            }
            return state;
        };
        const stateToRight = (state) => {
            if (state == "やるべきこと") {
                state = "開発中";
            } else if (state == "開発中") {
                state = "完了";
            }
            return state;
        };

        return { tasks, tasksIndex, addContent, stateToLeft, stateToRight };
    },
};
</script>
