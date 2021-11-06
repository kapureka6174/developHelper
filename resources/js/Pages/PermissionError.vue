<template>
    <app-layout>
        <template #header>
            <h2 class="text-gray-800 text-xl font-semibold leading-tight">編集画面</h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="p-6 pr-10 text-red-900 bg-red-200 rounded-lg shadow-md">
                    {{ errorMessage }}
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
    import AppLayout from "@/Layouts/AppLayout";

    export default {
        components: {
            AppLayout,
        },
        props: {
            errorMessage: String,
        },
    };
</script>
