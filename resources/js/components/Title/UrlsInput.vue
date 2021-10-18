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
                v-on:blur="github_url.error = ''"
            />

            <!-- 通常表示 -->
            <p
                v-else
                class="
                    md:text-base
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

            <!-- エラー表示 -->
            <client-error
                :errorFlag="github_url.error !== ''"
                text="GitHubのURLが入力されていません。"
            />
            <server-error
                :errorFlag="Object.keys($page.props.errors).length"
                :errors="
                    Object.entries($page.props.errors).filter((e) => {
                        return /github_url/.test(e[0]);
                    })
                "
            />
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
                v-on:blur="site_url.error = ''"
            />

            <!-- 通常表示 -->
            <p
                v-else
                class="
                    md:text-base
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

            <!-- エラー表示 -->
            <client-error
                :errorFlag="site_url.error !== ''"
                text="サイトのURLが入力されていません。"
            />
            <server-error
                :errorFlag="Object.keys($page.props.errors).length"
                :errors="
                    Object.entries($page.props.errors).filter((e) => {
                        return /site_url/.test(e[0]);
                    })
                "
            />
        </div>
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
        const github_url = inject("github_url");
        const site_url = inject("site_url");

        const input = (value, type) => {
            if (!value) {
                type ? (github_url.error = true) : (site_url.error = true);
            } else {
                type ? (github_url.error = "") : (site_url.error = "");
                type
                    ? (github_url.decidable = true)
                    : (site_url.decidable = true);
            }
        };

        return { github_url, site_url, input };
    },
};
</script>
