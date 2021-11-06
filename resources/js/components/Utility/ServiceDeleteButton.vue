<template>
    <button
        v-if="$page.props.user !== null && $page.props.user.id == $page.props.service.user_id"
        class="w-12 h-8 text-white hover:bg-red-400 bg-red-600 rounded"
    >
        削除
    </button>
</template>
