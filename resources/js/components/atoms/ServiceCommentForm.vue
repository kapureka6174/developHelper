<template>
    <div class="w-full bg-gray-100 p-4 flex flex-col" id="comment">
        <service-comment-type-select />
        <service-comment-input />
        <service-comment-error />
        <service-comment-buttons />
    </div>
</template>
<script>
import ServiceCommentTypeSelect from "./ServiceCommentTypeSelect.vue";
import ServiceCommentInput from "./ServiceCommentInput.vue";
import ServiceCommentError from "./ServiceCommentError.vue";
import ServiceCommentButtons from "./ServiceCommentButtons.vue";

export default {
    components: {
        ServiceCommentTypeSelect,
        ServiceCommentInput,
        ServiceCommentError,
        ServiceCommentButtons,
    },
};
</script>
