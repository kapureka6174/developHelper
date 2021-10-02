<template>
    <div class="flex md:flex-row flex-col">
        <div class="flex flex-col md:w-1/3 md:mr-3">
            <!-- GitHubのURL -->
            <input
                v-if="!github_url.decidable"
                class="rounded my-2"
                type="text"
                placeholder="サービスのGitHubのURLを入力してください"
                v-model="github_url.content"
                @keyup.enter="input($event.target.value, 'github')"
                v-on:blur="github_url.error = false"
            />

            <!-- 通常表示 -->
            <p
                v-else
                class="
                    md:text-2xl
                    font-bold
                    text-gray-700
                    mb-2
                    pt-3
                    break-words
                "
                @click="github_url.decidable = false"
            >
                {{ github_url.content }}
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
                v-if="github_url.error"
            >
                <strong class="font-bold"
                    >GitHubのURLが入力されていません。</strong
                >
            </div>

            <!-- エラー表示（サーバーサイド） -->
            <div v-if="Object.keys($page.props.errors).length">
                <div
                    v-for="(error, index) in Object.entries(
                        $page.props.errors
                    ).filter((e) => {
                        return /github_url/.test(e[0]);
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

        <div class="flex flex-col md:w-1/3">
            <!-- サイトのURL -->
            <input
                v-if="!site_url.decidable"
                class="rounded my-2"
                type="text"
                placeholder="サービスのURLを入力してください"
                v-model="site_url.content"
                @keyup.enter="input($event.target.value)"
                v-on:blur="site_url.error = false"
            />

            <!-- 通常表示 -->
            <p
                v-else
                class="
                    md:text-2xl
                    font-bold
                    text-gray-700
                    mb-2
                    pt-3
                    break-words
                "
                @click="site_url.decidable = false"
            >
                {{ site_url.content }}
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
                v-if="site_url.error"
            >
                <strong class="font-bold"
                    >サイトのURLが入力されていません。</strong
                >
            </div>

            <!-- エラー表示（サーバーサイド） -->
            <div v-if="Object.keys($page.props.errors).length">
                <div
                    v-for="(error, index) in Object.entries(
                        $page.props.errors
                    ).filter((e) => {
                        return /site_url/.test(e[0]);
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
    </div>
</template>
<script>
import { inject } from "vue";

export default {
    setup() {
        const github_url = inject("github_url");
        const site_url = inject("site_url");

        const input = (value, type) => {
            if (!value) {
                type ? (github_url.error = true) : (site_url.error = true);
            } else {
                type ? (github_url.error = false) : (site_url.error = false);
                type
                    ? (github_url.decidable = true)
                    : (site_url.decidable = true);
            }
        };

        return { github_url, site_url, input };
    },
};
</script>
