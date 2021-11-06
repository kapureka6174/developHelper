<template>
    <div>
        <service-detail-layout>
            <template #header>
                <div class="flex items-center justify-between">
                    <h2 class="text-gray-800 text-xl font-semibold leading-tight">サービス詳細</h2>
                    <responsive-state :finished="service.finished" />
                    <div
                        v-if="
                            $page.props.user !== null &&
                            $page.props.user.id == $page.props.service.user_id
                        "
                    >
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
                    @delete="$page.props.flash.success = null"
                />
            </template>

            <!-- サービスの詳細 -->
            <div
                class="col-span-7 pb-10 pt-6 px-4 bg-white shadow-xl overflow-hidden sm:rounded-lg"
            >
                <div class="flex flex-col md:flex-row">
                    <Title :title="service.title" />

                    <state :finished="service.finished" />
                </div>

                <tag v-for="tag in service.tags" :key="tag.id" :tagname="tag.tagname" />

                <description :description="service.description" />

                <urls :github_url="service.github_url" :site_url="service.site_url" />

                <tech-field v-if="techFields.length" :techFields="techFields" />

                <require v-if="requirements.length" :requirements="requirements" />

                <page v-if="pages.length" :pages="pages" />

                <uri v-if="uris.length" :uris="uris" />

                <!-- タスク -->
                <task-show
                    v-if="
                        $page.props.user == null ||
                        $page.props.user.id !== $page.props.service.user_id
                    "
                    :tasks="form.tasks"
                />
                <task-input v-else />

                <!-- コメント一覧 -->
                <comment-show :comments="comments" />
                <!-- コメント投稿 -->
                <comment-forms />
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
    import ServiceDetailLayout from "../Layouts/ServiceDetailLayout";
    import ServiceEditButton from "../components/Utility/ServiceEditButton";
    import ServiceDeleteButton from "../components/Utility/ServiceDeleteButton";
    import ResponsiveState from "../components/Title/ResponsiveStateShow";
    import FloatButtons from "../components/FloatButtons/FloatButtons";
    import Title from "../components/Title/TitleShow";
    import State from "../components/Title/StateShow";
    import Tag from "../components/Tag/Show";
    import Description from "../components/Description/Show";
    import Urls from "../components/Title/UrlsShow";
    import TechField from "../components/TechField/Show";
    import Require from "../components/Requirement/Show";
    import Page from "../components/Page/Show";
    import Uri from "../components/Uri/Show";
    import TaskShow from "../components/Task/Show";
    import TaskInput from "../components/Task/Input";
    import CommentShow from "../components/Comment/Show";
    import CommentForms from "../components/Comment/Forms";
    import SuccessFlashMessage from "../components/Utility/SuccessFlashMessage";

    import { Inertia } from "@inertiajs/inertia";
    import { useForm } from "@inertiajs/inertia-vue3";
    import { provide } from "vue";

    export default {
        components: {
            ServiceDetailLayout,
            ServiceEditButton,
            ServiceDeleteButton,
            ResponsiveState,
            FloatButtons,
            Title,
            State,
            Tag,
            Description,
            Urls,
            TechField,
            Require,
            Page,
            Uri,
            TaskShow,
            TaskInput,
            SuccessFlashMessage,
            CommentShow,
            CommentForms,
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
                    error: "",
                },
                tasks,
                deleteTasks: [],
            });

            const check = () => {
                if (confirm(`${props.service.title}を本当に削除しますか？`)) {
                    Inertia.delete(route("Delete", { id: props.service.id }));
                }
            };

            provide("form", form);
            provide("tasks", form.tasks);
            provide("deleteTasks", form.deleteTasks);
            provide("title", props.service.title);
            provide("comment", form.comments);

            return {
                form,
                check,
            };
        },
    };
</script>
