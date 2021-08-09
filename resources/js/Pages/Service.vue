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
                v-for="tag in tags"
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
                <section class="text-gray-700">
                    <div class="container px-5 py-2">
                        <div class="flex flex-wrap">
                            <div
                                class="w-full"
                                v-for="requirement in requirements"
                                :key="requirement.id"
                            >
                                <details class="mb-1">
                                    <summary
                                        class="
                                            font-semibold
                                            bg-gray-200
                                            rounded-md
                                            py-2
                                            px-4
                                        "
                                    >
                                        {{ requirement.content }}
                                    </summary>

                                    <span class="text-grey-600 font-bold m-4">
                                        {{ requirement.content }}
                                    </span>
                                </details>
                            </div>
                        </div>
                    </div>
                </section>
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
                        <div class="px-4 py-3 w-2/12">URI</div>
                        <div class="px-4 py-3 w-2/12">メソッド</div>
                        <div class="px-4 py-3 w-8/12">説明</div>
                    </div>

                    <div
                        class="
                            bg-gray-100
                            border-b border-gray-200
                            flex flex-col-3
                            items-center
                        "
                        v-for="uri in uris"
                        :key="uri.id"
                    >
                        <div class="px-4 py-3 w-2/12">{{ uri.uri }}</div>
                        <div class="px-4 py-3 w-2/12">{{ uri.method }}</div>
                        <div
                            class="
                                px-4
                                py-3
                                w-8/12
                                overflow-x-auto
                                max-h-40
                                sm:max-h-full
                            "
                        >
                            {{ uri.explain }}
                        </div>
                    </div>
                    <!-- each row -->
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
    props: {
        service: {
            type: Object,
        },
        requirements: {
            type: Array,
        },
        tags: {
            type: Array,
        },
        techFields: {
            type: Array,
        },
        teches: {
            type: Array,
        },
        uris: {
            type: Array,
        },
    },
    data: function () {
        return {
            active: false,
        };
    },
};
</script>
