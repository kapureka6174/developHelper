<template>
    <button
        v-if="
            $page.props.user !== null &&
            $page.props.user.id == $page.props.service.user_id
        "
        class="bg-red-600 hover:bg-red-400 h-8 w-12 text-white rounded"
    >
        削除
    </button>
</template>
