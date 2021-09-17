<template>
    <div>
        <!-- レスポンシブなボタン -->
        <responsive-heart-button :liked_by_user="liked_by_user" @click="like" />
        <responsive-twitter-button />
        <responsive-copy-button @click="copy($page.url)" :copied="copied" />
        <responsive-comment-button @click="ScrollTo('#comment')" />

        <!-- 通常表示のボタン -->
        <div class="min-h-screen col-span-1 justify-center hidden md:flex">
            <div class="flex flex-col fixed">
                <heart-button :liked_by_user="liked_by_user" @click="like" />
                <twitter-button />
                <copy-button @click="copy($page.url)" :copied="copied" />
                <comment-button @click="ScrollTo('#comment')" />
            </div>
        </div>
    </div>
</template>

<script>
import ResponsiveHeartButton from "./atoms/ResponsiveHeartButton.vue";
import ResponsiveTwitterButton from "./atoms/ResponsiveTwitterButton.vue";
import ResponsiveCopyButton from "./atoms/ResponsiveCopyButton.vue";
import ResponsiveCommentButton from "./atoms/ResponsiveCommentButton.vue";
import HeartButton from "./atoms/HeartButton.vue";
import TwitterButton from "./atoms/TwitterButton.vue";
import CopyButton from "./atoms/CopyButton.vue";
import CommentButton from "./atoms/CommentButton.vue";
import { scroller } from "vue-scrollto/src/scrollTo";

import { Inertia } from "@inertiajs/inertia";
import { ref } from "vue";

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

        // URLをコピー
        let copied = ref(false);
        const copy = (url) => {
            navigator.clipboard.writeText(`http://localhost:8000${url}`);
            copied.value = true;
            setTimeout(() => {
                copied.value = false;
            }, 2000);
        };

        const ScrollTo = scroller();

        return { like, copy, copied, ScrollTo };
    },
};
</script>
