<template>
    <section-title title="使用技術" />
    <div class="grid grid-cols-1 md:grid-cols-2">
        <service-tech-field
            v-for="techField in techFields"
            :key="techField.id"
            :fieldname="techField.fieldname"
            :teches="techField.teches"
        />
    </div>
</template>

<script>
import SectionTitle from "./SectionTitle.vue";
import ServiceTechField from "./ServiceTechField.vue";

export default {
    components: {
        SectionTitle,
        ServiceTechField,
    },
    props: {
        techFields: Array,
    },
};
</script>
