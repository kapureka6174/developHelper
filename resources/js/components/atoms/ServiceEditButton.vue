<template>
    <button
        v-if="
            $page.props.user !== null &&
            $page.props.user.id == $page.props.service.user_id
        "
        class="
            bg-indigo-600
            hover:bg-indigo-400
            h-8
            w-12
            text-white
            rounded
            mr-3
        "
    >
        <inertia-link :href="route('Edit', { id: $page.props.service.id })">
            編集
        </inertia-link>
    </button>
</template>
