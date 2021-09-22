<template>
    <div>
        <!-- 編集表示 -->
        <textarea
            class="
                autoexpand
                tracking-wide
                py-2
                px-4
                mb-3
                leading-relaxed
                appearance-none
                block
                w-full
                border border-gray-200
                rounded
                focus:outline-none focus:bg-white focus:border-gray-500
            "
            rows="10"
            placeholder="サービスの説明を入力してください。"
            v-if="!description.decidable"
            v-model="description.content"
        ></textarea>
        <!-- 通常表示 -->
        <p
            class="
                whitespace-pre-line
                mt-2
                py-2
                px-4
                mb-3
                text-xl text-gray-700
                font-bold
                break-words
            "
            v-else
        >
            {{ description.content }}
        </p>
        <!-- エラー表示（クライアントサイド） -->
        <div
            class="
                bg-red-100
                border border-red-400
                text-red-700
                px-4
                py-3
                rounded
                mt-2
            "
            role="alert"
            v-if="description.error"
        >
            <strong class="font-bold"
                >サービスの概要が入力されていません。</strong
            >
        </div>
        <!-- エラー表示（サーバーサイド） -->
        <div v-if="Object.keys($page.props.errors).length">
            <div
                v-for="(error, index) in Object.entries(
                    $page.props.errors
                ).filter((e) => {
                    return /description/.test(e[0]);
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
    </div>
</template>
<script>
import { inject } from "vue";
export default {
    setup() {
        const description = inject("description");
        return { description };
    },
};
</script>
