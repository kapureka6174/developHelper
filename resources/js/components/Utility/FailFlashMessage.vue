<template>
    <div v-if="fail" class="alert">
        <div class="fixed right-0 top-0 m-6">
            <div
                class="p-6 pr-10 text-red-900 bg-red-200 rounded-lg shadow-md"
                style="min-width: 240px"
            >
                <button
                    class="
                        absolute
                        right-0
                        top-0
                        px-3
                        py-2
                        hover:opacity-100
                        opacity-75
                        cursor-pointer
                    "
                    @click.prevent="$emit('delete')"
                >
                    ×
                </button>
                <div class="flex items-center">
                    {{ fail }}
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    import { onUpdated } from "vue";
    export default {
        props: {
            fail: String,
        },
        setup(props, ctx) {
            onUpdated(() => {
                if (props.fail) {
                    setTimeout(() => ctx.emit("deleteFlash"), 3000);
                }
            });
        },
    };
</script>
