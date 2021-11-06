<template>
    <div>
        <div class="m-2 p-3 bg-blue-200 rounded">
            <div class="flex items-center mb-3">
                <input
                    v-if="!techFields[index].techField.decidable"
                    v-model="techFields[index].techField.content"
                    class="
                        block
                        mr-2
                        px-4
                        py-2
                        w-4/5
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
                    placeholder="技術分野を入力してください。"
                    @keyup.enter="inputFieldName"
                />
                <p
                    v-else
                    class="mr-2 px-4 py-2 w-4/5 text-gray-700 font-bold"
                    @click="techFields[index].techField.decidable = false"
                >
                    {{ techFields[index].techField.content }}
                </p>
                <!-- 追加ボタン -->
                <button
                    class="mr-3 w-12 h-8 text-white hover:bg-indigo-400 bg-indigo-600 rounded"
                    @click="addTech(index)"
                >
                    追加
                </button>
                <!-- 削除ボタン -->
                <svg
                    class="w-6 h-6 hover:text-red-400 text-red-600"
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
                :errorFlag="techFields[index].techField.error !== ''"
                :text="techFields[index].techField.error"
            />
            <tech-input
                v-for="(tech, techIndex) in techFields[index].teches"
                :key="techIndex"
                :techIndex="techIndex"
                :index="index"
            />
        </div>
        <!-- エラー表示（サーバーサイド） -->
        <server-error
            :errorFlag="Object.keys($page.props.errors).length"
            :errors="
                Object.entries($page.props.errors).filter((e) => {
                    return e[0].split('.')[0] == 'techFields' && e[0].split('.')[1] == `${index}`
                        ? true
                        : false;
                })
            "
        />
    </div>
</template>
<script>
    import TechInput from "./TechInput";
    import ClientError from "../Utility/ClientError";
    import ServerError from "../Utility/ServerError";
    import { inject } from "vue";

    export default {
        components: {
            TechInput,
            ClientError,
            ServerError,
        },
        props: {
            index: Number,
        },
        setup(props) {
            const techFields = inject("techFields");
            const newTechObject = inject("newTech");
            const inputFieldName = (e) => {
                if (!e.target.value) {
                    techFields[props.index].techField.error = "分野名が入力されていません。";
                } else if (
                    // 大小区別せずに比較する
                    techFields
                        .filter((field, index) => index != props.index)
                        .map((fields) => fields.techField.content.toUpperCase())
                        .includes(e.target.value.toUpperCase())
                ) {
                    techFields[props.index].techField.error = "既に同じ分野名が追加されています。";
                } else {
                    techFields[props.index].techField.error = "";
                    techFields[props.index].techField.decidable = true;
                }
            };

            const addTech = (index) => {
                techFields[index].teches.push(newTechObject());
            };

            const deleteData = inject("deleteData");
            const destroy = (url, index) => {
                if (url.split("/")[1] == "create") {
                    techFields.splice(index, 1);
                } else {
                    let deleteContent = techFields.splice(index, 1)[0];
                    if (deleteContent.techField.id) {
                        deleteData.techFields.push(deleteContent.techField.id);
                    }
                }
            };

            return { techFields, inputFieldName, addTech, destroy };
        },
    };
</script>
