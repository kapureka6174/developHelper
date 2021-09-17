<template>
    <section-title title="要件定義" />
    <div>
        <div class="container px-5 py-2">
            <div class="flex flex-wrap">
                <service-requirement-detail
                    v-for="requirement in requirements"
                    :key="requirement.id"
                    :title="requirement.title"
                    :content="requirement.content"
                />
            </div>
        </div>
    </div>
</template>
<script>
import SectionTitle from "./SectionTitle.vue";
import ServiceRequirementDetail from "./ServiceRequirementDetail.vue";

export default {
    components: {
        SectionTitle,
        ServiceRequirementDetail,
    },
    props: {
        requirements: Array,
    },
};
</script>
