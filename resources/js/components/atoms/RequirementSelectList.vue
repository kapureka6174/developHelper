<template>
    <div>
        <div
            v-if="requirements[index].title.decidable"
            class="
                w-4/5
                bg-gray-200
                flex
                items-center
                rounded-md
                py-3
                my-1
                mx-auto
            "
        >
            <input
                type="checkbox"
                class="form-checkbox h-5 w-5 text-green-600 rounded mx-2"
                v-model="requirements[index].title.selected"
            />
            <p class="font-bold text-gray-600 w-4/5">
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
