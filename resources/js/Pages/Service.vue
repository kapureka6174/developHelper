<template>
    <div>
        <service-detail-layout>
            <template #header>
                <div class="flex items-center justify-between">
                    <h2
                        class="
                            font-semibold
                            text-xl text-gray-800
                            leading-tight
                        "
                    >
                        サービス詳細画面
                    </h2>
                    <div>
                        <service-edit-button @click="edit" />
                        <service-delete-button @click="check" />
                    </div>
                </div>
                <success-flash-message
                    :success="$page.props.flash.success"
                    @deleteFlash="
                        () => {
                            $page.props.flash.success = null;
                        }
                    "
                />
            </template>

            <!-- サービスの詳細 -->
            <div
                class="
                    py-10
                    px-4
                    col-span-7
                    bg-white
                    overflow-hidden
                    shadow-xl
                    sm:rounded-lg
                "
            >
                <service-title :title="service.title" />

                <tag
                    v-for="tag in service.tags"
                    :key="tag.id"
                    :tagname="tag.tagname"
                />

                <service-description :description="service.description" />

                <service-usage-technology :techFields="techFields" />

                <service-requirement :requirements="requirements" />

                <service-page :pages="pages" />

                <service-uri-design :uris="uris" />

                <service-task
                    @taskButton="taskSubmit"
                    :tasks="tasks"
                    :id="service.user_id"
                />

                <h1 class="text-2xl text-indigo-700 font-semibold my-2">
                    コメント
                </h1>
                <div
                    v-for="comment in comments"
                    :key="comment.id"
                    class="rounded-md bg-gray-100 w-full my-3 p-5"
                >
                    <div class="flex items-center">
                        <h1 class="text-gray-600 font-bold text-2xl mr-2">
                            {{ comment.user.name }}
                        </h1>
                        <h2
                            class="
                                text-gray-600
                                font-semibold
                                bg-blue-100
                                rounded
                                text-center
                                py-2
                                px-4
                            "
                        >
                            {{ comment.type }}
                        </h2>
                    </div>
                    <p class="text-gray-600 mt-2">
                        {{ comment.content }}
                    </p>
                </div>

                <div class="w-full bg-gray-100 p-4 flex flex-col" id="comment">
                    <select
                        class="
                            w-32
                            rounded
                            border border-gray-200
                            focus:outline-none
                            focus:ring-1
                            focus:ring-blue-500
                            focus:border-blue-500
                            mb-3
                        "
                        v-model="form.comments.type"
                    >
                        <option value="質問">質問</option>
                        <option value="アドバイス">アドバイス</option>
                        <option value="感想">感想</option>
                    </select>
                    <textarea
                        class="
                            autoexpand
                            tracking-wide
                            py-2
                            px-4
                            mb-3
                            leading-relaxed
                            appearance-none
                            block
                            w-full
                            border border-gray-200
                            rounded
                            focus:outline-none
                            focus:bg-white
                            focus:border-gray-500
                        "
                        v-model="form.comments.content"
                        v-if="!form.comments.decidable"
                        rows="10"
                    ></textarea>
                    <p
                        v-else
                        class="
                            py-2
                            px-4
                            mb-3
                            w-full
                            whitespace-pre-line
                            break-words
                        "
                    >
                        {{ form.comments.content }}
                    </p>
                    <div v-if="$page.props.errors.comments">
                        <div
                            v-for="(error, index) in Object.values(
                                $page.props.errors.comments
                            )"
                            :key="index"
                            class="
                                bg-red-100
                                border border-red-400
                                text-red-700
                                px-4
                                py-3
                                rounded
                                my-2
                            "
                            role="alert"
                        >
                            <p class="font-bold">
                                {{ error }}
                            </p>
                        </div>
                    </div>
                    <div class="flex justify-end w-full">
                        <button
                            v-if="!form.comments.decidable"
                            class="
                                bg-indigo-600
                                hover:bg-indigo-400
                                h-10
                                w-16
                                mr-3
                                text-white
                                rounded
                            "
                            @click="form.comments.decidable = true"
                        >
                            決定
                        </button>
                        <button
                            v-else
                            class="
                                bg-indigo-600
                                hover:bg-indigo-400
                                h-10
                                w-16
                                mr-3
                                text-white
                                rounded
                            "
                            @click="form.comments.decidable = false"
                        >
                            編集
                        </button>
                        <button
                            class="
                                bg-indigo-600
                                hover:bg-indigo-400
                                h-10
                                w-16
                                text-white
                                rounded
                            "
                            @click="commentSubmit"
                        >
                            投稿
                        </button>
                    </div>
                </div>
            </div>

            <float-buttons
                :liked_by_user="service.liked_by_user"
                :service_id="service.id"
                :user="$page.props.user"
            />
        </service-detail-layout>
    </div>
