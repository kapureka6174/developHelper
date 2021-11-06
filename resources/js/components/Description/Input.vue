<template>
    <div>
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
            rows="10"
            placeholder="サービスの説明を入力してください。"
            v-if="!description.decidable"
            v-model="description.content"
        ></textarea>
        <!-- 通常表示 -->
        <p
            class="
                mb-3
                mt-2
                px-4
                py-2
                text-gray-700
                break-words
                whitespace-pre-line
                text-xl
                font-bold
            "
            v-else
        >
            {{ description.content }}
        </p>

        <!-- エラー表示 -->
        <client-error :errorFlag="description.error !== ''" :text="description.error" />
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
