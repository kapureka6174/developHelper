<template>
    <div class="relative">
        <!-- 入力フォーム -->
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
                mt-2
            "
            placeholder="カテゴリーを追加できます"
            @keyup.enter="addTag"
            v-on:blur="tags.error = ''"
        />
        <!-- エラー表示（クライアントサイド） -->
        <div
            v-if="tags.error"
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
        >
            <strong class="font-bold">{{ tags.error }}</strong>
        </div>
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
        <!-- タグ一覧 -->
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
            v-for="(tag, index) in tags.content"
            :key="index"
        >
            <span class="ml-2 mr-1 leading-relaxed truncate max-w-xs px-1">{{
                tag
            }}</span>
            <!-- 削除ボタン -->
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
                @click="tags.content.splice(index, 1)"
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
</template>

<script>
import { inject } from "vue";
export default {
    setup() {
        const tags = inject("tags");

        // タグ（配列に入れ込む）の処理
        const addTag = (e) => {
            if (!e.target.value) {
                tags.error = "カテゴリーが入力されていません。";
            } else if (
                // 大小区別せずに比較する
                tags.content
                    .map((tag) => tag.toUpperCase())
                    .includes(e.target.value.toUpperCase())
            ) {
                tags.error = "既に同じカテゴリーが追加されています。";
            } else {
                tags.content.push(e.target.value);
                tags.error = false;
                e.target.value = "";
            }
        };
        return { tags, addTag };
    },
};
</script>
