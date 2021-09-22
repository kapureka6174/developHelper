<template>
    <div v-if="fail" class="alert">
        <div class="fixed top-0 right-0 m-6">
            <div
                class="rounded-lg shadow-md p-6 pr-10 bg-red-200 text-red-900"
                style="min-width: 240px"
            >
                <button
                    class="
                        opacity-75
                        cursor-pointer
                        absolute
                        top-0
                        right-0
                        py-2
                        px-3
                        hover:opacity-100
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
