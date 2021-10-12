<template>
    <div>
        <div class="bg-blue-400 rounded m-3 pb-3">
            <div class="flex items-center">
                <!-- ページ名（編集表示） -->
                <input
                    v-if="!pages[index].pagename.decidable"
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
                    placeholder="ページ名を入力してください"
                    v-model="pages[index].pagename.content"
                    type="text"
                    @keyup.enter="input($event.target.value)"
                    v-on:blur="pages[index].pagename.error = ''"
                />
                <!-- ページ名（通常表示） -->
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
                    @click="pages[index].pagename.decidable = false"
                >
                    {{ pages[index].pagename.content }}
                </h1>
                <!-- 削除ボタン -->
                <svg
                    class="h-6 w-6 text-red-600 hover:text-red-400 mr-3"
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
            <!-- エラー表示（クライアントサイド） -->
            <client-error
                :errorFlag="pages[index].pagename.error !== ''"
                :text="pages[index].pagename.error"
            />

            <!-- 追加ボタン -->
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
                    @click="addSelectedRequirement($page.url, index)"
                >
                    選択中の機能を追加
                </button>
            </div>
            <require-input
                v-for="(requirement, requirementIndex) in pages[index]
                    .requirements"
                :key="requirementIndex"
                :index="index"
                :requirementIndex="requirementIndex"
            />
        </div>
        <!-- エラー表示（サーバーサイド） -->
        <server-error
            :errorFlag="Object.keys($page.props.errors).length"
            :errors="
                Object.entries($page.props.errors).filter((e) => {
                    return e[0].split('.')[0] == 'pages' &&
                        e[0].split('.')[1] == `${index}`
                        ? true
                        : false;
                })
            "
        />
    </div>
</template>
<script>
import RequireInput from "./RequireInput";
import ClientError from "../Utility/ClientError";
import ServerError from "../Utility/ServerError";
import { inject } from "vue";

export default {
    components: {
        RequireInput,
        ClientError,
        ServerError,
    },
    props: {
        index: Number,
    },
    setup(props) {
        const pages = inject("pages");
        const requirements = inject("requirements");

        // データの追加
        const input = (value) => {
            // 空入力かどうかのチェック
            if (!value) {
                pages[props.index].pagename.error =
                    "ページ名が入力されていません。";
            } else if (
                // 同じページ名が既に存在するかどうかの確認
                pages
                    .filter((page, index) => index !== props.index)
                    .map((page) => page.pagename.content.toUpperCase())
                    .includes(value.toUpperCase())
            ) {
                pages[
                    props.index
                ].pagename.error = `既に同じページ名が追加されています。`;
            } else {
                //問題なければ通常表示に切り替える
                pages[props.index].pagename.error = "";
                pages[props.index].pagename.decidable = true;
            }
        };

        // 選択中の機能をページに追加
        const addSelectedRequirement = (url, pageIndex) => {
            // 選択されている機能を取得
            const selectedArray = requirements.filter(
                (requirement) => requirement.title.selected == true
            );

            if (url.split("/")[1] == "create") {
                // 新規作成画面ならそのまま追加する
                pages[pageIndex].requirements = [];
                selectedArray.forEach((requirement) => {
                    pages[pageIndex].requirements.push(
                        requirement.title.content
                    );
                });
            } else {
                selectedArray.forEach((requirement) => {
                    if (
                        // 既に存在する機能以外を追加
                        !pages[pageIndex].requirements
                            .map((requirement) => requirement.content)
                            .includes(requirement.title.content)
                    ) {
                        pages[pageIndex].requirements.push({
                            content: requirement.title.content,
                        });
                    }
                });
            }
        };

        // データの削除
        const deleteData = inject("deleteData");
        const destroy = (url, index) => {
            if (url.split("/")[1] == "create") {
                // 新規作成画面ならそのままデータ消す
                pages.splice(index, 1);
            } else {
                // 編集画面なら削除データをDBに引き渡すためにdeleteDataに保存
                let deleteContent = pages.splice(index, 1)[0];
                if (deleteContent) {
                    deleteData.pages.push(deleteContent.id);
                }
            }
        };

        return { pages, input, addSelectedRequirement, destroy };
    },
};
</script>
