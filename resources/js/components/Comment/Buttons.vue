<template>
    <div class="flex justify-end w-full">
        <!-- 編集と通常表示との切り替え -->
        <button
            v-if="!form.comments.decidable"
            class="mr-3 w-16 h-10 text-white hover:bg-indigo-400 bg-indigo-600 rounded"
            @click="input"
        >
            決定
        </button>
        <button
            v-else
            class="mr-3 w-16 h-10 text-white hover:bg-indigo-400 bg-indigo-600 rounded"
            @click="form.comments.decidable = false"
        >
            編集
        </button>

        <!-- ゲスト表示 -->
        <button
            v-if="$page.props.user == null"
            class="group relative w-16 h-10 text-white hover:bg-indigo-400 bg-indigo-600 rounded"
        >
            投稿
            <div
                class="
                    absolute
                    bottom-full
                    right-1
                    mb-2
                    px-3
                    py-2
                    w-32
                    text-center text-gray-600 text-xs
                    bg-gray-200
                    rounded-lg
                    opacity-0
                    group-hover:opacity-100
                    pointer-events-none
                "
            >
                ログインが必要です
                <svg
                    class="absolute left-0 top-full w-full h-2 text-gray-200"
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
            class="w-16 h-10 text-white hover:bg-indigo-400 bg-indigo-600 rounded"
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
