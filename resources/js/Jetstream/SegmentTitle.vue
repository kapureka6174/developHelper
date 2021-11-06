<template>
    <div class="flex justify-between md:col-span-1">
        <div class="px-4 sm:px-0">
            <h3 class="text-gray-900 text-lg font-medium">
                <slot name="title"></slot>
            </h3>

            <p class="mt-1 text-gray-600 text-sm">
                <slot name="description"></slot>
            </p>
        </div>

        <div class="px-4 sm:px-0">
            <slot name="aside"></slot>
        </div>
    </div>
</template>
