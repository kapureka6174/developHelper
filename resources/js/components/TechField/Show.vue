<template>
    <section-title title="使用技術" />
    <div class="grid grid-cols-1 md:grid-cols-2">
        <div
            v-for="techField in techFields"
            :key="techField.id"
            class="m-2 p-3 bg-blue-200 rounded"
        >
            <div>
                <h3 class="pb-1 text-gray-600 text-2xl font-bold">
                    {{ techField.fieldname }}
                </h3>
                <div v-for="tech in techField.teches" :key="tech.id" class="grid grid-cols-2">
                    <p class="text-indigo-600 text-xl font-semibold">
                        {{ tech.techname }}
                    </p>
                    <p class="text-indigo-600 text-xl font-semibold">
                        {{ tech.version }}
                    </p>
                </div>
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
            techFields: Array,
        },
    };
</script>
