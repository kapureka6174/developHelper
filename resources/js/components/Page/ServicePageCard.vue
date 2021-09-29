<template>
    <div class="bg-blue-400 rounded m-3">
        <h1
            class="
                text-white text-xl
                font-semibold
                my-3
                mx-auto
                w-4/5
                text-center
            "
        >
            {{ pagename }}
        </h1>
        <service-page-requirement
            v-for="requirement in requirements"
            :key="requirement.id"
            :title="requirement.title"
        />
    </div>
</template>

<script>
import ServicePageRequirement from "./ServicePageRequirement";

export default {
    components: {
        ServicePageRequirement,
    },
    props: {
        pagename: String,
        requirements: Array,
    },
};
</script>
