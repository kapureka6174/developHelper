<template>
    <div
        class="
            bg-gray-100
            border-b border-gray-200
            flex flex-nowrap
            items-center
            overflow-x-auto
            max-h-40
            w-full
        "
    >
        <div class="flex-none px-4 py-3 md:w-2/12 break-words text-center">
            {{ uri }}
        </div>
        <div class="flex-none px-4 py-3 w-20 md:w-2/12 break-words text-center">
            {{ method }}
        </div>
        <div class="flex-none px-4 py-3 md:w-8/12 text-center">
            {{ explain }}
        </div>
    </div>
</template>

<script>
export default {
    props: {
        uri: String,
        method: String,
        explain: String,
    },
};
</script>
