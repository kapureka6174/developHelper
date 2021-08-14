<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                新規作成画面
            </h2>
        </template>

        <div class="py-10 px-4">
            <h1 class="text-2xl text-indigo-700 font-semibold pb-3">
                サービス名
            </h1>
            <input
                v-if="title.editable"
                class="w-full rounded"
                type="text"
                @keyup.enter="plusTitle"
                :value="title.content"
                placeholder="サービス名を入力してください"
                v-on:blur="title.error = false"
            />
            <p
                v-else
                @click="title.editable = true"
                class="text-2xl font-bold text-gray-700"
            >
                {{ title.content }}
            </p>
            <div
                class="
                    bg-red-100
                    border border-red-400
                    text-red-700
                    px-4
                    py-3
                    rounded
                    mt-2
                "
                role="alert"
                v-if="title.error"
            >
                <strong class="font-bold"
                    >サービス名が入力されていません。</strong
                >
            </div>

            <h1 class="text-2xl text-indigo-700 font-semibold pb-3 mt-3">
                カテゴリー
            </h1>
            <div class="relative">
                <input
                    class="
                        appearance-none
                        block
                        w-full
                        md:w-1/2
                        bg-white
                        text-gray-700
                        border border-gray-200
                        rounded
                        py-2
                        px-4
                        leading-tight
                        focus:outline-none
                        focus:ring-1
                        focus:ring-blue-500
                        focus:border-blue-500
                    "
                    placeholder="カテゴリーを追加できます"
                    @keyup.enter="plusTag"
                    v-on:blur="tags.error = ''"
                />
                <!-- selections -->
                <div
                    class="
                        bg-red-100
                        border border-red-400
                        text-red-700
                        px-4
                        py-3
                        rounded
                        mt-2
                        w-full
                        md:w-1/2
                    "
                    role="alert"
                    v-if="tags.error"
                >
                    <strong class="font-bold">{{ tags.error }}</strong>
                </div>
                <div
                    class="
                        bg-blue-100
                        inline-flex
                        items-center
                        text-sm
                        rounded
                        mt-2
                        mr-1
                        overflow-hidden
                    "
                    v-for="tag in tags.content"
                    :key="tag"
                >
                    <span
                        class="ml-2 mr-1 leading-relaxed truncate max-w-xs px-1"
                        x-text="tag"
                        >{{ tag }}</span
                    >
                    <button
                        class="
                            w-6
                            h-8
                            inline-block
                            align-middle
                            text-gray-500
                            bg-blue-200
                            focus:outline-none
                        "
                        @click="deleteTag(tag)"
                    >
                        <svg
                            class="w-6 h-6 fill-current mx-auto"
                            xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 24 24"
                        >
                            <path
                                fill-rule="evenodd"
                                d="M15.78 14.36a1 1 0 0 1-1.42 1.42l-2.82-2.83-2.83 2.83a1 1 0 1 1-1.42-1.42l2.83-2.82L7.3 8.7a1 1 0 0 1 1.42-1.42l2.83 2.83 2.82-2.83a1 1 0 0 1 1.42 1.42l-2.83 2.83 2.83 2.82z"
                            />
                        </svg>
                    </button>
                </div>
            </div>

            <div class="pt-3">
                <div class="flex mb-3 items-center">
                    <h2 class="text-2xl text-indigo-700 font-semibold mr-2">
                        サービス概要
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
                        v-if="description.editable"
                        @click="plusDescription"
                    >
                        決定
                    </button>
                    <button
                        class="
                            bg-indigo-600
                            hover:bg-indigo-400
                            h-8
                            w-12
                            text-white
                            rounded
                        "
                        v-else
                        @click="description.editable = true"
                    >
                        編集
                    </button>
                </div>
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
                        focus:outline-none focus:bg-white focus:border-gray-500
                    "
                    rows="10"
                    placeholder="サービスの説明を入力してください。"
                    v-if="description.editable"
                    v-model="description.content"
                ></textarea>
                <p
                    class="
                        whitespace-pre-line
                        mt-2
                        py-2
                        px-4
                        mb-3
                        text-xl text-gray-700
                        font-bold
                        break-words
                    "
                    v-else
                >
                    {{ description.content }}
                </p>
                <div
                    class="
                        bg-red-100
                        border border-red-400
                        text-red-700
                        px-4
                        py-3
                        rounded
                        mt-2
                    "
                    role="alert"
                    v-if="description.error"
                >
                    <strong class="font-bold"
                        >サービスの概要が入力されていません。</strong
                    >
                </div>
            </div>

            <div class="flex mb-3 items-center">
                <h2 class="text-2xl text-indigo-700 font-semibold mr-2">
                    使用技術
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
                    @click="plusTechFields"
                >
                    追加
                </button>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2">
                <div v-for="(techField, index) in techFields" :key="techField">
                    <div class="bg-blue-200 m-2 rounded p-3">
                        <div class="flex items-center mb-3">
                            <input
                                v-if="techField.techField.editable"
                                :value="techField.techField.content"
                                class="
                                    appearance-none
                                    block
                                    w-4/5
                                    bg-white
                                    text-gray-700
                                    border border-gray-200
                                    rounded
                                    py-2
                                    px-4
                                    mr-2
                                    leading-tight
                                    focus:outline-none
                                    focus:ring-1
                                    focus:ring-blue-500
                                    focus:border-blue-500
                                "
                                placeholder="技術分野を入力してください。"
                                @keyup.enter="plusTechField($event, index)"
                            />
                            <p
                                v-else
                                class="
                                    py-2
                                    px-4
                                    mr-2
                                    font-bold
                                    text-gray-700
                                    w-4/5
                                "
                                @click="techField.techField.editable = true"
                            >
                                {{ techField.techField.content }}
                            </p>
                            <button
                                class="
                                    bg-indigo-600
                                    hover:bg-indigo-400
                                    h-8
                                    w-12
                                    text-white
                                    rounded
                                    mr-3
                                "
                                @click="plusTech(index)"
                            >
                                追加
                            </button>
                            <svg
                                class="h-6 w-6 text-red-600 hover:text-red-400"
                                @click="techFields.splice(index, 1)"
                                width="24"
                                height="24"
                                viewBox="0 0 24 24"
                                stroke-width="2"
                                stroke="currentColor"
                                fill="none"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                            >
                                <path stroke="none" d="M0 0h24v24H0z" />
                                <line x1="18" y1="6" x2="6" y2="18" />
                                <line x1="6" y1="6" x2="18" y2="18" />
                            </svg>
                        </div>
                        <div
                            class="flex mb-2 items-center"
                            v-for="(tech, techIndex) in techField.teches"
                            :key="tech"
                        >
                            <input
                                v-if="tech.tech.editable"
                                class="
                                    appearance-none
                                    block
                                    w-3/5
                                    bg-white
                                    text-gray-700
                                    border border-gray-200
                                    rounded
                                    py-2
                                    px-4
                                    mr-2
                                    leading-tight
                                    focus:outline-none
                                    focus:ring-1
                                    focus:ring-blue-500
                                    focus:border-blue-500
                                "
                                placeholder="技術名"
                                @keyup.enter="
                                    plusTechName($event, index, techIndex)
                                "
                                :value="tech.tech.content"
                            />
                            <p
                                v-else
                                class="py-2 px-4 mr-2 font-bold text-gray-700"
                                @click="tech.tech.editable = true"
                            >
                                {{ tech.tech.content }}
                            </p>
                            <input
                                v-if="tech.version.editable"
                                class="
                                    appearance-none
                                    block
                                    w-2/5
                                    bg-white
                                    text-gray-700
                                    border border-gray-200
                                    rounded
                                    py-2
                                    px-4
                                    mr-2
                                    leading-tight
                                    focus:outline-none
                                    focus:ring-1
                                    focus:ring-blue-500
                                    focus:border-blue-500
                                "
                                placeholder="バージョン"
                                @keyup.enter="
                                    plusTechVersion($event, index, techIndex)
                                "
                                :value="tech.version.content"
                            />
                            <p
                                v-else
                                class="py-2 px-4 mr-2 font-bold text-gray-700"
                                @click="tech.version.editable = true"
                            >
                                {{ tech.version.content }}
                            </p>
                            <svg
                                class="h-6 w-6 text-red-600 hover:text-red-400"
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="2"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                @click="deleteTech(index, techIndex)"
                            >
                                <polyline points="3 6 5 6 21 6" />
                                <path
                                    d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"
                                />
                                <line x1="10" y1="11" x2="10" y2="17" />
                                <line x1="14" y1="11" x2="14" y2="17" />
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex mb-3 items-center">
                <h2 class="text-2xl text-indigo-700 font-semibold mr-2">
                    要件定義
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
                    @click="plusRequirements"
                >
                    追加
                </button>
            </div>
            <div>
                <section class="text-gray-700">
                    <div class="container px-5 py-2">
                        <div class="flex flex-wrap">
                            <div
                                class="w-full"
                                v-for="(requirement, index) in requirements"
                                :key="index"
                            >
                                <input
                                    v-if="requirement.requireTitle.editable"
                                    class="
                                        appearance-none
                                        block
                                        w-full
                                        bg-white
                                        text-gray-700
                                        border border-gray-200
                                        rounded
                                        py-2
                                        px-4
                                        mr-2
                                        leading-tight
                                        focus:outline-none
                                        focus:ring-1
                                        focus:ring-blue-500
                                        focus:border-blue-500
                                    "
                                    placeholder="要件名・機能名を入力してください"
                                    @keyup.enter="
                                        plusRequireTitle($event, index)
                                    "
                                    :value="requirement.requireTitle.content"
                                />
                                <details v-else class="mb-1" open>
                                    <summary
                                        class="
                                            rounded
                                            py-2
                                            px-4
                                            bg-gray-200
                                            relative
                                            h-full
                                        "
                                    >
                                        <span class="font-semibold break-words">
                                            {{
                                                requirement.requireTitle.content
                                            }}
                                        </span>
                                        <svg
                                            class="
                                                h-6
                                                w-6
                                                text-red-600
                                                hover:text-red-400
                                                absolute
                                                top-1
                                                right-1
                                            "
                                            viewBox="0 0 24 24"
                                            fill="none"
                                            stroke="currentColor"
                                            stroke-width="2"
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            @click="
                                                requirements.splice(index, 1)
                                            "
                                        >
                                            <polyline points="3 6 5 6 21 6" />
                                            <path
                                                d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"
                                            />
                                            <line
                                                x1="10"
                                                y1="11"
                                                x2="10"
                                                y2="17"
                                            />
                                            <line
                                                x1="14"
                                                y1="11"
                                                x2="14"
                                                y2="17"
                                            />
                                        </svg>
                                    </summary>

                                    <textarea
                                        v-if="
                                            requirement.requireExplain.editable
                                        "
                                        class="
                                            appearance-none
                                            block
                                            w-full
                                            bg-white
                                            text-gray-700
                                            border border-gray-200
                                            rounded
                                            py-2
                                            px-4
                                            mt-2
                                            mr-2
                                            leading-tight
                                            focus:outline-none
                                            focus:ring-1
                                            focus:ring-blue-500
                                            focus:border-blue-500
                                        "
                                        rows="8"
                                        placeholder="要件・機能の説明を入力してください"
                                        @keyup.enter="
                                            plusRequireExplain($event, index)
                                        "
                                        :value="
                                            requirement.requireExplain.content
                                        "
                                    />

                                    <p
                                        v-else
                                        class="
                                            text-grey-600
                                            font-bold
                                            m-4
                                            whitespace-pre-line
                                            break-words
                                        "
                                        @click="
                                            requirement.requireExplain.editable = true
                                        "
                                    >
                                        {{ requirement.requireExplain.content }}
                                    </p>
                                </details>
                            </div>
                        </div>
                    </div>
                </section>
            </div>

            <div class="flex mb-3 items-center">
                <h2 class="text-2xl text-indigo-700 font-semibold mr-2">
                    URI設計
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
                    @click="plusUris"
                >
                    追加
                </button>
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
                        <div class="px-4 py-3 w-3/12 md:w-2/12">URI</div>
                        <div class="px-4 py-3 w-3/12 md:w-2/12">メソッド</div>
                        <div class="px-4 py-3 w-6/12 md:w-8/12">説明</div>
                    </div>

                    <div
                        class="
                            bg-gray-100
                            border-b border-gray-200
                            flex flex-col-3
                            items-center
                        "
                        v-for="(uri, index) in uris"
                        :key="index"
                    >
                        <div class="px-4 py-3 w-3/12 md:w-2/12">
                            <input
                                v-if="uri.uri.editable"
                                class="
                                    appearance-none
                                    block
                                    w-full
                                    bg-white
                                    text-gray-700
                                    border border-gray-200
                                    rounded
                                    h-10
                                    px-1
                                    leading-tight
                                    focus:outline-none
                                    focus:ring-1
                                    focus:ring-blue-500
                                    focus:border-blue-500
                                "
                                @keyup.enter="plusUri($event, index)"
                                :value="uri.uri.content"
                            />
                            <p v-else @click="uri.uri.editable = true">
                                {{ uri.uri.content }}
                            </p>
                        </div>
                        <div class="px-4 py-3 w-3/12 md:w-2/12">
                            <input
                                v-if="uri.method.editable"
                                class="
                                    appearance-none
                                    block
                                    w-full
                                    bg-white
                                    text-gray-700
                                    border border-gray-200
                                    rounded
                                    h-10
                                    px-1
                                    leading-tight
                                    focus:outline-none
                                    focus:ring-1
                                    focus:ring-blue-500
                                    focus:border-blue-500
                                "
                                @keyup.enter="plusMethod($event, index)"
                                :value="uri.method.content"
                            />
                            <p v-else @click="uri.method.editable = true">
                                {{ uri.method.content }}
                            </p>
                        </div>
                        <div
                            class="
                                px-4
                                py-3
                                w-6/12
                                overflow-x-auto
                                max-h-40
                                sm:max-h-full
                                md:w-8/12
                                flex
                                items-center
                            "
                        >
                            <input
                                v-if="uri.explain.editable"
                                class="
                                    appearance-none
                                    block
                                    w-full
                                    bg-white
                                    text-gray-700
                                    border border-gray-200
                                    rounded
                                    h-10
                                    px-1
                                    mr-2
                                    leading-tight
                                    focus:outline-none
                                    focus:ring-1
                                    focus:ring-blue-500
                                    focus:border-blue-500
                                "
                                @keyup.enter="plusExplain($event, index)"
                                :value="uri.explain.content"
                            />
                            <p v-else @click="uri.explain.editable = true">
                                {{ uri.explain.content }}
                            </p>
                            <svg
                                class="h-6 w-6 text-red-600 hover:text-red-400"
                                @click="uris.splice(index, 1)"
                                width="24"
                                height="24"
                                viewBox="0 0 24 24"
                                stroke-width="2"
                                stroke="currentColor"
                                fill="none"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                            >
                                <path stroke="none" d="M0 0h24v24H0z" />
                                <line x1="18" y1="6" x2="6" y2="18" />
                                <line x1="6" y1="6" x2="18" y2="18" />
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
import AppLayout from "../Layouts/AppLayout.vue";

