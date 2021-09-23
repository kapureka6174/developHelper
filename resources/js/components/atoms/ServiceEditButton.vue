<template>
    <inertia-link :href="route('Edit', { id: $page.props.service.id })">
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
            編集
        </button>
    </inertia-link>
</template>
