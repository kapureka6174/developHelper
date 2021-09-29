<template>
    <div class="bg-blue-200 m-2 rounded p-3">
        <div>
            <h3 class="text-2xl text-gray-600 font-bold pb-1">
                {{ fieldname }}
            </h3>
            <service-tech-and-version
                v-for="tech in teches"
                :key="tech.id"
                :techname="tech.techname"
                :version="tech.version"
            />
        </div>
    </div>
</template>

<script>
import ServiceTechAndVersion from "./ServiceTechAndVersion";

export default {
    components: {
        ServiceTechAndVersion,
    },
    props: {
        fieldname: String,
        teches: Array,
    },
};
</script>
