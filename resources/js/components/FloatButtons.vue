<template>
    <div>
        <!-- レスポンシブなボタン -->
        <responsive-heart-button :liked_by_user="liked_by_user" @click="like" />
        <responsive-twitter-button />
        <responsive-copy-button />
        <responsive-comment-button />

        <!-- 通常表示のボタン -->
        <div class="min-h-screen col-span-1 justify-center hidden md:flex">
            <div class="flex flex-col fixed">
                <heart-button :liked_by_user="liked_by_user" @click="like" />
                <twitter-button />
                <comment-button />
                <copy-button />
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

import { Inertia } from "@inertiajs/inertia";

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
    },
    setup(props) {
        const like = () => {
            if (props.liked_by_user) {
                Inertia.delete(`/services/${props.service_id}/unlike`, "", {
                    preserveScroll: true,
                });
            } else {
                Inertia.put(`/services/${props.service_id}/like`, "", {
                    preserveScroll: true,
                });
            }
        };
        return { like };
    },
};
</script>
