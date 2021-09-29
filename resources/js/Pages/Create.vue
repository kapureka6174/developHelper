<template>
    <app-layout>
        <template #header>
            <div class="flex items-center justify-between">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    新規作成
                </h2>
                <button
                    class="
                        bg-indigo-600
                        hover:bg-indigo-400
                        h-8
                        w-12
                        text-white
                        rounded
                    "
                    @click="submit"
                >
                    保存
                </button>
            </div>
        </template>

        <div class="py-10 px-4">
            <fail-flash-message
                :fail="$page.props.flash.fail"
                @deleteFlash="
                    () => {
                        $page.props.flash.fail = null;
                    }
                "
                @delete="$page.props.flash.fail = null"
            />
            <!-- サービス名 -->
            <div class="flex">
                <section-title title="サービス名" />
                <hint-tool-tip type="サービス名" />
            </div>
            <title-input />
            <service-state-select />

            <!-- サービスのURL -->
            <div class="flex">
                <section-title title="サービスURL" />
                <hint-tool-tip type="サービスURL" />
            </div>
            <urls-input />

            <!-- カテゴリー -->
            <div class="flex">
                <section-title title="カテゴリー" />
                <hint-tool-tip type="カテゴリー" />
            </div>
            <tags-input />

            <!-- サービスの概要 -->
            <div class="pt-3">
                <div class="flex mb-3 items-center">
                    <section-title title="サービス概要" />
                    <hint-tool-tip type="サービス概要" />
                    <description-buttons />
                </div>
                <description-input />
            </div>

            <!-- 使用技術について -->
            <div class="flex mb-3 items-center">
                <section-title title="使用技術" />
                <hint-tool-tip type="使用技術" />
                <tech-field-add-button />
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2">
                <tech-field-input
                    v-for="(techField, index) in form.techFields"
                    :key="index"
                    :index="index"
                />
            </div>

            <!-- 要件定義 -->
            <div class="flex mb-3 items-center">
                <section-title title="要件定義" />
                <hint-tool-tip type="要件定義" />
                <requirement-add-button />
            </div>
            <div>
                <section class="text-gray-700">
                    <div class="container px-5 py-2">
                        <div class="flex flex-wrap">
                            <requirement-input
                                v-for="(
                                    requirement, index
                                ) in form.requirements"
                                :key="index"
                                :index="index"
                            />
                        </div>
                    </div>
                </section>
            </div>

            <!-- ページ -->
            <div class="flex">
                <section-title title="ページ一覧" />
                <hint-tool-tip type="ページ" />
            </div>
            <requirement-select-list
                v-for="(requirment, index) in form.requirements"
                :key="index"
                :index="index"
            />

            <div class="w-full text-center">
                <page-add-button />
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 justify-between">
                <page-input
                    v-for="(page, index) in form.pages"
                    :key="index"
                    :index="index"
                />
            </div>

            <!-- URI設計 -->
            <div class="flex mb-3 items-center">
                <section-title title="URI設計" />
                <hint-tool-tip type="URI設計" />
                <uri-add-button />
            </div>
            <div class="overflow-x-auto">
                <div class="rounded-t-lg m-5 mx-auto bg-gray-200 text-gray-800">
                    <div
                        class="
                            text-left
                            border-b-2 border-gray-300
                            flex flex-col-3
                            items-center
                        "
                    >
                        <div class="px-4 py-3 w-3/12 md:w-3/12 text-center">
                            URI
                        </div>
                        <div class="px-4 py-3 w-3/12 md:w-1/12 text-center">
                            メソッド
                        </div>
                        <div class="px-4 py-3 w-6/12 md:w-8/12 text-center">
                            説明
                        </div>
                    </div>
                    <uri-input-list
                        v-for="(uri, index) in form.uris"
                        :key="index"
                        :index="index"
                    />
                </div>
            </div>
            <!-- エラー表示（サーバーサイド） -->
            <div v-if="Object.keys($page.props.errors).length">
                <div
                    v-for="(error, errorIndex) in Object.entries(
                        $page.props.errors
                    ).filter((e) => {
                        return e[0].split('.')[0] == 'uris' ? true : false;
                    })"
                    :key="errorIndex"
                    class="
                        bg-red-100
                        border border-red-400
                        text-red-700
                        px-4
                        py-3
                        rounded
                        m-2
                    "
                    role="alert"
                >
                    <p class="font-bold">
                        {{ error[1] }}
                    </p>
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
import AppLayout from "../Layouts/AppLayout";
import SectionTitle from "../components/Utility/SectionTitle";
import TitleInput from "../components/Title/TitleInput";
import TagsInput from "../components/Tag/TagsInput";
import DescriptionButtons from "../components/Description/DescriptionButtons";
import DescriptionInput from "../components/Description/DescriptionInput";
import TechFieldAddButton from "../components/TechField/TechFieldAddButton";
import TechFieldInput from "../components/TechField/TechFieldInput";
import RequirementAddButton from "../components/Requirement/RequirementAddButton";
import RequirementInput from "../components/Requirement/RequirementInput";
import RequirementSelectList from "../components/Requirement/RequirementSelectList";
import PageAddButton from "../components/Page/PageAddButton";
import PageInput from "../components/Page/PageInput";
import UriAddButton from "../components/Uri/UriAddButton";
import UriInputList from "../components/Uri/UriInputList";
import FailFlashMessage from "../components/Utility/FailFlashMessage";
import UrlsInput from "../components/Title/UrlsInput";
import ServiceStateSelect from "../components/Title/ServiceStateSelect";
import HintToolTip from "../components/Utility/HintToolTip";

