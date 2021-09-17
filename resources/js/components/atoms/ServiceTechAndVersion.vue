<template>
    <div class="grid grid-cols-2">
        <p class="text-xl text-indigo-600 font-semibold">
            {{ techname }}
        </p>
        <p class="text-xl text-indigo-600 font-semibold">
            {{ version }}
        </p>
    </div>
</template>

<script>
export default {
    props: {
        techname: String,
        version: String,
    },
};
</script>
