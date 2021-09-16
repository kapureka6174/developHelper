<template>
    <div>
        <app-layout>
            <template #header>
                <div class="flex items-center justify-between">
                    <h2
                        class="
                            font-semibold
                            text-xl text-gray-800
                            leading-tight
                        "
                    >
                        サービス編集画面
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
                        @click="edit"
                    >
                        保存
                    </button>
                </div>
            </template>

            <div class="py-10 px-4">
                <div v-if="$page.props.flash.fail" class="alert">
                    <div class="fixed top-0 right-0 m-6">
                        <div
                            class="
                                rounded-lg
                                shadow-md
                                p-6
                                pr-10
                                bg-red-200
                                text-red-900
                            "
                            style="min-width: 240px"
                        >
                            <button
                                class="
                                    opacity-75
                                    cursor-pointer
                                    absolute
                                    top-0
                                    right-0
                                    py-2
                                    px-3
                                    hover:opacity-100
                                "
                                @click.prevent="$page.props.flash.fail = null"
                            >
                                ×
                            </button>
                            <div class="flex items-center">
                                {{ $page.props.flash.fail }}
                            </div>
                        </div>
                    </div>
                </div>
                <!-- サービス名 -->
                <h1 class="text-2xl text-indigo-700 font-semibold pb-3">
                    サービス名
                </h1>
                <input
                    v-if="!form.title.decidable"
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
                    @click="form.title.decidable = false"
                >
                    {{ form.title.content }}
                </p>

                <!-- エラー表示（サーバーサイド） -->
                <div v-if="Object.keys($page.props.errors).length">
                    <div
                        v-for="(error, index) in Object.entries(
                            $page.props.errors
                        ).filter((e) => {
                            return /title/.test(e[0]);
                        })"
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
                            {{ error[1] }}
                        </p>
                    </div>
                </div>
                <!-- エラー表示（クライアントサイド） -->
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
                    <!-- エラー表示（サーバーサイド） -->
                    <div v-if="Object.keys($page.props.errors).length">
                        <div
                            v-for="(error, index) in Object.entries(
                                $page.props.errors
                            ).filter((e) => {
                                return /tags/.test(e[0]);
                            })"
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
                                {{ error[1] }}
                            </p>
                        </div>
                    </div>
                    <!-- エラー表示（クライアントサイド） -->
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
                            class="
                                ml-2
                                mr-1
                                leading-relaxed
                                truncate
                                max-w-xs
                                px-1
                            "
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
                            v-if="!form.description.decidable"
                            @click="
                                addContent(
                                    form.description.content,
                                    'description'
                                )
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
                            @click="form.description.decidable = false"
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
                            focus:outline-none
                            focus:bg-white
                            focus:border-gray-500
                        "
                        rows="10"
                        placeholder="サービスの説明を入力してください。"
                        v-if="!form.description.decidable"
                        v-model="form.description.content"
                    ></textarea>
                    <p
                        class="
                            whitespace-pre-line
                            mt-2
                            py-2
                            px-4
                            mb-3
                            text-xl text-gray-600
                            break-words
                        "
                        v-else
                    >
                        {{ form.description.content }}
                    </p>
                    <!-- エラー表示（サーバーサイド） -->
                    <div v-if="Object.keys($page.props.errors).length">
                        <div
                            v-for="(error, index) in Object.entries(
                                $page.props.errors
                            ).filter((e) => {
                                return /description/.test(e[0]);
                            })"
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
                                {{ error[1] }}
                            </p>
                        </div>
                    </div>
                    <!-- エラー表示（クライアントサイド） -->
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
                    <div
                        v-for="(techField, index) in form.techFields"
                        :key="index"
                    >
                        <div class="bg-blue-200 m-2 rounded p-3">
                            <div class="flex items-center mb-3">
                                <input
                                    v-if="
                                        !form.techFields[index].techField
                                            .decidable
                                    "
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
                                        ].techField.decidable = false
                                    "
                                >
                                    {{
                                        form.techFields[index].techField.content
                                    }}
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
                                    class="
                                        h-6
                                        w-6
                                        text-red-600
                                        hover:text-red-400
                                    "
                                    @click="spliceArray('techField', index)"
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
                                        !form.techFields[index].teches[
                                            techIndex
                                        ].tech.decidable
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
                                            form.techFields[index].teches[
                                                techIndex
                                            ].tech.content,
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
                                    class="
                                        py-2
                                        px-4
                                        mr-2
                                        font-bold
                                        text-gray-700
                                    "
                                    @click="
                                        form.techFields[index].teches[
                                            techIndex
                                        ].tech.decidable = false
                                    "
                                >
                                    {{
                                        form.techFields[index].teches[techIndex]
                                            .tech.content
                                    }}
                                </p>
                                <input
                                    v-if="
                                        !form.techFields[index].teches[
                                            techIndex
                                        ].version.decidable
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
                                            form.techFields[index].teches[
                                                techIndex
                                            ].version.content,
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
                                    class="
                                        py-2
                                        px-4
                                        mr-2
                                        font-bold
                                        text-gray-700
                                    "
                                    @click="
                                        form.techFields[index].teches[
                                            techIndex
                                        ].version.decidable = false
                                    "
                                >
                                    {{
                                        form.techFields[index].teches[techIndex]
                                            .version.content
                                    }}
                                </p>
                                <svg
                                    class="
                                        h-6
                                        w-6
                                        text-red-600
                                        hover:text-red-400
                                    "
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="2"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    @click="
                                        spliceArray('tech', index, techIndex)
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

                        <!-- エラー表示（サーバーサイド） -->
                        <div v-if="Object.keys($page.props.errors).length">
                            <div
                                v-for="(error, errorIndex) in Object.entries(
                                    $page.props.errors
                                ).filter((e) => {
                                    return e[0].split('.')[0] == 'techFields' &&
                                        e[0].split('.')[1] == `${index}`
                                        ? true
                                        : false;
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
                                            !form.requirements[index]
                                                .requireTitle.decidable
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
                                            form.requirements[index]
                                                .requireTitle.content
                                        "
                                    />
                                    <details v-else class="mb-1">
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
                                            <span
                                                class="
                                                    font-semibold
                                                    break-words
                                                "
                                                @click="
                                                    form.requirements[
                                                        index
                                                    ].requireTitle.decidable = false
                                                "
                                            >
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
                                                    spliceArray(
                                                        'requirement',
                                                        index
                                                    )
                                                "
                                            >
                                                <polyline
                                                    points="3 6 5 6 21 6"
                                                />
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

                                        <div
                                            v-if="
                                                !form.requirements[index]
                                                    .requireExplain.decidable
                                            "
                                            class="flex flex-col items-end"
                                        >
                                            <textarea
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
                                                    leading-tight
                                                    focus:outline-none
                                                    focus:ring-1
                                                    focus:ring-blue-500
                                                    focus:border-blue-500
                                                "
                                                rows="8"
                                                placeholder="要件・機能の説明を入力してください"
                                                v-model="
                                                    form.requirements[index]
                                                        .requireExplain.content
                                                "
                                            />
                                            <button
                                                class="
                                                    bg-indigo-600
                                                    hover:bg-indigo-400
                                                    h-8
                                                    w-12
                                                    text-white
                                                    rounded
                                                    m-2
                                                "
                                                @click="
                                                    addContent(
                                                        form.requirements[index]
                                                            .requireExplain
                                                            .content,
                                                        'requireExplain',
                                                        index
                                                    )
                                                "
                                            >
                                                決定
                                            </button>
                                        </div>

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
                                                ].requireExplain.decidable = false
                                            "
                                        >
                                            {{
                                                form.requirements[index]
                                                    .requireExplain.content
                                            }}
                                        </p>
                                    </details>
                                    <!-- エラー表示（サーバーサイド） -->
                                    <div
                                        v-if="
                                            Object.keys($page.props.errors)
                                                .length
                                        "
                                    >
                                        <div
                                            v-for="(
                                                error, errorIndex
                                            ) in Object.entries(
                                                $page.props.errors
                                            ).filter((e) => {
                                                return e[0].split('.')[0] ==
                                                    'requirements' &&
                                                    e[0].split('.')[1] ==
                                                        `${index}`
                                                    ? true
                                                    : false;
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
                            </div>
                        </div>
                    </section>
                </div>

                <!-- ページ -->
                <h1 class="text-2xl text-indigo-700 font-semibold">ページ</h1>
                <div
                    v-for="(requirement, index) in form.requirements"
                    :key="index"
                >
                    <div
                        v-if="form.requirements[index].requireTitle.decidable"
                        class="
                            w-4/5
                            bg-gray-200
                            flex
                            items-center
                            rounded-md
                            py-3
                            my-1
                            mx-auto
                        "
                    >
                        <input
                            type="checkbox"
                            class="
                                form-checkbox
                                h-5
                                w-5
                                text-green-600
                                rounded
                                mx-2
                            "
                            v-model="
                                form.requirements[index].requireTitle.selected
                            "
                        />
                        <p class="font-bold text-gray-600 w-4/5">
                            {{ form.requirements[index].requireTitle.content }}
                        </p>
                    </div>
                </div>

                <div class="w-full text-center">
                    <button
                        class="
                            bg-indigo-600
                            hover:bg-indigo-400
                            h-10
                            w-28
                            text-white
                            rounded
                        "
                        @click="addLine('page', page())"
                    >
                        ページを追加
                    </button>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 justify-between">
                    <div v-for="(page, index) in form.pages" :key="index">
                        <div class="bg-blue-400 rounded m-3 pb-3">
                            <div class="flex items-center">
                                <input
                                    v-if="!form.pages[index].pagename.decidable"
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
                                        my-2
                                        mx-auto
                                        leading-tight
                                        focus:outline-none
                                        focus:ring-1
                                        focus:ring-blue-500
                                        focus:border-blue-500
                                    "
                                    v-model="form.pages[index].pagename.content"
                                    type="text"
                                    @keyup.enter="
                                        addContent(
                                            form.pages[index].pagename.content,
                                            'pagename',
                                            index
                                        )
                                    "
                                />
                                <h1
                                    v-else
                                    class="
                                        text-white text-xl
                                        font-semibold
                                        my-2
                                        py-2
                                        px-4
                                        mx-auto
                                        w-4/5
                                        text-center
                                    "
                                    @click="
                                        form.pages[
                                            index
                                        ].pagename.decidable = false
                                    "
                                >
                                    {{ form.pages[index].pagename.content }}
                                </h1>
                                <svg
                                    class="
                                        h-6
                                        w-6
                                        text-red-600
                                        hover:text-red-400
                                        mr-3
                                    "
                                    @click="spliceArray('page', index)"
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
                            <div class="w-full text-center mb-3">
                                <button
                                    class="
                                        bg-indigo-600
                                        hover:bg-indigo-400
                                        h-10
                                        w-40
                                        text-white
                                        rounded
                                    "
                                    @click="addSelectedRequirement(index)"
                                >
                                    選択中の機能を追加
                                </button>
                            </div>
                            <div
                                v-for="(
                                    requirement, requirementIndex
                                ) in page.requirements"
                                :key="requirementIndex"
                                class="
                                    w-full
                                    flex
                                    items-center
                                    justify-around
                                    mb-3
                                "
                            >
                                <p
                                    class="
                                        font-bold
                                        text-gray-600
                                        bg-gray-200
                                        rounded-md
                                        py-2
                                        px-4
                                        w-4/5
                                        mx-3
                                        text-center
                                    "
                                >
                                    {{
                                        form.pages[index].requirements[
                                            requirementIndex
                                        ].content
                                    }}
                                </p>
                                <svg
                                    class="
                                        h-6
                                        w-6
                                        text-red-600
                                        my-2
                                        mr-4
                                        hover:text-red-400
                                    "
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="2"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    @click="
                                        spliceArray(
                                            'pageRequirement',
                                            index,
                                            requirementIndex
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
                        <!-- エラー表示（サーバーサイド） -->
                        <div v-if="Object.keys($page.props.errors).length">
                            <div
                                v-for="(error, errorIndex) in Object.entries(
                                    $page.props.errors
                                ).filter((e) => {
                                    return e[0].split('.')[0] == 'pages' &&
                                        e[0].split('.')[1] == `${index}`
                                        ? true
                                        : false;
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
                </div>

                <div class="flex mb-3 items-center">
                    <h2
                        class="text-2xl text-indigo-700 font-semibold mr-2 my-4"
                    >
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
                <div class="overflow-x-auto">
                    <div
                        class="
                            rounded-t-lg
                            m-5
                            mx-auto
                            bg-gray-200
                            text-gray-800
                        "
                    >
                        <div
                            class="
                                text-left
                                border-b-2 border-gray-300
                                flex flex-col-3
                                items-center
                            "
                        >
                            <div class="px-4 py-3 w-3/12 md:w-2/12">URI</div>
                            <div class="px-4 py-3 w-3/12 md:w-2/12">
                                メソッド
                            </div>
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
                                    v-if="!form.uris[index].uri.decidable"
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
                                    @click="
                                        form.uris[index].uri.decidable = false
                                    "
                                >
                                    {{ form.uris[index].uri.content }}
                                </p>
                            </div>
                            <div class="px-4 py-3 w-3/12 md:w-2/12">
                                <input
                                    v-if="!form.uris[index].method.decidable"
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
                                    @click="
                                        form.uris[
                                            index
                                        ].method.decidable = false
                                    "
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
                                    v-if="!form.uris[index].explain.decidable"
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
                                        form.uris[
                                            index
                                        ].explain.decidable = false
                                    "
                                >
                                    {{ form.uris[index].explain.content }}
                                </p>
                                <svg
                                    class="
                                        h-6
                                        w-6
                                        text-red-600
                                        hover:text-red-400
                                    "
                                    @click="spliceArray('uri', index)"
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
    </div>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout";
import { reactive } from "vue";
import { Inertia } from "@inertiajs/inertia";

export default {
    components: {
        AppLayout,
    },
    props: {
        service: Object,
        techFields: Array,
        requirements: Array,
        pages: Array,
        uris: Array,
    },
    setup(props) {
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
                requireTitle: normalObj(2),
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

        const page = () => {
            return {
                pagename: normalObj(),
                requirements: [],
            };
        };

        const form = reactive({
            id: props.service.id,
            title: {
                content: props.service.title,
                decidable: true,
            },
            description: {
                content: props.service.description,
                decidable: true,
            },
            tags: {
                content: props.service.tags.map((tag) => tag.tagname),
                error: "",
            },
            techFields: [],
            requirements: [],
            uris: [],
            pages: [page()],
            deleteData: {
                techFields: [],
                requirements: [],
                uris: [],
                pages: [],
                teches: [],
                pageRequirements: [],
            },
        });

        // 既に存在しているデータの追加
        form.techFields = props.techFields.map((field) => {
            return {
                techField: {
                    id: field.id,
                    content: field.fieldname,
                    decidable: true,
                    error: "",
                },
                teches: field.teches.map((tech) => {
                    return {
                        id: tech.id,
                        tech: {
                            content: tech.techname,
                            decidable: true,
                            error: "",
                        },
                        version: {
                            content: tech.version,
                            decidable: true,
                            error: "",
                        },
                    };
                }),
            };
        });

        form.requirements = props.requirements.map((requirement) => {
            return {
                id: requirement.id,
                requireTitle: {
                    content: requirement.title,
                    decidable: true,
                    error: "",
                },
                requireExplain: {
                    content: requirement.content,
                    decidable: true,
                    error: "",
                },
            };
        });

        form.uris = props.uris.map((uri) => {
            return {
                id: uri.id,
                uri: {
                    content: uri.uri,
                    decidable: true,
                    error: "",
                },
                method: {
                    content: uri.method,
                    decidable: true,
                    error: "",
                },
                explain: {
                    content: uri.explain,
                    decidable: true,
                    error: "",
                },
            };
        });

        form.pages = props.pages.map((page) => {
            return {
                id: page.id,
                pagename: {
                    content: page.pagename,
                    decidable: true,
                    error: "",
                },
                requirements: page.requirements.map((requirement) => {
                    return {
                        id: requirement.id,
                        content: requirement.title,
                    };
                }),
            };
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
                        form[type].decidable = true;
                        break;

                    case "description":
                        form[type].content.replace(/\n/g, "\\n");
                        form[type].error = false;
                        form[type].decidable = true;
                        break;

                    case "techFields":
                        form[type][index].techField.error = false;
                        form[type][index].techField.decidable = true;
                        break;

                    case "tech":
                    case "version":
                        form.techFields[index].teches[techIndex][type].error =
                            "";
                        form.techFields[index].teches[techIndex][
                            type
                        ].decidable = true;
                        break;

                    case "requireTitle":
                    case "requireExplain":
                        form.requirements[index][type].error = "";
                        form.requirements[index][type].decidable = true;
                        break;

                    case "uri":
                    case "method":
                    case "explain":
                        form.uris[index][type].error = "";
                        form.uris[index][type].decidable = true;
                        break;

                    case "pagename":
                        form.pages[index][type].error = "";
                        form.pages[index][type].decidable = true;
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

        // 選択されている機能をページに追加
        const addSelectedRequirement = (pageIndex) => {
            const selectedArray = form.requirements.filter(
                (requirement) => requirement.requireTitle.selected == true
            );
            selectedArray.forEach((requirement) => {
                if (
                    !form.pages[pageIndex].requirements
                        .map((requirement) => requirement.content)
                        .includes(requirement.requireTitle.content)
                ) {
                    form.pages[pageIndex].requirements.push({
                        content: requirement.requireTitle.content,
                    });
                }
            });
        };

        const spliceArray = (type, index, detailIndex) => {
            switch (type) {
                case "techField": {
                    let deleteData = form[`${type}s`].splice(index, 1)[0];
                    console.log(deleteData);
                    if (deleteData[type].id) {
                        form.deleteData.techFields.push(deleteData[type].id);
                    }
                    break;
                }

                case "requirement": {
                    let deleteData = form[`${type}s`].splice(index, 1)[0];
                    if (deleteData) {
                        form.deleteData[`${type}s`].push(deleteData.id);
                    }
                    form.pages.forEach((page, index) => {
                        page.requirements.forEach(
                            (requirement, requireIndex) => {
                                console.log(page, requirement);
                                if (requirement.id == deleteData.id) {
                                    form.pages[index].requirements.splice(
                                        requireIndex,
                                        1
                                    );
                                }
                            }
                        );
                    });
                    break;
                }

                case "uri":
                case "page": {
                    let deleteData = form[`${type}s`].splice(index, 1)[0];
                    if (deleteData) {
                        form.deleteData[`${type}s`].push(deleteData.id);
                    }
                    break;
                }

                case "tech": {
                    let deleteData = form.techFields[index].teches.splice(
                        detailIndex,
                        1
                    )[0];
                    if (deleteData.id) {
                        form.deleteData.teches.push(deleteData.id);
                    }
                    break;
                }

                case "pageRequirement": {
                    let deleteData = form.pages[index].requirements.splice(
                        detailIndex,
                        1
                    )[0];
                    if (deleteData.id) {
                        form.deleteData.pageRequirements.push({
                            page_id: form.pages[index].id,
                            id: deleteData.id,
                        });
                    }
                    break;
                }
            }
        };

        // DBへ保存
        const edit = () => {
            Inertia.put("/edit", form);
        };

        return {
            form,
            techField,
            requirement,
            page,
            uri,
            addContent,
            addLine,
            plusTag,
            addSelectedRequirement,
            edit,
            spliceArray,
        };
    },
};
</script>
