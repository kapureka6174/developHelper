<template>
    <div v-if="success" class="alert">
        <div class="fixed top-0 right-0 m-6">
            <div
                class="
                    rounded-lg
                    shadow-md
                    p-6
                    pr-10
                    bg-green-200
                    text-green-900
                "
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
                    {{ success }}
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import { onUpdated, onMounted } from "vue";
export default {
    props: {
        success: String,
    },
    setup(props, ctx) {
        onMounted(() => {
            setTimeout(() => ctx.emit("deleteFlash"), 3000);
        });
        onUpdated(() => {
            if (props.success) {
                setTimeout(() => ctx.emit("deleteFlash"), 3000);
            }
        });
    },
};
</script>
