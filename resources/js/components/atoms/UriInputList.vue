<template>
    <div>
        <div
            class="
                bg-gray-100
                border-b border-gray-200
                flex flex-col-3
                items-center
                relative
            "
        >
            <div class="px-4 py-3 w-3/12 md:w-2/12 text-center">
                <!-- URI（通常表示） -->
                <input
                    v-if="!uris[index].uri.decidable"
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
                    @keyup.enter="input($event.target.value, 'uri')"
                    v-model="uris[index].uri.content"
                    v-on:blur="uris[index].uri.error = false"
                />
                <!-- URI（通常表示） -->
                <p v-else @click="uris[index].uri.decidable = false">
                    {{ uris[index].uri.content }}
                </p>
            </div>
            <div class="px-4 py-3 w-3/12 md:w-2/12 text-center">
                <!-- メソッド（編集表示） -->
                <input
                    v-if="!uris[index].method.decidable"
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
                    @keyup.enter="input($event.target.value, 'method')"
                    v-model="uris[index].method.content"
                    v-on:blur="uris[index].method.error = false"
                />
                <!-- メソッド（通常表示） -->
                <p v-else @click="uris[index].method.decidable = false">
                    {{ uris[index].method.content }}
                </p>
            </div>
            <!-- 説明 -->
            <div
                class="
                    px-4
                    py-3
                    w-6/12
                    overflow-x-auto
                    max-h-40
                    sm:max-h-full
                    md:w-8/12
                    items-center
                    text-center
                "
            >
                <!-- 説明（編集表示） -->
                <input
                    v-if="!uris[index].explain.decidable"
                    class="
                        appearance-none
                        block
                        w-11/12
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
                    @keyup.enter="input($event.target.value, 'explain')"
                    v-model="uris[index].explain.content"
                    v-on:blur="uris[index].explain.error = false"
                />
                <!-- 説明（通常表示） -->
                <p v-else @click="uris[index].explain.decidable = false">
                    {{ uris[index].explain.content }}
                </p>
                <!-- 削除ボタン -->
                <svg
                    class="
                        h-6
                        w-6
                        text-red-600
                        hover:text-red-400
                        absolute
                        right-3
                    "
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
        <!-- エラー表示（クライアントサイド） -->
        <div>
            <div
                class="
                    bg-red-100
                    border border-red-400
                    text-red-700
                    px-4
                    py-3
                    rounded
                "
                role="alert"
                v-if="uris[index].uri.error"
            >
                <strong class="font-bold">{{ uris[index].uri.error }}</strong>
            </div>
            <div
                class="
                    bg-red-100
                    border border-red-400
                    text-red-700
                    px-4
                    py-3
                    rounded
                "
                role="alert"
                v-if="uris[index].method.error"
            >
                <strong class="font-bold">{{
                    uris[index].method.error
                }}</strong>
            </div>
            <div
                class="
                    bg-red-100
                    border border-red-400
                    text-red-700
                    px-4
                    py-3
                    rounded
                "
                role="alert"
                v-if="uris[index].explain.error"
            >
                <strong class="font-bold">{{
                    uris[index].explain.error
                }}</strong>
            </div>
        </div>
    </div>
</template>
<script>
import { inject } from "vue";
export default {
    props: {
        index: Number,
    },
    setup(props) {
        const uris = inject("uris");

        const input = (value, type) => {
            if (!value) {
                let message;
                if (type == "uri") {
                    message = "URI";
                } else if (type == "method") {
                    message = "メソッド";
                } else {
                    message = "説明";
                }
                uris[props.index][
                    type
                ].error = `${message}が入力されていません。`;
            } else {
                uris[props.index][type].error = false;
                uris[props.index][type].decidable = true;
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
