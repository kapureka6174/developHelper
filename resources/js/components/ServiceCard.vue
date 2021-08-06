<template>
    <div class="max-w-md py-4 px-8 bg-indigo-50 shadow-lg rounded-lg my-10">
        <div>
            <h2 class="text-gray-800 text-3xl font-semibold">
                {{ title }}
            </h2>
            <p class="mt-2 text-gray-600">
                {{ description }}
            </p>
        </div>
        <div class="flex justify-end mt-4">
            <inertia-link
                :href="route('User', { id: id })"
                class="text-xl font-medium text-indigo-500"
            >
                詳しくみる
            </inertia-link>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        id: Number,
        title: String,
        description: String,
    },
};
</script>
