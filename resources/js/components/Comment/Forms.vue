<template>
    <div class="w-full bg-gray-100 p-4 flex flex-col" id="comment">
        <!-- コメントの項目選択 -->
        <select
            class="
                w-32
                rounded
                border border-gray-200
                focus:outline-none
                focus:ring-1
                focus:ring-blue-500
                focus:border-blue-500
                mb-3
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
            v-model="form.comments.content"
            v-if="!form.comments.decidable"
            rows="10"
        ></textarea>
        <!-- 通常表示 -->
        <p v-else class="py-2 px-4 mb-3 w-full whitespace-pre-line break-words">
            {{ form.comments.content }}
        </p>

        <!-- エラー表示 -->
        <client-error
            :errorFlag="form.comments.error"
            text="コメントが入力されていません。"
        />
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
