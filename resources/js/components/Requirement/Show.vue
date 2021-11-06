<template>
    <section-title title="要件定義" />
    <div>
        <div class="container px-5 py-2">
            <div class="flex flex-wrap">
                <details
                    class="mb-1 w-full"
                    v-for="requirement in requirements"
                    :key="requirement.id"
                >
                    <summary class="px-4 py-2 font-semibold bg-gray-200 rounded-md">
                        {{ requirement.title }}
                    </summary>
                    <p
                        class="
                            text-grey-600
                            p-4
                            break-words
                            whitespace-pre-line
                            font-bold
                            bg-gray-100
                            border-2 border-white
                            rounded-md
                        "
                    >
                        {{ requirement.content }}
                    </p>
                </details>
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
            requirements: Array,
        },
    };
</script>
