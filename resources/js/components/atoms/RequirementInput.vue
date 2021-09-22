<template>
    <div class="w-full">
        <!-- 要件名（編集表示） -->
        <input
            v-if="!requirements[index].title.decidable"
            class="
                appearance-none
                block
                w-full
                bg-white
                text-gray-700
                border border-gray-200
                rounded
                py-2
                px-4
                mr-2
                leading-tight
                focus:outline-none
                focus:ring-1
                focus:ring-blue-500
                focus:border-blue-500
                mb-2
            "
            placeholder="要件名・機能名を入力してください"
            @keyup.enter="input($event.target.value, 'title')"
            v-model="requirements[index].title.content"
            v-on:blur="requirements[index].title.error = false"
        />

        <!-- エラー表示（クライアントサイド） -->
        <div
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
            v-if="requirements[index].title.error"
        >
            <strong class="font-bold">{{
                requirements[index].title.error
            }}</strong>
        </div>
        <!-- 要件名（通常表示） -->
        <details v-if="requirements[index].title.decidable" class="mb-1" open>
            <summary class="rounded py-2 px-4 bg-gray-200 relative h-full">
                <span
                    class="font-semibold break-words"
                    @click="requirements[index].title.decidable = false"
                >
                    {{ requirements[index].title.content }}
                </span>
                <!-- 削除ボタン -->
                <svg
                    class="
                        h-6
                        w-6
                        text-red-600
                        hover:text-red-400
                        absolute
                        top-1
                        right-1
                    "
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
            <div
                v-if="!requirements[index].explain.decidable"
                class="flex flex-col items-end"
            >
                <textarea
                    class="
                        appearance-none
                        block
                        w-full
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
                    rows="8"
                    placeholder="要件・機能の説明を入力してください"
                    v-model="requirements[index].explain.content"
                    v-on:blur="requirements[index].explain.error = false"
                />
                <div class="flex">
                    <!-- エラー表示（クライアントサイド） -->
                    <div
                        class="
                            bg-red-100
                            border border-red-400
                            text-red-700
                            px-4
                            py-1
                            rounded
                            my-2
                        "
                        role="alert"
                        v-if="requirements[index].explain.error"
                    >
                        <strong class="font-bold">{{
                            requirements[index].explain.error
                        }}</strong>
                    </div>
                    <!-- 要件の説明の保存ボタン -->
                    <button
                        class="
                            bg-indigo-600
                            hover:bg-indigo-400
                            h-8
                            w-12
                            text-white
                            rounded
                            m-2
                        "
                        @click="
                            input(
                                requirements[index].explain.content,
                                'explain'
                            )
                        "
                    >
                        決定
                    </button>
                </div>
            </div>

            <p
                v-else
                class="
                    text-grey-600
                    font-bold
                    m-4
                    whitespace-pre-line
                    break-words
                "
                @click="requirements[index].explain.decidable = false"
            >
                {{ requirements[index].explain.content }}
            </p>
        </details>

        <!-- エラー表示（サーバーサイド） -->
        <div v-if="Object.keys($page.props.errors).length">
            <div
                v-for="(error, errorIndex) in Object.entries(
                    $page.props.errors
                ).filter((e) => {
                    return e[0].split('.')[0] == 'requirements' &&
                        e[0].split('.')[1] == `${index}`
                        ? true
                        : false;
                })"
                :key="errorIndex"
                class="
                    bg-red-100
                    border border-red-400
                    text-red-700
                    px-4
                    py-3
                    rounded
                    m-2
                "
                role="alert"
            >
                <p class="font-bold">
                    {{ error[1] }}
                </p>
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
        const requirements = inject("requirements");
        console.log(requirements);

        const input = (value, type) => {
            if (!value) {
                const message =
                    type == "title" ? "要件名・機能名" : "要件・機能の説明";
                requirements[props.index][
                    type
                ].error = `${message}が入力されていません。`;
            } else if (
                type != "explain" &&
                // 大小区別せずに比較する
                requirements
                    .filter((requirement, index) => index !== props.index)
                    .map((requirement) =>
                        requirement.title.content.toUpperCase()
                    )
                    .includes(value.toUpperCase())
            ) {
                requirements[props.index][
                    type
                ].error = `既に同じ機能名が追加されています。`;
            } else {
                requirements[props.index][type].error = false;
                requirements[props.index][type].decidable = true;
            }
        };

        const deleteData = inject("deleteData");
        const pages = inject("pages");
        const destroy = (url, index) => {
            if (url.split("/")[1] == "create") {
                requirements.splice(index, 1);
            } else {
                let deleteContent = requirements.splice(index, 1)[0];
                if (deleteContent) {
                    deleteData.requirements.push(deleteContent.id);
                }
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
