<template>
    <div>
        <div class="bg-blue-200 m-2 rounded p-3">
            <div class="flex items-center mb-3">
                <input
                    v-if="!techFields[index].techField.decidable"
                    v-model="techFields[index].techField.content"
                    class="
                        appearance-none
                        block
                        w-4/5
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
                    placeholder="技術分野を入力してください。"
                    @keyup.enter="inputFieldName"
                />
                <p
                    v-else
                    class="py-2 px-4 mr-2 font-bold text-gray-700 w-4/5"
                    @click="techFields[index].techField.decidable = false"
                >
                    {{ techFields[index].techField.content }}
                </p>
                <!-- 追加ボタン -->
                <button
                    class="
                        bg-indigo-600
                        hover:bg-indigo-400
                        h-8
                        w-12
                        text-white
                        rounded
                        mr-3
                    "
                    @click="addTech(index)"
                >
                    追加
                </button>
                <!-- 削除ボタン -->
                <svg
                    class="h-6 w-6 text-red-600 hover:text-red-400"
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
                v-if="techFields[index].techField.error"
            >
                <strong class="font-bold">{{
                    techFields[index].techField.error
                }}</strong>
            </div>
            <tech-field-tech-input
                v-for="(tech, techIndex) in techFields[index].teches"
                :key="techIndex"
                :techIndex="techIndex"
                :index="index"
            />
        </div>
        <!-- エラー表示（サーバーサイド） -->
        <div v-if="Object.keys($page.props.errors).length">
            <div
                v-for="(error, errorIndex) in Object.entries(
                    $page.props.errors
                ).filter((e) => {
                    return e[0].split('.')[0] == 'techFields' &&
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
import TechFieldTechInput from "./TechFieldTechInput";
export default {
    components: {
        TechFieldTechInput,
    },
    props: {
        index: Number,
    },
    setup(props) {
        const techFields = inject("techFields");
        const newTechObject = inject("newTech");
        const inputFieldName = (e) => {
            if (!e.target.value) {
                techFields[props.index].techField.error =
                    "分野名が入力されていません。";
            } else if (
                // 大小区別せずに比較する
                techFields
                    .filter((field, index) => index != props.index)
                    .map((fields) => fields.techField.content.toUpperCase())
                    .includes(e.target.value.toUpperCase())
            ) {
                techFields[props.index].techField.error =
                    "既に同じ分野名が追加されています。";
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
