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
                    @delete="$page.props.flash.success = null"
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

                <service-task :tasks="tasks" :id="service.user_id" />

                <service-comment-show :comments="comments" />

                <service-comment-form />
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
import ServiceCommentShow from "../components/atoms/ServiceCommentShow.vue";
import ServiceCommentForm from "../components/atoms/ServiceCommentForm.vue";
import SuccessFlashMessage from "../components/atoms/SuccessFlashMessage";

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
        ServiceCommentShow,
        ServiceCommentForm,
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

        const check = () => {
            if (confirm(`${props.service.title}を本当に削除しますか？`)) {
                Inertia.delete(route("Delete", { id: props.service.id }));
            }
        };

        provide("form", form);
        provide("tasks", form.tasks);
        provide("title", props.service.title);

        return {
            form,
            check,
        };
    },
};
</script>
