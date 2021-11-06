<template>
    <div class="md:grid md:gap-6 md:grid-cols-3">
        <jet-section-title>
            <template #title><slot name="title"></slot></template>
            <template #description><slot name="description"></slot></template>
        </jet-section-title>

        <div class="mt-5 md:col-span-2 md:mt-0">
            <form @submit.prevent="$emit('submitted')">
                <div
                    class="px-4 py-5 bg-white shadow sm:p-6"
                    :class="hasActions ? 'sm:rounded-tl-md sm:rounded-tr-md' : 'sm:rounded-md'"
                >
                    <div class="grid gap-6 grid-cols-6">
                        <slot name="form"></slot>
                    </div>
                </div>

                <div
                    class="
                        flex
                        items-center
                        justify-end
                        px-4
                        py-3
                        text-right
                        bg-gray-50
                        shadow
                        sm:px-6 sm:rounded-bl-md sm:rounded-br-md
                    "
                    v-if="hasActions"
                >
                    <slot name="actions"></slot>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
    import JetSectionTitle from "./SegmentTitle";

    export default {
        emits: ["submitted"],

        components: {
            JetSectionTitle,
        },

        computed: {
            hasActions() {
                return !!this.$slots.actions;
            },
        },
    };
</script>
