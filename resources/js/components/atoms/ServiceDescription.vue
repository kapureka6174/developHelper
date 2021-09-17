<template>
    <div class="pt-3">
        <section-title title="サービス概要" />
        <p
            class="
                whitespace-pre-line
                mt-2
                py-2
                px-4
                mb-3
                text-xl text-gray-600
                break-words
            "
        >
            {{ description }}
        </p>
    </div>
</template>

<script>
import SectionTitle from "./SectionTitle.vue";

export default {
    components: {
        SectionTitle,
    },
    props: {
        description: String,
    },
};
</script>
