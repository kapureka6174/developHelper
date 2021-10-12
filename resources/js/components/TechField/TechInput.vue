<template>
    <div class="flex flex-col">
        <div class="flex mb-2 items-center">
            <!-- 技術名（編集表示） -->
            <input
                v-if="!techFields[index].teches[techIndex].tech.decidable"
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
                    mr-2
                    leading-tight
                    focus:outline-none
                    focus:ring-1
                    focus:ring-blue-500
                    focus:border-blue-500
                "
                placeholder="技術名"
                @keyup.enter="input($event.target.value, 'tech')"
                v-model="techFields[index].teches[techIndex].tech.content"
                v-on:blur="techFields[index].teches[techIndex].tech.error = ''"
            />
            <!-- 技術名（通常表示） -->
            <p
                v-else
                class="py-2 px-4 mr-2 font-bold text-gray-700"
                @click="
                    techFields[index].teches[techIndex].tech.decidable = false
                "
            >
                {{ techFields[index].teches[techIndex].tech.content }}
            </p>
            <!-- バージョン名（編集表示） -->
            <input
                v-if="!techFields[index].teches[techIndex].version.decidable"
                class="
                    appearance-none
                    block
                    w-2/5
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
                "
                placeholder="バージョン"
                @keyup.enter="input($event.target.value, 'version')"
                v-model="techFields[index].teches[techIndex].version.content"
                v-on:blur="
                    techFields[index].teches[techIndex].version.error = ''
                "
            />
            <!-- 技術名（通常表示） -->
            <p
                v-else
                class="py-2 px-4 mr-2 font-bold text-gray-700"
                @click="
                    techFields[index].teches[
                        techIndex
                    ].version.decidable = false
                "
            >
                {{ techFields[index].teches[techIndex].version.content }}
            </p>
            <!-- 削除ボタン -->
            <svg
                class="h-6 w-6 text-red-600 hover:text-red-400"
                viewBox="0 0 24 24"
                fill="none"
                stroke="currentColor"
                stroke-width="2"
                stroke-linecap="round"
                stroke-linejoin="round"
                @click="destroyTech($page.url, index, techIndex)"
            >
                <polyline points="3 6 5 6 21 6" />
                <path
                    d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"
                />
                <line x1="10" y1="11" x2="10" y2="17" />
                <line x1="14" y1="11" x2="14" y2="17" />
            </svg>
        </div>
        <!-- エラー表示 -->
        <client-error
            :errorFlag="techFields[index].teches[techIndex].tech.error !== ''"
            :text="techFields[index].teches[techIndex].tech.error"
        />
    </div>
</template>
<script>
import { inject } from "vue";
import ClientError from "../Utility/ClientError";
export default {
    ccomponents: {
        ClientError,
    },
    props: {
        index: Number,
        techIndex: Number,
    },
    setup(props) {
        const techFields = inject("techFields");

        const input = (value, type) => {
            if (!value) {
                const message = type == "tech" ? "技術名" : "バージョン";
                techFields[props.index].teches[props.techIndex][
                    type
                ].error = `${message}が入力されていません。`;
            } else if (
                type != "version" &&
                // 大小区別せずに比較する
                techFields[props.index].teches
                    .filter((tech, index) => index !== props.techIndex)
                    .map((teches) => teches.tech.content.toUpperCase())
                    .includes(value.toUpperCase())
            ) {
                techFields[props.index].teches[
                    props.techIndex
                ].tech.error = `既に同じ技術名が追加されています。`;
            } else {
                techFields[props.index].teches[props.techIndex][type].error =
                    "";
                techFields[props.index].teches[props.techIndex][
                    type
                ].decidable = true;
            }
        };

        const deleteData = inject("deleteData");
        const destroyTech = (url, index, detailIndex) => {
            if (url.split("/")[1] == "create") {
                techFields[index].teches.splice(detailIndex, 1);
            } else {
                let deleteContent = techFields[index].teches.splice(
                    detailIndex,
                    1
                )[0];
                if (deleteContent.id) {
                    deleteData.teches.push(deleteContent.id);
                }
            }
        };
        return { techFields, input, destroyTech };
    },
};
</script>
