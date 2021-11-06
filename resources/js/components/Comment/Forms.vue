<template>
    <div class="flex flex-col p-4 w-full bg-gray-100" id="comment">
        <!-- コメントの項目選択 -->
        <select
            class="
                mb-3
                w-32
                border
                focus:border-blue-500
                border-gray-200
                rounded
                focus:outline-none focus:ring-1 focus:ring-blue-500
            "
            v-model="form.comments.type"
        >
            <option value="質問">質問</option>
            <option value="アドバイス">アドバイス</option>
            <option value="感想">感想</option>
        </select>

        <!-- 編集表示 -->
        <textarea
            class="
                autoexpand
                block
                mb-3
                px-4
                py-2
                w-full
                tracking-wide
                leading-relaxed
                focus:bg-white
                border border-gray-200
                focus:border-gray-500
                rounded
                focus:outline-none
                appearance-none
            "
            v-model="form.comments.content"
            v-if="!form.comments.decidable"
            rows="10"
        ></textarea>
        <!-- 通常表示 -->
        <p v-else class="mb-3 px-4 py-2 w-full break-words whitespace-pre-line">
            {{ form.comments.content }}
        </p>

        <!-- エラー表示 -->
        <client-error :errorFlag="form.comments.error !== ''" :text="form.comments.error" />
        <server-error
            :errorFlag="$page.props.errors"
            :errors="
                Object.entries($page.props.errors).filter((e) => {
                    return /comments/.test(e[0]);
                })
            "
        />

        <buttons />
    </div>
</template>
<script>
    import Buttons from "./Buttons";
    import ClientError from "../Utility/ClientError";
    import ServerError from "../Utility/ServerError";

    import { inject } from "vue";

    export default {
        components: {
            Buttons,
            ClientError,
            ServerError,
        },
        setup() {
            const form = inject("form");

            return { form };
        },
    };
</script>
