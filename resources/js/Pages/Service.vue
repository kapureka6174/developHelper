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

            <h1 class="text-2xl text-indigo-700 font-semibold mb-2">タスク</h1>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
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
                        v-for="task in tasks.filter((e) => e.state == '開発中')"
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
                        v-for="task in tasks.filter((e) => e.state == '完了')"
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
        </div>
    </app-layout>
</template>

<script>
import AppLayout from "../Layouts/AppLayout.vue";

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
};
</script>
