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
                        <button
                            v-if="
                                $page.props.user !== null &&
                                $page.props.user.id == service.user_id
                            "
                            class="
                                bg-indigo-600
                                hover:bg-indigo-400
                                h-8
                                w-12
                                text-white
                                rounded
                                mr-3
                            "
                            @click="edit"
                        >
                            <inertia-link
                                :href="route('Edit', { id: service.id })"
                            >
                                編集
                            </inertia-link>
                        </button>
                        <button
                            v-if="
                                $page.props.user !== null &&
                                $page.props.user.id == service.user_id
                            "
                            class="
                                bg-red-600
                                hover:bg-red-400
                                h-8
                                w-12
                                text-white
                                rounded
                            "
                            @click="check"
                        >
                            削除
                        </button>
                    </div>
                </div>
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
                <h1 class="text-3xl font-extrabold pb-3">
                    {{ service.title }}
                </h1>
                <div
                    v-for="tag in service.tags"
                    :key="tag.id"
                    class="
                        text-xs
                        inline-flex
                        items-center
                        font-bold
                        leading-sm
                        uppercase
                        px-3
                        py-1
                        bg-blue-200
                        text-blue-700
                        rounded-full
                        mx-2
                    "
                >
                    {{ tag.tagname }}
                </div>
                <div class="pt-3">
                    <h2 class="text-2xl text-indigo-700 font-semibold">
                        サービス概要
                    </h2>
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
                    >
                        {{ service.description }}
                    </p>
                </div>

                <h1 class="text-2xl text-indigo-700 font-semibold">使用技術</h1>
                <div class="grid grid-cols-1 md:grid-cols-2">
                    <div
                        v-for="techField in techFields"
                        :key="techField.id"
                        class="bg-blue-200 m-2 rounded p-3"
                    >
                        <div>
                            <h3 class="text-2xl text-gray-600 font-bold pb-1">
                                {{ techField.fieldname }}
                            </h3>
                            <div
                                v-for="tech in techField.teches"
                                :key="tech.id"
                                class="grid grid-cols-2"
                            >
                                <p
                                    class="
                                        text-xl text-indigo-600
                                        font-semibold
                                    "
                                >
                                    {{ tech.techname }}
                                </p>
                                <p
                                    class="
                                        text-xl text-indigo-600
                                        font-semibold
                                    "
                                >
                                    {{ tech.version }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <h1 class="text-2xl text-indigo-700 font-semibold">要件定義</h1>
                <div>
                    <div class="container px-5 py-2">
                        <div class="flex flex-wrap">
                            <details
                                v-for="requirement in requirements"
                                :key="requirement.id"
                                class="mb-1 w-full"
                            >
                                <summary
                                    v-if="requirement.finished == 1"
                                    class="
                                        font-semibold
                                        bg-blue-200
                                        rounded-md
                                        py-2
                                        px-4
                                    "
                                >
                                    {{ requirement.title }}
                                </summary>
                                <summary
                                    v-else
                                    class="
                                        font-semibold
                                        bg-red-200
                                        rounded-md
                                        py-2
                                        px-4
                                    "
                                >
                                    {{ requirement.title }}
                                </summary>

                                <p
                                    class="
                                        text-grey-600
                                        font-bold
                                        p-4
                                        rounded-md
                                        bg-gray-100
                                        border-2 border-white
                                    "
                                >
                                    {{ requirement.content }}
                                </p>
                            </details>
                        </div>
                    </div>
                </div>

                <h1 class="text-2xl text-indigo-700 font-semibold">ページ</h1>
                <div class="grid grid-cols-1 md:grid-cols-3 justify-between">
                    <div
                        v-for="page in pages"
                        :key="page.id"
                        class="bg-blue-400 rounded m-3"
                    >
                        <h1
                            class="
                                text-white text-xl
                                font-semibold
                                my-3
                                mx-auto
                                w-4/5
                                text-center
                            "
                        >
                            {{ page.pagename }}
                        </h1>
                        <div
                            v-for="requirement in page.requirements"
                            :key="requirement.id"
                            class="w-full"
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
                                    mx-auto
                                    mb-4
                                    text-center
                                "
                            >
                                {{ requirement.title }}
                            </p>
                        </div>
                    </div>
                </div>

                <h1 class="text-2xl text-indigo-700 font-semibold">URI設計</h1>
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
                            <div class="px-4 py-3 w-20 md:w-2/12 text-center">
                                URI
                            </div>
                            <div class="px-4 py-3 w-20 md:w-2/12 text-center">
                                メソッド
                            </div>
                            <div class="px-4 py-3 md:w-8/12 text-center">
                                説明
                            </div>
                        </div>

                        <div
                            class="
                                bg-gray-100
                                border-b border-gray-200
                                flex flex-nowrap
                                items-center
                                overflow-x-auto
                                max-h-40
                                w-full
                            "
                            v-for="uri in uris"
                            :key="uri.id"
                        >
                            <div
                                class="
                                    flex-none
                                    px-4
                                    py-3
                                    w-20
                                    md:w-2/12
                                    break-words
                                    text-center
                                "
                            >
                                {{ uri.uri }}
                            </div>
                            <div
                                class="
                                    flex-none
                                    px-4
                                    py-3
                                    w-20
                                    md:w-2/12
                                    break-words
                                    text-center
                                "
                            >
                                {{ uri.method }}
                            </div>
                            <div
                                class="
                                    flex-none
                                    px-4
                                    py-3
                                    w-96
                                    md:w-8/12
                                    text-center
                                "
                            >
                                {{ uri.explain }}
                            </div>
                        </div>
                    </div>
                </div>

                <div>
                    <div class="flex items-center mb-2">
                        <h1 class="text-2xl text-indigo-700 font-semibold mr-3">
                            タスク
                        </h1>
                        <!-- タスクの保存ボタン -->
                        <button
                            v-if="
                                $page.props.user !== null &&
                                $page.props.user.id == service.user_id
                            "
                            class="
                                bg-indigo-600
                                hover:bg-indigo-400
                                h-8
                                w-12
                                text-white
                                rounded
                            "
                            @click="taskSubmit"
                        >
                            保存
                        </button>
                    </div>

                    <div v-if="$page.props.flash.success" class="alert">
                        <div class="fixed top-0 right-0 m-6">
                            <div
                                class="
                                    rounded-lg
                                    shadow-md
                                    p-6
                                    pr-10
                                    bg-green-200
                                    text-green-900
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
                                    @click.prevent="
                                        $page.props.flash.success = null
                                    "
                                >
                                    ×
                                </button>
                                <div class="flex items-center">
                                    {{ $page.props.flash.success }}
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- エラー表示 -->
                    <div v-if="$page.props.errors.tasks">
                        <div
                            v-for="(error, index) in Object.values(
                                $page.props.errors.tasks
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

                    <!-- 通常表示 -->
                    <div
                        v-if="$page.props.user == null"
                        class="grid grid-cols-1 md:grid-cols-3 gap-4"
                    >
                        <div class="w-full bg-gray-100 rounded p-6">
                            <h2
                                class="
                                    text-gray-700
                                    font-bold
                                    text-2xl
                                    my-1
                                    w-4/5
                                    text-center
                                "
                            >
                                やるべきこと
                            </h2>
                            <div
                                v-for="task in tasks.filter(
                                    (e) => e.state == 'やるべきこと'
                                )"
                                :key="task.id"
                                class="my-2"
                            >
                                <p
                                    class="
                                        text-gray-600
                                        font-semibold
                                        mx-auto
                                        py-3
                                        w-4/5
                                        bg-blue-200
                                        rounded
                                        text-center
                                    "
                                >
                                    {{ task.taskname }}
                                </p>
                            </div>
                        </div>
                        <div class="w-full bg-gray-100 rounded p-6">
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
                                開発中
                            </h2>
                            <div
                                v-for="task in tasks.filter(
                                    (e) => e.state == '開発中'
                                )"
                                :key="task.id"
                                class="my-2"
                            >
                                <p
                                    class="
                                        text-gray-600
                                        font-semibold
                                        mx-auto
                                        py-3
                                        w-4/5
                                        bg-blue-200
                                        rounded
                                        text-center
                                    "
                                >
                                    {{ task.taskname }}
                                </p>
                            </div>
                        </div>
                        <div class="w-full bg-gray-100 rounded p-6">
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
                                完了
                            </h2>
                            <div
                                v-for="task in tasks.filter(
                                    (e) => e.state == '完了'
                                )"
                                :key="task.id"
                                class="my-2"
                            >
                                <p
                                    class="
                                        text-gray-600
                                        font-semibold
                                        mx-auto
                                        py-3
                                        w-4/5
                                        bg-blue-200
                                        rounded
                                        text-center
                                    "
                                >
                                    {{ task.taskname }}
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- 編集表示 -->
                    <div
                        v-else-if="$page.props.user.id == service.user_id"
                        class="grid grid-cols-1 md:grid-cols-3 gap-4"
                    >
                        <div class="w-full bg-gray-100 rounded p-6">
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
                                    やるべきこと
                                </h2>
                                <svg
                                    class="
                                        h-8
                                        w-8
                                        text-blue-500
                                        hover:text-blue-300
                                    "
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor"
                                    @click="
                                        form.tasks.push({
                                            taskname: '',
                                            state: 'やるべきこと',
                                            decidable: false,
                                            isDelete: false,
                                        })
                                    "
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M12 4v16m8-8H4"
                                    />
                                </svg>
                            </div>
                            <div
                                v-for="task in getArray('やるべきこと')"
                                :key="task.index"
                                class="my-2 flex items-center"
                            >
                                <input
                                    v-if="!form.tasks[task.index].decidable"
                                    type="text"
                                    v-model="form.tasks[task.index].taskname"
                                    @keyup.enter="
                                        addContent($event, task.index)
                                    "
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
                                        w-4/5
                                        rounded
                                        text-center
                                        flex
                                        items-center
                                        px-4
                                        py-3
                                        justify-between
                                    "
                                >
                                    <p
                                        class="text-gray-600 font-semibold"
                                        @click="
                                            form.tasks[
                                                task.index
                                            ].decidable = false
                                        "
                                    >
                                        {{ form.tasks[task.index].taskname }}
                                    </p>
                                    <svg
                                        class="
                                            h-8
                                            w-8
                                            text-blue-500
                                            flex-shrink-0
                                            hover:text-blue-300
                                        "
                                        width="24"
                                        height="24"
                                        viewBox="0 0 24 24"
                                        stroke-width="2"
                                        stroke="currentColor"
                                        fill="none"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        @click="
                                            form.tasks[task.index].state =
                                                '開発中'
                                        "
                                    >
                                        <path stroke="none" d="M0 0h24v24H0z" />
                                        <polyline points="9 6 15 12 9 18" />
                                    </svg>
                                </div>
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
                                        form.tasks[task.index].isDelete = true
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
                        <div class="w-full bg-gray-100 rounded p-6">
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
                                    開発中
                                </h2>
                                <svg
                                    class="
                                        h-8
                                        w-8
                                        text-blue-500
                                        hover:text-blue-300
                                    "
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor"
                                    @click="
                                        form.tasks.push({
                                            taskname: '',
                                            state: '開発中',
                                            decidable: false,
                                            isDelete: false,
                                        })
                                    "
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M12 4v16m8-8H4"
                                    />
                                </svg>
                            </div>
                            <div
                                v-for="task in getArray('開発中')"
                                :key="task.index"
                                class="my-2 flex items-center"
                            >
                                <input
                                    v-if="!form.tasks[task.index].decidable"
                                    type="text"
                                    v-model="form.tasks[task.index].taskname"
                                    @keyup.enter="
                                        addContent($event, task.index)
                                    "
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
                                        w-4/5
                                        rounded
                                        text-center
                                        flex
                                        items-center
                                        px-4
                                        py-3
                                        justify-between
                                    "
                                >
                                    <svg
                                        class="
                                            h-8
                                            w-8
                                            text-blue-500
                                            flex-shrink-0
                                            hover:text-blue-300
                                        "
                                        width="24"
                                        height="24"
                                        viewBox="0 0 24 24"
                                        stroke-width="2"
                                        stroke="currentColor"
                                        fill="none"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        @click="
                                            form.tasks[task.index].state =
                                                'やるべきこと'
                                        "
                                    >
                                        <path stroke="none" d="M0 0h24v24H0z" />
                                        <polyline points="15 6 9 12 15 18" />
                                    </svg>
                                    <p
                                        class="text-gray-600 font-semibold"
                                        @click="
                                            form.tasks[
                                                task.index
                                            ].decidable = false
                                        "
                                    >
                                        {{ form.tasks[task.index].taskname }}
                                    </p>
                                    <svg
                                        class="
                                            h-8
                                            w-8
                                            text-blue-500
                                            flex-shrink-0
                                            hover:text-blue-300
                                        "
                                        width="24"
                                        height="24"
                                        viewBox="0 0 24 24"
                                        stroke-width="2"
                                        stroke="currentColor"
                                        fill="none"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        @click="
                                            form.tasks[task.index].state =
                                                '完了'
                                        "
                                    >
                                        <path stroke="none" d="M0 0h24v24H0z" />
                                        <polyline points="9 6 15 12 9 18" />
                                    </svg>
                                </div>
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
                                        form.tasks[task.index].isDelete = true
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
                        <div class="w-full bg-gray-100 rounded p-6">
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
                                    完了
                                </h2>
                                <svg
                                    class="
                                        h-8
                                        w-8
                                        text-blue-500
                                        hover:text-blue-300
                                    "
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor"
                                    @click="
                                        form.tasks.push({
                                            taskname: '',
                                            state: '完了',
                                            decidable: false,
                                            isDelete: false,
                                        })
                                    "
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M12 4v16m8-8H4"
                                    />
                                </svg>
                            </div>
                            <div
                                v-for="task in getArray('完了')"
                                :key="task.index"
                                class="my-2 flex items-center"
                            >
                                <input
                                    v-if="!form.tasks[task.index].decidable"
                                    type="text"
                                    v-model="form.tasks[task.index].taskname"
                                    @keyup.enter="
                                        addContent($event, task.index)
                                    "
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
                                        w-4/5
                                        rounded
                                        text-center
                                        flex
                                        items-center
                                        px-4
                                        py-3
                                        justify-between
                                    "
                                >
                                    <svg
                                        class="
                                            h-8
                                            w-8
                                            text-blue-500
                                            flex-shrink-0
                                            hover:text-blue-300
                                        "
                                        width="24"
                                        height="24"
                                        viewBox="0 0 24 24"
                                        stroke-width="2"
                                        stroke="currentColor"
                                        fill="none"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        @click="
                                            form.tasks[task.index].state =
                                                '開発中'
                                        "
                                    >
                                        <path stroke="none" d="M0 0h24v24H0z" />
                                        <polyline points="15 6 9 12 15 18" />
                                    </svg>
                                    <p
                                        class="text-gray-600 font-semibold"
                                        @click="
                                            form.tasks[
                                                task.index
                                            ].decidable = false
                                        "
                                    >
                                        {{ form.tasks[task.index].taskname }}
                                    </p>
                                </div>
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
                                        form.tasks[task.index].isDelete = true
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

                <div class="w-full bg-gray-100 p-4 flex flex-col">
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
            />
        </service-detail-layout>
    </div>
</template>

<script>
import ServiceDetailLayout from "../Layouts/ServiceDetailLayout.vue";
import FloatButtons from "../components/FloatButtons.vue";
import { Inertia } from "@inertiajs/inertia";
import { useForm } from "@inertiajs/inertia-vue3";

export default {
    components: {
        ServiceDetailLayout,
        FloatButtons,
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