import { reactive, provide } from "vue";
import { Inertia } from "@inertiajs/inertia";

export default {
    components: {
        AppLayout,
        SectionTitle,
        TitleInput,
        TagsInput,
        DescriptionButtons,
        DescriptionInput,
        TechFieldAddButton,
        TechFieldInput,
        RequirementAddButton,
        RequirementInput,
        RequirementSelectList,
        PageAddButton,
        PageInput,
        UriAddButton,
        UriInputList,
        FailFlashMessage,
        UrlsInput,
        ServiceStateSelect,
        HintToolTip,
    },
    setup() {
        const normalObj = (type) => {
            let obj;
            switch (type) {
                case 1:
                    obj = {
                        content: "",
                        decidable: false,
                        error: "",
                    };
                    break;
                case 2:
                    obj = {
                        content: "",
                        decidable: false,
                        error: false,
                        selected: false,
                    };
                    break;
                default:
                    obj = {
                        content: "",
                        decidable: false,
                        error: false,
                    };
                    break;
            }
            return obj;
        };

        const tech = () => {
            return {
                tech: normalObj(1),
                version: normalObj(1),
            };
        };

        const techField = () => {
            return {
                techField: normalObj(1),
                teches: [tech()],
            };
        };

        const requirement = () => {
            return {
                title: normalObj(2),
                explain: normalObj(),
            };
        };

        const uri = () => {
            return {
                uri: normalObj(1),
                method: normalObj(1),
                explain: normalObj(1),
            };
        };

        const page = () => {
            return {
                pagename: normalObj(1),
                requirements: [],
            };
        };

        const form = reactive({
            title: normalObj(),
            tags: {
                content: [],
                error: "",
            },
            description: normalObj(),
            techFields: [techField()],
            requirements: [requirement()],
            uris: [uri()],
            pages: [page()],
            github_url: normalObj(),
            site_url: normalObj(),
            finished: {
                state: false,
            },
        });

        // DBへ保存
        const submit = () => {
            Inertia.post("/create", form);
        };

        provide("title", form.title);
        provide("tags", form.tags);
        provide("description", form.description);
        provide("techFields", form.techFields);
        provide("newTechField", techField);
        provide("newTech", tech);
        provide("requirements", form.requirements);
        provide("newRequirement", requirement);
        provide("pages", form.pages);
        provide("newPage", page);
        provide("uris", form.uris);
        provide("newUri", uri);
        provide("github_url", form.github_url);
        provide("site_url", form.site_url);
        provide("finished", form.finished);

        return {
            form,
            submit,
        };
    },
};
</script>
