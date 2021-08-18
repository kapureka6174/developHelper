<template>
    <app-layout>
        <template #header>
            <div class="flex items-center justify-between">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    新規作成画面
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
            <!-- サービス名 -->
            <h1 class="text-2xl text-indigo-700 font-semibold pb-3">
                サービス名
            </h1>
            <input
                v-if="form.title.editable"
                class="w-full rounded"
                type="text"
                placeholder="サービス名を入力してください"
                v-model="form.title.content"
                @keyup.enter="addContent(form.title.content, 'title')"
                v-on:blur="form.title.error = false"
            />
            <p
                v-else
                class="text-2xl font-bold text-gray-700"
                @click="form.title.editable = true"
            >
                {{ form.title.content }}
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
                v-if="form.title.error"
            >
                <strong class="font-bold"
                    >サービス名が入力されていません。</strong
                >
            </div>

            <!-- カテゴリー -->
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
                    v-on:blur="form.tags.error = ''"
                />
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
                    v-if="form.tags.error"
                >
                    <strong class="font-bold">{{ form.tags.error }}</strong>
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
                    v-for="(tag, index) in form.tags.content"
                    :key="index"
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
                        @click="form.tags.content.splice(index, 1)"
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

            <!-- サービスの概要 -->
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
                        v-if="form.description.editable"
                        @click="
                            addContent(form.description.content, 'description')
                        "
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
                        @click="form.description.editable = true"
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
                    v-if="form.description.editable"
                    v-model="form.description.content"
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
                    {{ form.description.content }}
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
                    v-if="form.description.error"
                >
                    <strong class="font-bold"
                        >サービスの概要が入力されていません。</strong
                    >
                </div>
            </div>

            <!-- 使用技術について -->
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
                    @click="addLine('techField', techField())"
                >
                    追加
                </button>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2">
                <div v-for="(techField, index) in form.techFields" :key="index">
                    <div class="bg-blue-200 m-2 rounded p-3">
                        <div class="flex items-center mb-3">
                            <input
                                v-if="form.techFields[index].techField.editable"
                                v-model="
                                    form.techFields[index].techField.content
                                "
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
                                @keyup.enter="
                                    addContent(
                                        form.techFields[index].techField
                                            .content,
                                        'techFields',
                                        index
                                    )
                                "
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
                                @click="
                                    form.techFields[
                                        index
                                    ].techField.editable = true
                                "
                            >
                                {{ form.techFields[index].techField.content }}
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
                                @click="addLine('teches', techField, index)"
                            >
                                追加
                            </button>
                            <svg
                                class="h-6 w-6 text-red-600 hover:text-red-400"
                                @click="form.techFields.splice(index, 1)"
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
                            :key="techIndex"
                        >
                            <input
                                v-if="
                                    form.techFields[index].teches[techIndex]
                                        .tech.editable
                                "
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
                                    addContent(
                                        form.techFields[index].teches[techIndex]
                                            .tech.content,
                                        'tech',
                                        index,
                                        techIndex
                                    )
                                "
                                v-model="
                                    form.techFields[index].teches[techIndex]
                                        .tech.content
                                "
                            />
                            <p
                                v-else
                                class="py-2 px-4 mr-2 font-bold text-gray-700"
                                @click="
                                    form.techFields[index].teches[
                                        techIndex
                                    ].tech.editable = true
                                "
                            >
                                {{
                                    form.techFields[index].teches[techIndex]
                                        .tech.content
                                }}
                            </p>
                            <input
                                v-if="
                                    form.techFields[index].teches[techIndex]
                                        .version.editable
                                "
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
                                    addContent(
                                        form.techFields[index].teches[techIndex]
                                            .version.content,
                                        'version',
                                        index,
                                        techIndex
                                    )
                                "
                                v-model="
                                    form.techFields[index].teches[techIndex]
                                        .version.content
                                "
                            />
                            <p
                                v-else
                                class="py-2 px-4 mr-2 font-bold text-gray-700"
                                @click="
                                    form.techFields[index].teches[
                                        techIndex
                                    ].version.editable = true
                                "
                            >
                                {{
                                    form.techFields[index].teches[techIndex]
                                        .version.content
                                }}
                            </p>
                            <svg
                                class="h-6 w-6 text-red-600 hover:text-red-400"
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="2"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                @click="
                                    form.techFields[index].teches.splice(
                                        techIndex,
                                        1
                                    )
                                "
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

            <!-- 要件定義 -->
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
                    @click="addLine('requirement', requirement())"
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
                                v-for="(
                                    requirement, index
                                ) in form.requirements"
                                :key="index"
                            >
                                <input
                                    v-if="
                                        form.requirements[index].requireTitle
                                            .editable
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
                                        mr-2
                                        leading-tight
                                        focus:outline-none
                                        focus:ring-1
                                        focus:ring-blue-500
                                        focus:border-blue-500
                                    "
                                    placeholder="要件名・機能名を入力してください"
                                    @keyup.enter="
                                        addContent(
                                            form.requirements[index]
                                                .requireTitle.content,
                                            'requireTitle',
                                            index
                                        )
                                    "
                                    v-model="
                                        form.requirements[index].requireTitle
                                            .content
                                    "
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
                                                form.requirements[index]
                                                    .requireTitle.content
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
                                                form.requirements.splice(
                                                    index,
                                                    1
                                                )
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
                                            form.requirements[index]
                                                .requireExplain.editable
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
                                            addContent(
                                                form.requirements[index]
                                                    .requireExplain.content,
                                                'requireExplain',
                                                index
                                            )
                                        "
                                        v-model="
                                            form.requirements[index]
                                                .requireExplain.content
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
                                            form.requirements[
                                                index
                                            ].requireExplain.editable = true
                                        "
                                    >
                                        {{
                                            form.requirements[index]
                                                .requireExplain.content
                                        }}
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
                    @click="addLine('uri', uri())"
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
                        v-for="(uri, index) in form.uris"
                        :key="index"
                    >
                        <div class="px-4 py-3 w-3/12 md:w-2/12">
                            <input
                                v-if="form.uris[index].uri.editable"
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
                                @keyup.enter="
                                    addContent(
                                        form.uris[index].uri.content,
                                        'uri',
                                        index
                                    )
                                "
                                v-model="form.uris[index].uri.content"
                            />
                            <p
                                v-else
                                @click="form.uris[index].uri.editable = true"
                            >
                                {{ form.uris[index].uri.content }}
                            </p>
                        </div>
                        <div class="px-4 py-3 w-3/12 md:w-2/12">
                            <input
                                v-if="form.uris[index].method.editable"
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
                                @keyup.enter="
                                    addContent(
                                        form.uris[index].method.content,
                                        'method',
                                        index
                                    )
                                "
                                v-model="form.uris[index].method.content"
                            />
                            <p
                                v-else
                                @click="form.uris[index].method.editable = true"
                            >
                                {{ form.uris[index].method.content }}
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
                                v-if="form.uris[index].explain.editable"
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
                                @keyup.enter="
                                    addContent(
                                        form.uris[index].explain.content,
                                        'explain',
                                        index
                                    )
                                "
                                v-model="form.uris[index].explain.content"
                            />
                            <p
                                v-else
                                @click="
                                    form.uris[index].explain.editable = true
                                "
                            >
                                {{ form.uris[index].explain.content }}
                            </p>
                            <svg
                                class="h-6 w-6 text-red-600 hover:text-red-400"
                                @click="form.uris.splice(index, 1)"
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
import { reactive } from "vue";
import { Inertia } from "@inertiajs/inertia";

