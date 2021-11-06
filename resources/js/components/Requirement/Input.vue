<template>
    <div class="w-full">
        <!-- 要件名（編集表示） -->
        <input
            v-if="!requirements[index].title.decidable"
            class="
                block
                mb-2
                mr-2
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
            "
            placeholder="要件名・機能名を入力してください"
            @keyup.enter="input($event.target.value, 'title')"
            v-model="requirements[index].title.content"
            v-on:blur="requirements[index].title.error = ''"
        />

        <!-- エラー表示（クライアントサイド） -->
        <client-error
            :errorFlag="requirements[index].title.error !== ''"
            :text="requirements[index].title.error"
        />

        <!-- 要件名（通常表示） -->
        <details v-if="requirements[index].title.decidable" class="mb-1">
            <summary class="relative px-4 py-2 h-full bg-gray-200 rounded">
                <span
                    class="break-words font-semibold"
                    @click="requirements[index].title.decidable = false"
                >
                    {{ requirements[index].title.content }}
                </span>
                <!-- 削除ボタン -->
                <svg
                    class="absolute right-1 top-1 w-6 h-6 hover:text-red-400 text-red-600"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    @click="destroy($page.url, index)"
                >
                    <polyline points="3 6 5 6 21 6" />
                    <path
                        d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"
                    />
                    <line x1="10" y1="11" x2="10" y2="17" />
                    <line x1="14" y1="11" x2="14" y2="17" />
                </svg>
            </summary>
            <!-- 要件の説明（編集表示） -->
            <div v-if="!requirements[index].explain.decidable" class="flex flex-col items-end">
                <textarea
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
                    "
                    rows="8"
                    placeholder="要件・機能の説明を入力してください"
                    v-model="requirements[index].explain.content"
                    v-on:blur="requirements[index].explain.error = ''"
                />
                <div class="flex">
                    <!-- エラー表示（クライアントサイド） -->
                    <client-error
                        :errorFlag="requirements[index].explain.error !== ''"
                        :text="requirements[index].explain.error"
                    />
                    <!-- 要件の説明の保存ボタン -->
                    <button
                        class="m-2 w-12 h-8 text-white hover:bg-indigo-400 bg-indigo-600 rounded"
                        @click="input(requirements[index].explain.content, 'explain')"
                    >
                        決定
                    </button>
                </div>
            </div>

            <p
                v-else
                class="text-grey-600 m-4 break-words whitespace-pre-line font-bold"
                @click="requirements[index].explain.decidable = false"
            >
                {{ requirements[index].explain.content }}
            </p>
        </details>

        <!-- エラー表示（サーバーサイド） -->
        <server-error
            :errorFlag="Object.keys($page.props.errors).length"
            :errors="
                Object.entries($page.props.errors).filter((e) => {
                    return e[0].split('.')[0] == 'requirements' && e[0].split('.')[1] == `${index}`
                        ? true
                        : false;
                })
            "
        />
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
        props: {
            index: Number,
        },
        setup(props) {
            const requirements = inject("requirements");

            const input = (value, type) => {
                // 空入力かどうかのチェック
                if (!value) {
                    const message = type == "title" ? "要件名・機能名" : "要件・機能の説明";
                    requirements[props.index][type].error = `${message}が入力されていません。`;
                } else if (
                    // 同じ機能名が追加されているかどうかの確認
                    type != "explain" &&
                    requirements
                        .filter((requirement, index) => index !== props.index)
                        .map((requirement) => requirement.title.content.toUpperCase())
                        .includes(value.toUpperCase())
                ) {
                    requirements[props.index].title.error = `既に同じ機能名が追加されています。`;
                } else {
                    //問題なければ通常表示に切り替える
                    requirements[props.index][type].error = "";
                    requirements[props.index][type].decidable = true;
                }
            };

            const deleteData = inject("deleteData");
            const pages = inject("pages");
            const destroy = (url, index) => {
                // 新規作成画面ならそのままデータ消す
                if (url.split("/")[1] == "create") {
                    requirements.splice(index, 1);
                } else {
                    // 編集画面なら削除データをDBに引き渡すためにdeleteDataに保存
                    let deleteContent = requirements.splice(index, 1)[0];
                    if (deleteContent) {
                        deleteData.requirements.push(deleteContent.id);
                    }
                    // ページの中に削除した機能が含まれる場合はそれも削除する
                    pages.forEach((page, index) => {
                        page.requirements.forEach((requirement, requireIndex) => {
                            if (requirement.id == deleteContent.id) {
                                pages[index].requirements.splice(requireIndex, 1);
                            }
                        });
                    });
                }
            };
            return { requirements, input, destroy };
        },
    };
</script>
