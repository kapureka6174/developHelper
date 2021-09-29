<template>
    <div>
        <section-title title="コメント" />
        <service-comment-list
            v-for="comment in comments"
            :key="comment.id"
            :username="comment.user.name"
            :type="comment.type"
            :content="comment.content"
        />
    </div>
</template>
<script>
import SectionTitle from "../Utility/SectionTitle";
import ServiceCommentList from "./ServiceCommentList";

export default {
    components: {
        SectionTitle,
        ServiceCommentList,
    },
    props: {
        comments: Array,
    },
};
</script>
