<template>
    <div>
        <!-- 編集表示 -->
        <input
            v-if="!title.decidable"
            class="my-2 w-full rounded"
            type="text"
            placeholder="サービス名を入力してください"
            v-model="title.content"
            @keyup.enter="input"
            v-on:blur="title.error = ''"
        />

        <!-- 通常表示 -->
        <p v-else class="mb-2 text-gray-700 text-2xl font-bold" @click="title.decidable = false">
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
    import ServerError from "../Utility/ServerError";

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
