<template>
    <div v-if="success" class="alert">
        <div class="fixed right-0 top-0 m-6">
            <div
                class="p-6 pr-10 text-green-900 bg-green-200 rounded-lg shadow-md"
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
