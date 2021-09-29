<template>
    <section-title title="ページ" />
    <div class="grid grid-cols-1 md:grid-cols-3 justify-between">
        <service-page-card
            v-for="page in pages"
            :key="page.id"
            :pagename="page.pagename"
            :requirements="page.requirements"
        />
    </div>
</template>

<script>
import SectionTitle from "../Utility/SectionTitle";
import ServicePageCard from "./ServicePageCard";

export default {
    components: {
        SectionTitle,
        ServicePageCard,
    },
    props: {
        pages: Array,
    },
};
</script>
