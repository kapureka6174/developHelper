<template>
    <div class="pt-3">
        <section-title title="サービス概要" />
        <p class="mb-3 mt-2 px-4 py-2 text-gray-600 break-words whitespace-pre-line text-xl">
            {{ description }}
        </p>
    </div>
</template>

<script>
    import SectionTitle from "../Utility/SectionTitle";

    export default {
        components: {
            SectionTitle,
        },
        props: {
            description: String,
        },
    };
</script>
