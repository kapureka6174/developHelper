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
            v-on:blur="title.error = ''"
        />

        <!-- 通常表示 -->
        <p
            v-else
            class="text-2xl font-bold text-gray-700 mb-2"
            @click="title.decidable = false"
        >
            {{ title.content }}
        </p>

        <!-- エラー表示 -->
        <client-error :errorFlag="title.error !== ''" :text="title.error" />
        <server-error
            :errorFlag="Object.keys($page.props.errors).length"
            :errors="
                Object.entries($page.props.errors).filter((e) => {
                    if (!/requirement/.test(e[0])) {
                        return /title/.test(e[0]);
                    }
                })
            "
        />
    </div>
</template>
<script>
import { inject } from "vue";
import ClientError from "../Utility/ClientError";
import ServerError from "../Utility/ClientError";

export default {
    components: {
        ClientError,
        ServerError,
    },
    setup() {
        const title = inject("title");

        const input = (e) => {
            if (!e.target.value) {
                title.error = "サービス名が入力されていません。";
            } else {
                title.error = "";
                title.decidable = true;
            }
        };

        return { title, input };
    },
};
</script>
