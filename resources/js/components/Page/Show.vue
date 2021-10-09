<template>
    <section-title title="ページ" />
    <div class="grid grid-cols-1 md:grid-cols-3 justify-between">
        <div
            class="bg-blue-400 rounded m-3"
            v-for="page in pages"
            :key="page.id"
        >
            <h1
                class="
                    text-white text-xl
                    font-semibold
                    my-3
                    mx-auto
                    w-4/5
                    text-center
                "
            >
                {{ page.pagename }}
            </h1>
            <div
                class="w-full"
                v-for="requirement in page.requirements"
                :key="requirement.id"
            >
                <p
                    class="
                        font-bold
                        text-gray-600
                        bg-gray-200
                        rounded-md
                        py-2
                        px-4
                        w-4/5
                        mx-auto
                        mb-4
                        text-center
                    "
                >
                    {{ requirement.title }}
                </p>
            </div>
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
        pages: Array,
    },
};
</script>
