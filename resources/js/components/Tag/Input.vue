<template>
    <div class="relative">
        <!-- 入力フォーム -->
        <input
            class="
                block
                mt-2
                px-4
                py-2
                w-full
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
                md:w-1/2
            "
            placeholder="カテゴリーを追加できます"
            @keyup.enter="addTag"
            v-on:blur="tags.error = ''"
        />
        <!-- エラー表示 -->
        <client-error :errorFlag="tags.error !== ''" :text="tags.error" />
        <server-error
            :errorFlag="Object.keys($page.props.errors).length"
            :errors="
                Object.entries($page.props.errors).filter((e) => {
                    return /tags/.test(e[0]);
                })
            "
        />

        <!-- タグ一覧 -->
        <div
            class="inline-flex items-center mr-1 mt-2 text-sm bg-blue-100 rounded overflow-hidden"
            v-for="(tag, index) in tags.content"
            :key="index"
        >
            <span class="ml-2 mr-1 px-1 max-w-xs leading-relaxed truncate">{{ tag }}</span>
            <!-- 削除ボタン -->
            <button
                class="
                    inline-block
                    align-middle
                    w-6
                    h-8
                    text-gray-500
                    bg-blue-200
                    focus:outline-none
                "
                @click="tags.content.splice(index, 1)"
            >
                <svg
                    class="mx-auto w-6 h-6 fill-current"
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
    import ClientError from "../Utility/ClientError";
    import ServerError from "../Utility/ServerError";
    import { inject } from "vue";
    export default {
        components: {
            ClientError,
            ServerError,
        },
        setup() {
            // タグの追加
            const tags = inject("tags");
            const addTag = (e) => {
                // 空入力かどうかのチェック
                if (!e.target.value) {
                    tags.error = "カテゴリーが入力されていません。";
                } else if (
                    // 同じカテゴリーが追加されているかどうかの確認
                    tags.content
                        .map((tag) => tag.toUpperCase())
                        .includes(e.target.value.toUpperCase())
                ) {
                    tags.error = "既に同じカテゴリーが追加されています。";
                } else {
                    //問題なければ追加する
                    tags.content.push(e.target.value);
                    tags.error = "";
                    e.target.value = "";
                }
            };
            return { tags, addTag };
        },
    };
</script>
