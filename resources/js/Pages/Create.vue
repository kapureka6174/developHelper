<template>
    <app-layout>
        <template #header>
            <div class="flex items-center justify-between">
                <h2 class="text-gray-800 text-xl font-semibold leading-tight">新規作成</h2>
                <button
                    class="w-12 h-8 text-white hover:bg-indigo-400 bg-indigo-600 rounded"
                    @click="submit"
                >
                    保存
                </button>
            </div>
        </template>

        <div class="px-4 py-10">
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
            <state-select />

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
                <div class="flex items-center mb-3">
                    <section-title title="サービス概要" />
                    <hint-tool-tip type="サービス概要" />
                    <description-buttons />
                </div>
                <description-input />
            </div>

            <!-- 使用技術について -->
            <div class="flex items-center mb-3">
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
            <div class="flex items-center mb-3">
                <section-title title="要件定義" />
                <hint-tool-tip type="要件定義" />
                <require-add-button />
            </div>
            <div>
                <section class="text-gray-700">
                    <div class="container px-5 py-2">
                        <div class="flex flex-wrap">
                            <require-input
                                v-for="(requirement, index) in form.requirements"
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
            <require-select-list
                v-for="(requirment, index) in form.requirements"
                :key="index"
                :index="index"
            />

            <div class="w-full text-center">
                <page-add-button />
            </div>

            <div class="grid grid-cols-1 justify-between md:grid-cols-2">
                <page-input v-for="(page, index) in form.pages" :key="index" :index="index" />
            </div>

            <!-- URI設計 -->
            <div class="flex items-center mb-3">
                <section-title title="URI設計" />
                <hint-tool-tip type="URI設計" />
                <uri-add-button />
            </div>

            <uri-input :uris="form.uris" />
        </div>
    </app-layout>
</template>

<script>
    import AppLayout from "../Layouts/AppLayout";
    import SectionTitle from "../components/Utility/SectionTitle";
    import TitleInput from "../components/Title/TitleInput";
    import StateSelect from "../components/Title/StateSelect";
    import TagsInput from "../components/Tag/Input";
    import DescriptionButtons from "../components/Description/Buttons";
    import DescriptionInput from "../components/Description/Input";
    import TechFieldAddButton from "../components/TechField/AddButton";
    import TechFieldInput from "../components/TechField/Input";
    import RequireAddButton from "../components/Requirement/AddButton";
    import RequireInput from "../components/Requirement/Input";
    import RequireSelectList from "../components/Requirement/SelectList";
    import PageAddButton from "../components/Page/AddButton";
    import PageInput from "../components/Page/Input";
    import UriAddButton from "../components/Uri/AddButton";
    import UriInput from "../components/Uri/Input";
    import FailFlashMessage from "../components/Utility/FailFlashMessage";
    import UrlsInput from "../components/Title/UrlsInput";
    import HintToolTip from "../components/Utility/HintToolTip";

    import { provide } from "vue";
    import { useForm } from "@inertiajs/inertia-vue3";

    export default {
        components: {
            AppLayout,
            SectionTitle,
            TitleInput,
            StateSelect,
            TagsInput,
            DescriptionButtons,
            DescriptionInput,
            TechFieldAddButton,
            TechFieldInput,
            RequireAddButton,
            RequireInput,
            RequireSelectList,
            PageAddButton,
            PageInput,
            UriAddButton,
            UriInput,
            FailFlashMessage,
            UrlsInput,
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
                            error: "",
                            selected: false,
                        };
                        break;
                    default:
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
                    explain: normalObj(1),
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

            const form = useForm({
                title: normalObj(1),
                tags: {
                    content: [],
                    error: "",
                },
                description: normalObj(1),
                techFields: [techField()],
                requirements: [requirement()],
                uris: [uri()],
                pages: [page()],
                github_url: normalObj(1),
                site_url: normalObj(1),
                finished: {
                    state: false,
                },
            });

            // DBへ保存
            const submit = () => {
                form.post("/create", form);
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
