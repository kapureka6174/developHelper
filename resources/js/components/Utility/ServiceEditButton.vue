<template>
    <inertia-link :href="route('Edit', { id: $page.props.service.id })">
        <button
            v-if="$page.props.user !== null && $page.props.user.id == $page.props.service.user_id"
            class="mr-3 w-12 h-8 text-white hover:bg-indigo-400 bg-indigo-600 rounded"
        >
            編集
        </button>
    </inertia-link>
</template>
