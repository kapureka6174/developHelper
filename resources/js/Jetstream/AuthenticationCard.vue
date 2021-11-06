<template>
    <div class="flex flex-col items-center pt-6 min-h-screen bg-gray-100 sm:justify-center sm:pt-0">
        <div>
            <slot name="logo" />
        </div>

        <div
            class="
                mb-6
                px-6
                py-4
                w-full
                bg-white
                shadow-md
                overflow-hidden
                sm:max-w-md sm:rounded-lg
            "
        >
            <slot />
        </div>
    </div>
</template>