export default {
    components: {
        AppLayout,
    },
    setup() {
        const normalObj = (type) => {
            return {
                content: "",
                editable: true,
                error: type == 1 ? "" : false,
            };
        };

        const techField = () => {
            return {
                techField: normalObj(1),
                teches: [
                    {
                        tech: normalObj(1),
                        version: normalObj(1),
                    },
                ],
            };
        };

        const requirement = () => {
            return {
                requireTitle: normalObj(),
                requireExplain: normalObj(),
            };
        };

        const uri = () => {
            return {
                uri: normalObj(),
                method: normalObj(),
                explain: normalObj(),
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
        });

        // 直接代入型の処理
        const addContent = (value, type, index, techIndex) => {
            if (
                !value ||
                (type === "description" &&
                    !form.description.content.match(/\S/g))
            ) {
                form[type].error = true;
            } else {
                switch (type) {
                    case "title":
                        form[type].error = false;
                        form[type].editable = false;
                        break;

                    case "description":
                        form[type].content.replace(/\n/g, "\\n");
                        form[type].error = false;
                        form[type].editable = false;
                        break;

                    case "techFields":
                        form[type][index].techField.error = false;
                        form[type][index].techField.editable = false;
                        break;

                    case "tech":
                    case "version":
                        form.techFields[index].teches[techIndex][type].error =
                            "";
                        form.techFields[index].teches[techIndex][
                            type
                        ].editable = false;
                        break;

                    case "requireTitle":
                    case "requireExplain":
                        form.requirements[index][type].error = "";
                        form.requirements[index][type].editable = false;
                        break;

                    case "uri":
                    case "method":
                    case "explain":
                        form.uris[index][type].error = "";
                        form.uris[index][type].editable = false;
                        break;
                }
            }
        };

        // タグ（配列に入れ込む）の処理
        const plusTag = (e) => {
            if (!e.target.value) {
                form.tags.error = "カテゴリーが入力されていません。";
            } else if (
                // 大小区別せずに比較する
                form.tags.content
                    .map((tag) => tag.toUpperCase())
                    .includes(e.target.value.toUpperCase())
            ) {
                form.tags.error = "既に同じカテゴリーが追加されています。";
            } else {
                form.tags.content.push(e.target.value);
                form.tags.error = false;
                e.target.value = "";
            }
        };

        // 配列に入れ込む（使用技術、要件定義、URI設計）
        const addLine = (type, obj, index) => {
            index === undefined
                ? form[`${type}s`].push(obj)
                : form.techFields[index].teches.push({
                      tech: normalObj(1),
                      version: normalObj(1),
                  });
        };

        // DBへ保存
        const submit = () => {
            Inertia.post("/create", form);
        };

        return {
            form,
            techField,
            requirement,
            uri,
            addContent,
            addLine,
            plusTag,
            submit,
        };
    },
};
</script>