</template>

<script>
import ServiceDetailLayout from "../Layouts/ServiceDetailLayout.vue";
import ServiceEditButton from "../components/atoms/ServiceEditButton.vue";
import ServiceDeleteButton from "../components/atoms/ServiceDeleteButton.vue";
import FloatButtons from "../components/FloatButtons.vue";
import ServiceTitle from "../components/atoms/ServiceTitle.vue";
import Tag from "../components/atoms/Tag.vue";
import ServiceDescription from "../components/atoms/ServiceDescription.vue";
import ServiceUsageTechnology from "../components/atoms/ServiceUsageTechnology.vue";
import ServiceRequirement from "../components/atoms/ServiceRequirement.vue";
import ServicePage from "../components/atoms/ServicePage.vue";
import ServiceUriDesign from "../components/atoms/ServiceUriDesign.vue";
import ServiceTask from "../components/atoms/ServiceTask.vue";
import SuccessFlashMessage from "../components/atoms/SuccessFlashMessage.vue";

import { Inertia } from "@inertiajs/inertia";
import { useForm } from "@inertiajs/inertia-vue3";
import { provide } from "vue";

export default {
    components: {
        ServiceDetailLayout,
        ServiceEditButton,
        ServiceDeleteButton,
        FloatButtons,
        ServiceTitle,
        Tag,
        ServiceDescription,
        ServiceUsageTechnology,
        ServiceRequirement,
        ServicePage,
        ServiceUriDesign,
        ServiceTask,
        SuccessFlashMessage,
    },
    props: {
        service: Object,
        techFields: Array,
        requirements: Array,
        pages: Array,
        uris: Array,
        tasks: Array,
        comments: Array,
    },
    setup(props) {
        let tasks = [];
        if (props.tasks.length) {
            tasks = props.tasks.map((task) => {
                task.decidable = true;
                task.isDelete = false;
                return task;
            });
        }

        // 送信するデータ（コメント と タスク）
        const form = useForm({
            id: props.service.id,
            comments: {
                type: "",
                content: "",
                decidable: false,
            },
            tasks,
        });

        const index = (obj) => {
            return form.tasks.indexOf(obj);
        };

        // type(やるべきこと、開発中、完了)ごとに削除されていない状態の配列をインデックスを取得して返す。
        const getArray = (type) => {
            const todos = form.tasks.filter(
                (e) => e.state == type && !e.isDelete
            );
            return todos.map((todo) => {
                todo.index = index(todo);
                return todo;
            });
        };

        // クライアント側のバリデーション（空文字なら追加しない）
        const addContent = (e, index) => {
            if (e.target.value && e.target.value.match(/\S/g))
                form.tasks[index].decidable = true;
        };

        // CommentControllerにformを渡す
        const commentSubmit = () => {
            Inertia.post(route("Comment"), form, {
                errorBag: "comments",
                preserveScroll: true,
            });
        };

        // TaskControllerにformを渡す
        const taskSubmit = () => {
            Inertia.put(route("Task"), form, {
                errorBag: "tasks",
                preserveScroll: true,
            });
        };

        const check = () => {
            if (confirm(`${props.service.title}を本当に削除しますか？`)) {
                Inertia.delete(route("Delete"), { id: props.service.id });
            }
        };

        provide("tasks", form.tasks);

        return {
            form,
            getArray,
            addContent,
            commentSubmit,
            taskSubmit,
            check,
        };
    },
};
</script>
