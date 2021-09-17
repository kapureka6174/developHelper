<template>
    <div>
        <section-title title="URI設計" />
        <div class="overflow-x-auto">
            <div class="rounded-t-lg m-5 mx-auto bg-gray-200 text-gray-800">
                <service-uri-design-header />
                <service-uri-design-main
                    v-for="(uri, index) in uris"
                    :key="index"
                    :uri="uri.uri"
                    :method="uri.method"
                    :explain="uri.explain"
                />
            </div>
        </div>
    </div>
</template>

<script>
import SectionTitle from "./SectionTitle.vue";
import ServiceUriDesignHeader from "./ServiceUriDesignHeader.vue";
import ServiceUriDesignMain from "./ServiceUriDesignMain.vue";

export default {
    components: {
        SectionTitle,
        ServiceUriDesignHeader,
        ServiceUriDesignMain,
    },
    props: {
        uris: Array,
    },
};
</script>
