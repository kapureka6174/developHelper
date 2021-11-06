<template>
    <section-title title="ページ" />
    <div class="grid grid-cols-1 justify-between md:grid-cols-3">
        <div class="m-3 bg-blue-400 rounded" v-for="page in pages" :key="page.id">
            <h1 class="mx-auto my-3 w-4/5 text-center text-white text-xl font-semibold">
                {{ page.pagename }}
            </h1>
            <div class="w-full" v-for="requirement in page.requirements" :key="requirement.id">
                <p
                    class="
                        mb-4
                        mx-auto
                        px-4
                        py-2
                        w-4/5
                        text-center text-gray-600
                        font-bold
                        bg-gray-200
                        rounded-md
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
