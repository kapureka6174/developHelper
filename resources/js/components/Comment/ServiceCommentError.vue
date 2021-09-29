<template>
    <div v-if="$page.props.errors.comments">
        <div
            v-for="(error, index) in Object.values($page.props.errors.comments)"
            :key="index"
            class="
                bg-red-100
                border border-red-400
                text-red-700
                px-4
                py-3
                rounded
                my-2
            "
            role="alert"
        >
            <p class="font-bold">
                {{ error }}
            </p>
        </div>
    </div>
</template>
