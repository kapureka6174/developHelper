<template>
    <div class="md:grid md:gap-6 md:grid-cols-3">
        <jet-section-title>
            <template #title><slot name="title"></slot></template>
            <template #description><slot name="description"></slot></template>
        </jet-section-title>

        <div class="mt-5 md:col-span-2 md:mt-0">
            <div class="px-4 py-5 bg-white shadow sm:p-6 sm:rounded-lg">
                <slot name="content"></slot>
            </div>
        </div>
    </div>
</template>

<script>
    import JetSectionTitle from "./SegmentTitle";

    export default {
        components: {
            JetSectionTitle,
        },
    };
</script>
