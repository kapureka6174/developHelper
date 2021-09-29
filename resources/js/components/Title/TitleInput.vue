<template>
    <div>
        <!-- 編集表示 -->
        <input
            v-if="!title.decidable"
            class="w-full rounded my-2"
            type="text"
            placeholder="サービス名を入力してください"
            v-model="title.content"
            @keyup.enter="input"
            v-on:blur="title.error = false"
        />

        <!-- 通常表示 -->
        <p
            v-else
            class="text-2xl font-bold text-gray-700 mb-2"
            @click="title.decidable = false"
        >
            {{ title.content }}
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
            v-if="title.error"
        >
            <strong class="font-bold">サービス名が入力されていません。</strong>
        </div>

        <!-- エラー表示（サーバーサイド） -->
        <div v-if="Object.keys($page.props.errors).length">
            <div
                v-for="(error, index) in Object.entries(
                    $page.props.errors
                ).filter((e) => {
                    if (!/requirement/.test(e[0])) {
                        return /title/.test(e[0]);
                    }
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
        const title = inject("title");

        const input = (e) => {
            if (!e.target.value) {
                title.error = true;
            } else {
                title.error = false;
                title.decidable = true;
            }
        };

        return { title, input };
    },
};
</script>
