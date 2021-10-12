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

        <!-- エラー表示 -->
        <client-error
            :errorFlag="description.error !== ''"
            :text="description.error"
        />
        <server-error
            :errorFlag="Object.keys($page.props.errors).length"
            :errors="
                Object.entries($page.props.errors).filter((e) => {
                    return /description/.test(e[0]);
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
        const description = inject("description");
        return { description };
    },
};
</script>
