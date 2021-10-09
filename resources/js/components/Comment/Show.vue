<template>
    <div>
        <section-title title="コメント" />
        <div
            v-for="comment in comments"
            :key="comment.id"
            class="rounded-md bg-gray-100 w-full my-3 p-5"
        >
            <div class="flex items-center">
                <h1 class="text-gray-600 font-bold text-2xl mr-2">
                    {{ comment.user.name }}
                </h1>
                <h2
                    class="
                        text-gray-600
                        font-semibold
                        bg-blue-100
                        rounded
                        text-center
                        py-2
                        px-4
                    "
                >
                    {{ comment.type }}
                </h2>
            </div>
            <p class="text-gray-600 mt-2">
                {{ comment.content }}
            </p>
        </div>
    </div>
</template>
<script>
import SectionTitle from "../Utility/SectionTitle";

export default {
    components: {
        SectionTitle,
    },
    props: {
        comments: Array,
    },
};
</script>
