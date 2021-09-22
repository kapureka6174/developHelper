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
import SectionTitle from "./SectionTitle.vue";
import ServiceCommentList from "./ServiceCommentList.vue";

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
