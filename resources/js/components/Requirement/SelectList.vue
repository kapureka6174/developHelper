<template>
    <div>
        <div
            v-if="requirements[index].title.decidable"
            class="flex items-center mx-auto my-1 py-3 w-4/5 bg-gray-200 rounded-md"
        >
            <input
                type="checkbox"
                class="form-checkbox mx-2 w-5 h-5 text-green-600 rounded"
                v-model="requirements[index].title.selected"
            />
            <p class="w-4/5 text-gray-600 font-bold">
                {{ requirements[index].title.content }}
            </p>
        </div>
    </div>
</template>
<script>
    import { inject } from "vue";
    export default {
        props: {
            index: Number,
        },
        setup() {
            const requirements = inject("requirements");
            return { requirements };
        },
    };
</script>
