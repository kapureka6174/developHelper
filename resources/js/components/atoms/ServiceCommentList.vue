<template>
    <div class="rounded-md bg-gray-100 w-full my-3 p-5">
        <div class="flex items-center">
            <h1 class="text-gray-600 font-bold text-2xl mr-2">
                {{ username }}
            </h1>
            <h2
                class="
                    text-gray-600
                    font-semibold
                    bg-blue-100
                    rounded
                    text-center
                    py-2
                    px-4
                "
            >
                {{ type }}
            </h2>
        </div>
        <p class="text-gray-600 mt-2">
            {{ content }}
        </p>
    </div>
</template>

<script>
export default {
    props: {
        username: String,
        type: String,
        content: String,
    },
};
</script>