export default {
    components: {
        AppLayout,
    },
    data: function () {
        return {
            title: {
                editable: true,
                content: "",
                error: false,
            },
            tags: {
                content: [],
                error: "",
            },
            description: {
                editable: true,
                content: "",
                error: false,
            },
            techFields: [
                {
                    techField: {
                        content: "",
                        editable: true,
                        error: "",
                    },
                    teches: [
                        {
                            tech: {
                                content: "",
                                editable: true,
                                error: "",
                            },
                            version: {
                                content: "",
                                editable: true,
                                error: "",
                            },
                        },
                    ],
                },
            ],
            requirements: [
                {
                    requireTitle: {
                        content: "",
                        editable: true,
                        error: false,
                    },
                    requireExplain: {
                        content: "",
                        editable: true,
                        error: false,
                    },
                },
            ],
            uris: [
                {
                    uri: {
                        content: "",
                        editable: true,
                        error: false,
                    },
                    method: {
                        content: "",
                        editable: true,
                        error: false,
                    },
                    explain: {
                        content: "",
                        editable: true,
                        error: false,
                    },
                },
            ],
        };
    },
    methods: {
        plusTitle(e) {
            if (!e.target.value) {
                this.title.content = "";
                this.title.error = true;
            } else {
                this.title.content = e.target.value;
                this.title.editable = false;
                this.title.error = false;
            }
        },
        plusTag(e) {
            if (!e.target.value) {
                this.tags.error = "カテゴリーが入力されていません。";
            } else if (
                // 大小区別せずに比較する
                this.tags.content
                    .map((tag) => tag.toUpperCase())
                    .includes(e.target.value.toUpperCase())
            ) {
                this.tags.error = "既に同じカテゴリーが追加されています。";
            } else {
                this.tags.content.push(e.target.value);
                this.tags.error = false;
                e.target.value = "";
            }
        },
        deleteTag(value) {
            const index = this.tags.content.indexOf(value);
            this.tags.content.splice(index, 1);
        },
        plusDescription() {
            if (!this.description.content.match(/\S/g)) {
                this.description.error = true;
            } else {
                console.log(this.description.content);
                this.description.content.replace(/\n/g, "\\n");
                console.log(this.description.content);
                this.description.editable = false;
                this.description.error = false;
            }
        },
        plusTechFields() {
            this.techFields.push({
                techField: {
                    content: "",
                    editable: true,
                    error: "",
                },
                teches: [
                    {
                        tech: {
                            content: "",
                            editable: true,
                            error: "",
                        },
                        version: {
                            content: "",
                            editable: true,
                            error: "",
                        },
                    },
                ],
            });
        },
        plusTechField(e, index) {
            if (!e.target.value) {
                this.techFields[index].techField.error =
                    "技術分野を入力してください。";
            } else {
                this.techFields[index].techField.content = e.target.value;
                this.techFields[index].techField.editable = false;
            }
        },
        plusTechName(e, index, techIndex) {
            if (!e.target.value) {
                this.techFields[index].teches[techIndex].tech.error =
                    "技術名を入力してください。";
            } else {
                this.techFields[index].teches[techIndex].tech.content =
                    e.target.value;
                this.techFields[index].teches[techIndex].tech.editable = false;
            }
        },
        plusTechVersion(e, index, techIndex) {
            if (!e.target.value) {
                this.techFields[index].teches[techIndex].version.error =
                    "バージョンを入力してください。";
            } else {
                this.techFields[index].teches[techIndex].version.content =
                    e.target.value;
                this.techFields[index].teches[
                    techIndex
                ].version.editable = false;
            }
        },
        plusTech(index) {
            this.techFields[index].teches.push({
                tech: {
                    content: "",
                    editable: true,
                    error: "",
                },
                version: {
                    content: "",
                    editable: true,
                    error: "",
                },
            });
        },
        deleteTech(index, techIndex) {
            this.techFields[index].teches.splice(techIndex, 1);
        },
        plusRequirements() {
            this.requirements.push({
                requireTitle: {
                    content: "",
                    editable: true,
                    error: false,
                },
                requireExplain: {
                    content: "",
                    editable: true,
                    error: false,
                },
            });
        },
        plusRequireTitle(e, index) {
            if (!e.target.value) {
                this.requirements[index].requireTitle.error = true;
            } else {
                this.requirements[index].requireTitle.content = e.target.value;
                this.requirements[index].requireTitle.error = false;
                this.requirements[index].requireTitle.editable = false;
            }
        },
        plusRequireExplain(e, index) {
            if (!e.target.value) {
                this.requirements[index].requireExplain.error = true;
            } else {
                this.requirements[index].requireExplain.content =
                    e.target.value;
                this.requirements[index].requireExplain.error = false;
                this.requirements[index].requireExplain.editable = false;
            }
        },
        plusUris() {
            this.uris.push({
                uri: {
                    content: "",
                    editable: true,
                    error: false,
                },
                method: {
                    content: "",
                    editable: true,
                    error: false,
                },
                explain: {
                    content: "",
                    editable: true,
                    error: false,
                },
            });
        },
        plusUri(e, index) {
            if (!e.target.value) {
                this.uris[index].uri.error = true;
            } else {
                this.uris[index].uri.content = e.target.value;
                this.uris[index].uri.error = false;
                this.uris[index].uri.editable = false;
            }
        },
        plusMethod(e, index) {
            if (!e.target.value) {
                this.uris[index].method.error = true;
            } else {
                this.uris[index].method.content = e.target.value;
                this.uris[index].method.error = false;
                this.uris[index].method.editable = false;
            }
        },
        plusExplain(e, index) {
            if (!e.target.value) {
                this.uris[index].explain.error = true;
            } else {
                this.uris[index].explain.content = e.target.value;
                this.uris[index].explain.error = false;
                this.uris[index].explain.editable = false;
            }
        },
    },
};
</script>
