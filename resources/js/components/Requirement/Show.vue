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
                    <summary
                        class="font-semibold bg-gray-200 rounded-md py-2 px-4"
                    >
                        {{ requirement.title }}
                    </summary>
                    <p
                        class="
                            text-grey-600
                            font-bold
                            p-4
                            rounded-md
                            bg-gray-100
                            border-2 border-white
                            whitespace-pre-line
                            break-words
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
