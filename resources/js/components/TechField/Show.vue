<template>
    <section-title title="使用技術" />
    <div class="grid grid-cols-1 md:grid-cols-2">
        <div
            v-for="techField in techFields"
            :key="techField.id"
            class="bg-blue-200 m-2 rounded p-3"
        >
            <div>
                <h3 class="text-2xl text-gray-600 font-bold pb-1">
                    {{ techField.fieldname }}
                </h3>
                <div
                    v-for="tech in techField.teches"
                    :key="tech.id"
                    class="grid grid-cols-2"
                >
                    <p class="text-xl text-indigo-600 font-semibold">
                        {{ tech.techname }}
                    </p>
                    <p class="text-xl text-indigo-600 font-semibold">
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
