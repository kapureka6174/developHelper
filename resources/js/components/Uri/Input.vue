<template>
    <div class="overflow-x-auto">
        <div class="m-5 mx-auto text-gray-800 bg-gray-200 rounded-t-lg">
            <Header />
            <div
                v-for="(uri, index) in uris"
                :key="index"
                class="relative flex flex-col items-center bg-gray-100 border-b border-gray-200"
            >
                <div class="flex-col-3 flex w-full">
                    <div class="px-4 py-3 w-3/12 text-center overflow-x-auto md:w-3/12">
                        <!-- URI（通常表示） -->
                        <input
                            v-if="!uris[index].uri.decidable"
                            class="
                                block
                                px-1
                                w-full
                                h-10
                                text-gray-700
                                leading-tight
                                bg-white
                                border
                                focus:border-blue-500
                                border-gray-200
                                rounded
                                focus:outline-none
                                appearance-none
                                focus:ring-1 focus:ring-blue-500
                            "
                            @keyup.enter="input($event.target.value, index, 'uri')"
                            v-model="uris[index].uri.content"
                            v-on:blur="uris[index].uri.error = ''"
                        />
                        <!-- URI（通常表示） -->
                        <div
                            v-else
                            @click="uris[index].uri.decidable = false"
                            class="whitespace-nowrap"
                        >
                            {{ uris[index].uri.content }}
                        </div>
                    </div>
                    <div class="px-4 py-3 w-3/12 text-center overflow-x-auto md:w-1/12">
                        <!-- メソッド（編集表示） -->
                        <input
                            v-if="!uris[index].method.decidable"
                            class="
                                block
                                px-1
                                w-full
                                h-10
                                text-gray-700
                                leading-tight
                                bg-white
                                border
                                focus:border-blue-500
                                border-gray-200
                                rounded
                                focus:outline-none
                                appearance-none
                                focus:ring-1 focus:ring-blue-500
                            "
                            @keyup.enter="input($event.target.value, index, 'method')"
                            v-model="uris[index].method.content"
                            v-on:blur="uris[index].method.error = ''"
                        />
                        <!-- メソッド（通常表示） -->
                        <div
                            v-else
                            @click="uris[index].method.decidable = false"
                            class="whitespace-nowrap"
                        >
                            {{ uris[index].method.content }}
                        </div>
                    </div>
                    <!-- 説明 -->
                    <div
                        class="items-center px-4 py-3 w-6/12 text-center overflow-x-auto md:w-8/12"
                    >
                        <!-- 説明（編集表示） -->
                        <input
                            v-if="!uris[index].explain.decidable"
                            class="
                                block
                                mr-2
                                px-1
                                w-11/12
                                h-10
                                text-gray-700
                                leading-tight
                                bg-white
                                border
                                focus:border-blue-500
                                border-gray-200
                                rounded
                                focus:outline-none
                                appearance-none
                                focus:ring-1 focus:ring-blue-500
                            "
                            @keyup.enter="input($event.target.value, index, 'explain')"
                            v-model="uris[index].explain.content"
                            v-on:blur="uris[index].explain.error = ''"
                        />
                        <!-- 説明（通常表示） -->
                        <div
                            v-else
                            @click="uris[index].explain.decidable = false"
                            class="whitespace-nowrap"
                        >
                            {{ uris[index].explain.content }}
                        </div>
                        <!-- 削除ボタン -->
                        <svg
                            class="absolute right-3 w-6 h-6 hover:text-red-400 text-red-600"
                            :class="
                                uris[index].uri.decidable == false ||
                                uris[index].method.decidable == false ||
                                uris[index].explain.decidable == false
                                    ? 'top-5'
                                    : 'top-3'
                            "
                            @click="destroy($page.url, index)"
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
                <div>
                    <!-- エラー表示 -->
                    <client-error
                        :errorFlag="uris[index].uri.error !== ''"
                        :text="uris[index].uri.error"
                    />
                    <client-error
                        :errorFlag="uris[index].method.error !== ''"
                        :text="uris[index].method.error"
                    />
                    <client-error
                        :errorFlag="uris[index].explain.error !== ''"
                        :text="uris[index].explain.error"
                    />
                </div>
            </div>
        </div>
    </div>

    <server-error
        :errorFlag="Object.keys($page.props.errors).length"
        :errors="
            Object.entries($page.props.errors).filter((e) => {
                return e[0].split('.')[0] == 'uris' ? true : false;
            })
        "
    />
</template>
<script>
    import ClientError from "../Utility/ClientError";
    import ServerError from "../Utility/ServerError";
    import Header from "./Header";
    import { inject } from "vue";
    export default {
        components: {
            ClientError,
            ServerError,
            Header,
        },
        props: {
            uris: Array,
        },
        setup(props) {
            const uris = inject("uris");

            const input = (value, index, type) => {
                if (!value) {
                    let message;
                    if (type == "uri") {
                        message = "URI";
                    } else if (type == "method") {
                        message = "メソッド";
                    } else {
                        message = "説明";
                    }
                    uris[index][type].error = `${message}が入力されていません。`;
                } else {
                    uris[index][type].error = "";
                    uris[index][type].decidable = true;
                }
            };

            const deleteData = inject("deleteData");
            const destroy = (url, index) => {
                if (url.split("/")[1] == "create") {
                    uris.splice(index, 1);
                } else {
                    let deleteContent = uris.splice(index, 1)[0];
                    if (deleteContent) {
                        deleteData.uris.push(deleteContent.id);
                    }
                }
            };
            return { uris, input, destroy };
        },
    };
</script>
