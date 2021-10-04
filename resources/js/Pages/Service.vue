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
                        サービス詳細
                    </h2>
                    <responsive-service-develop-state
                        :finished="service.finished"
                    />
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
                class="
                    pt-6
                    pb-10
                    px-4
                    col-span-7
                    bg-white
                    overflow-hidden
                    shadow-xl
                    sm:rounded-lg
                "
            >
                <div class="flex md:flex-row flex-col">
                    <service-title :title="service.title" />

                    <service-develop-state :finished="service.finished" />
                </div>

                <tag
                    v-for="tag in service.tags"
                    :key="tag.id"
                    :tagname="tag.tagname"
                />

                <service-description :description="service.description" />

                <service-urls
                    :github_url="service.github_url"
                    :site_url="service.site_url"
                />

                <service-usage-technology
                    v-if="techFields.length"
                    :techFields="techFields"
                />

                <service-requirement
                    v-if="requirements.length"
                    :requirements="requirements"
                />

                <service-page v-if="pages.length" :pages="pages" />

                <service-uri-design v-if="uris.length" :uris="uris" />

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
import ServiceDetailLayout from "../Layouts/ServiceDetailLayout";
import ServiceEditButton from "../components/Utility/ServiceEditButton";
import ServiceDeleteButton from "../components/Utility/ServiceDeleteButton";
import FloatButtons from "../components/FloatButtons/FloatButtons";
import ServiceTitle from "../components/Title/ServiceTitle";
import Tag from "../components/Tag/Tag";
import ServiceDescription from "../components/Description/ServiceDescription";
import ServiceUsageTechnology from "../components/TechField/ServiceUsageTechnology";
import ServiceRequirement from "../components/Requirement/ServiceRequirement";
import ServicePage from "../components/Page/ServicePage";
import ServiceUriDesign from "../components/Uri/ServiceUriDesign";
import ServiceTask from "../components/Task/ServiceTask";
import ServiceCommentShow from "../components/Comment/ServiceCommentShow";
import ServiceCommentForm from "../components/Comment/ServiceCommentForm";
import SuccessFlashMessage from "../components/Utility/SuccessFlashMessage";
import ServiceDevelopState from "../components/Title/ServiceDevelopState";
import ResponsiveServiceDevelopState from "../components/Title/ResponsiveServiceDevelopState";
import ServiceUrls from "../components/Title/ServiceUrls";

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
        ServiceDevelopState,
        ResponsiveServiceDevelopState,
        ServiceUrls,
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
