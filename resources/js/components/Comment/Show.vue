<template>
    <div>
        <section-title title="コメント" />
        <div
            v-for="comment in comments"
            :key="comment.id"
            class="my-3 p-5 w-full bg-gray-100 rounded-md"
        >
            <div class="flex items-center">
                <h1 class="mr-2 text-gray-600 text-2xl font-bold">
                    {{ comment.user.name }}
                </h1>
                <h2 class="px-4 py-2 text-center text-gray-600 font-semibold bg-blue-100 rounded">
                    {{ comment.type }}
                </h2>
            </div>
            <p class="mt-2 text-gray-600">
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
