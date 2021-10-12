<template>
    <div class="flex justify-end w-full">
        <!-- 編集と通常表示との切り替え -->
        <button
            v-if="!form.comments.decidable"
            class="
                bg-indigo-600
                hover:bg-indigo-400
                h-10
                w-16
                mr-3
                text-white
                rounded
            "
            @click="input"
        >
            決定
        </button>
        <button
            v-else
            class="
                bg-indigo-600
                hover:bg-indigo-400
                h-10
                w-16
                mr-3
                text-white
                rounded
            "
            @click="form.comments.decidable = false"
        >
            編集
        </button>

        <!-- ゲスト表示 -->
        <button
            v-if="$page.props.user == null"
            class="
                bg-indigo-600
                hover:bg-indigo-400
                h-10
                w-16
                text-white
                rounded
                group
                relative
            "
        >
            投稿
            <div
                class="
                    opacity-0
                    w-32
                    bg-gray-200
                    text-gray-600 text-center text-xs
                    rounded-lg
                    py-2
                    absolute
                    group-hover:opacity-100
                    bottom-full
                    right-1
                    mb-2
                    px-3
                    pointer-events-none
                "
            >
                ログインが必要です
                <svg
                    class="absolute text-gray-200 h-2 w-full left-0 top-full"
                    x="0px"
                    y="0px"
                    viewBox="0 0 255 255"
                    xml:space="preserve"
                >
                    <polygon class="fill-current" points="0,0 255,255 255,0" />
                </svg>
            </div>
        </button>

        <!-- ログイン時の表示 -->
        <button
            v-else
            class="
                bg-indigo-600
                hover:bg-indigo-400
                h-10
                w-16
                text-white
                rounded
            "
            @click="commentSubmit"
        >
            投稿
        </button>
    </div>
</template>

<script>
import { inject } from "vue";
import { Inertia } from "@inertiajs/inertia";

export default {
    setup() {
        const form = inject("form");

        const input = () => {
            if (!form.comments.content) {
                form.comments.error = "コメントが入力されていません。";
            } else {
                form.comments.error = "";
                form.comments.decidable = true;
            }
        };

        // CommentControllerにformを渡す
        const commentSubmit = () => {
            Inertia.post(route("Comment"), form, {
                preserveScroll: true,
            });
        };

        return { form, input, commentSubmit };
    },
};
</script>
