<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                サービス詳細画面
            </h2>
        </template>
        <div class="py-10 px-4">
            <h1 class="text-3xl font-extrabold pb-3">{{ service.title }}</h1>
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
                <p class="text-xl text-gray-600 px-3">
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
                            <p class="text-xl text-indigo-600 font-semibold">
                                {{ tech.techname }}
                            </p>
                            <p class="text-xl text-indigo-600 font-semibold">
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
                <div class="rounded-t-lg m-5 mx-auto bg-gray-200 text-gray-800">
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
                        <div class="px-4 py-3 md:w-8/12 text-center">説明</div>
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
                <h1 class="text-2xl text-indigo-700 font-semibold mb-2">
                    タスク
                </h1>

                <!-- 通常表示 -->
                <div
                    v-if="typeof $page.user == 'null'"
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
                                @click="addLine('todos')"
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
                            v-for="(todo, index) in form.tasks.todos"
                            :key="index"
                            class="my-2 flex items-center"
                        >
                            <input
                                v-if="form.tasks.todos[index].editable"
                                type="text"
                                v-model="form.tasks.todos[index].content"
                                @keyup.enter="
                                    form.tasks.todos[index].editable = false
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
                                        form.tasks.todos[index].editable = true
                                    "
                                >
                                    {{ todo.content }}
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
                                        form.tasks.doings.push(
                                            form.tasks.todos.splice(index, 1)[0]
                                        )
                                    "
                                >
                                    <path stroke="none" d="M0 0h24v24H0z" />
                                    <polyline points="9 6 15 12 9 18" />
                                </svg>
                            </div>
                            <svg
                                class="h-6 w-6 text-red-600 hover:text-red-400"
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="2"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                @click="form.tasks.todos.splice(index, 1)"
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
                                @click="addLine('doings')"
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
                            v-for="(doing, index) in form.tasks.doings"
                            :key="index"
                            class="my-2 flex items-center"
                        >
                            <input
                                v-if="form.tasks.doings[index].editable"
                                type="text"
                                v-model="form.tasks.doings[index].content"
                                @keyup.enter="
                                    form.tasks.doings[index].editable = false
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
                                        form.tasks.todos.push(
                                            form.tasks.doings.splice(
                                                index,
                                                1
                                            )[0]
                                        )
                                    "
                                >
                                    <path stroke="none" d="M0 0h24v24H0z" />
                                    <polyline points="15 6 9 12 15 18" />
                                </svg>
                                <p
                                    class="text-gray-600 font-semibold"
                                    @click="
                                        form.tasks.doings[index].editable = true
                                    "
                                >
                                    {{ doing.content }}
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
                                        form.tasks.dones.push(
                                            form.tasks.doings.splice(
                                                index,
                                                1
                                            )[0]
                                        )
                                    "
                                >
                                    <path stroke="none" d="M0 0h24v24H0z" />
                                    <polyline points="9 6 15 12 9 18" />
                                </svg>
                            </div>
                            <svg
                                class="h-6 w-6 text-red-600 hover:text-red-400"
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="2"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                @click="form.tasks.doings.splice(index, 1)"
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
                                @click="addLine('dones')"
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
                            v-for="(done, index) in form.tasks.dones"
                            :key="index"
                            class="my-2 flex items-center"
                        >
                            <input
                                v-if="form.tasks.dones[index].editable"
                                type="text"
                                v-model="form.tasks.dones[index].content"
                                @keyup.enter="
                                    form.tasks.dones[index].editable = false
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
                                        form.tasks.doings.push(
                                            form.tasks.dones.splice(index, 1)[0]
                                        )
                                    "
                                >
                                    <path stroke="none" d="M0 0h24v24H0z" />
                                    <polyline points="15 6 9 12 15 18" />
                                </svg>
                                <p
                                    class="text-gray-600 font-semibold"
                                    @click="
                                        form.tasks.dones[index].editable = true
                                    "
                                >
                                    {{ done.content }}
                                </p>
                            </div>
                            <svg
                                class="h-6 w-6 text-red-600 hover:text-red-400"
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="2"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                @click="form.tasks.dones.splice(index, 1)"
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
                        focus:outline-none focus:bg-white focus:border-gray-500
                    "
                    v-model="form.comments.content"
                    v-if="form.comments.editable"
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
                <div class="flex justify-end w-full">
                    <button
                        v-if="form.comments.editable"
                        class="
                            bg-indigo-600
                            hover:bg-indigo-400
                            h-10
                            w-16
                            mr-3
                            text-white
                            rounded
                        "
                        @click="form.comments.editable = false"
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
                        @click="form.comments.editable = true"
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
                        @click="submit"
                    >
                        投稿
                    </button>
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
        let tasks = {
            todos: [],
            doings: [],
            dones: [],
        };
        if (props.tasks.length) {
            props.tasks.map((task) => {
                switch (task.state) {
                    case "やるべきこと":
                        tasks.todos.push({
                            content: task.taskname,
                            editable: false,
                        });
                        break;
                    case "開発中":
                        tasks.doings.push({
                            content: task.taskname,
                            editable: false,
                        });
                        break;
                    case "完了":
                        tasks.dones.push({
                            content: task.taskname,
                            editable: false,
                        });
                        break;
                    default:
                        break;
                }
            });
        }

        const form = reactive({
            id: props.service.id,
            comments: {
                type: "",
                content: "",
                editable: true,
            },
            tasks,
        });

        const addLine = (type) => {
            form.tasks[type].push({
                content: "",
                editable: true,
            });
        };

        // DBへ保存
        const submit = () => {
            Inertia.post("Service", form);
        };

        return { form, addLine, submit };
    },
};
</script>
