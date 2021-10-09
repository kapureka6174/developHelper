<template>
    <div>
        <!-- レスポンシブなボタン -->
        <responsive-heart-button :liked_by_user="liked_by_user" @click="like" />
        <responsive-twitter-button @click="tweet($page.url)" />
        <responsive-copy-button @click="copy($page.url)" :copied="copied" />
        <responsive-comment-button @click="ScrollTo('#comment')" />

        <!-- 通常表示のボタン -->
        <div class="min-h-screen col-span-1 justify-center hidden md:flex">
            <div class="flex flex-col fixed">
                <heart-button :liked_by_user="liked_by_user" @click="like" />
                <twitter-button @click="tweet($page.url)" />
                <copy-button @click="copy($page.url)" :copied="copied" />
                <comment-button @click="ScrollTo('#comment')" />
            </div>
        </div>
    </div>
</template>

<script>
import ResponsiveHeartButton from "./ResponsiveHeartButton";
import ResponsiveTwitterButton from "./ResponsiveTwitterButton";
import ResponsiveCopyButton from "./ResponsiveCopyButton";
import ResponsiveCommentButton from "./ResponsiveCommentButton";
import HeartButton from "./HeartButton";
import TwitterButton from "./TwitterButton";
import CopyButton from "./CopyButton";
import CommentButton from "./CommentButton";
import { scroller } from "vue-scrollto/src/scrollTo";

import { Inertia } from "@inertiajs/inertia";
import { ref, inject } from "vue";

export default {
    components: {
        ResponsiveHeartButton,
        ResponsiveTwitterButton,
        ResponsiveCopyButton,
        ResponsiveCommentButton,
        HeartButton,
        TwitterButton,
        CopyButton,
        CommentButton,
    },
    props: {
        service_id: Number,
        liked_by_user: Boolean,
        user: Object,
    },
    setup(props) {
        // お気に入り処理
        const like = () => {
            if (props.user !== null) {
                if (props.liked_by_user == true) {
                    Inertia.delete(`/services/${props.service_id}/unlike`, "", {
                        preserveScroll: true,
                    });
                } else if (props.liked_by_user == false) {
                    Inertia.put(`/services/${props.service_id}/like`, "", {
                        preserveScroll: true,
                    });
                }
            }
        };

        // URLをクリップボードにコピー
        let copied = ref(false);
        const copy = (url) => {
            navigator.clipboard.writeText(
                `https://web-service-hub.herokuapp.com${url}`
            );
            copied.value = true;
            // 二秒後に自動で消える
            setTimeout(() => {
                copied.value = false;
            }, 2000);
        };

        // スクローラ―のインスタンス
        const ScrollTo = scroller();

        // Twitterへの投稿
        const title = inject("title");
        const tweet = (url) => {
            window.open(
                `https://twitter.com/share?text=${encodeURIComponent(
                    title
                )}&url=https://web-service-hub.herokuapp.com${encodeURIComponent(
                    url
                )}&hashtags=WebServiceHub`,
                "_blank"
            );
        };

        return { like, copy, tweet, copied, ScrollTo };
    },
};
</script>
