<template>
    <div class="max-w-md py-4 px-8 bg-indigo-50 shadow-lg rounded-lg my-10">
        <!-- 名前と紹介文 -->
        <div>
            <h2 class="text-gray-800 text-2xl font-semibold line-clamp-2">
                {{ name }}
            </h2>
            <p class="h-48 mt-2 text-gray-600 line-clamp-8">
                {{ introduction }}
            </p>
        </div>
        <div class="flex justify-between items-center mt-2">
            <div class="flex">
                <!-- いいね数とコメント数 -->
                <div class="flex items-center mr-2">
                    <svg
                        class="h-6 w-6 text-red-500"
                        width="24"
                        height="24"
                        viewBox="0 0 24 24"
                        stroke-width="2"
                        stroke="currentColor"
                        fill="none"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                    >
                        <path stroke="none" d="M0 0h24v24H0z" />
                        <path
                            d="M12 20l-7 -7a4 4 0 0 1 6.5 -6a.9 .9 0 0 0 1 0a4 4 0 0 1 6.5 6l-7 7"
                        />
                    </svg>
                    <p class="text-red-500">{{ likes }}</p>
                </div>
                <div class="flex items-center">
                    <svg
                        class="h-6 w-6 text-green-500"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"
                        />
                    </svg>

                    <p class="text-green-500">{{ comments }}</p>
                </div>
            </div>
            <!-- 詳細ページへのリンク -->
            <inertia-link
                :href="route('User', { id: id })"
                class="text-xl font-medium text-indigo-500"
            >
                <div>詳しくみる</div>
            </inertia-link>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        id: Number,
        name: String,
        introduction: String,
        likes: Number,
        comments: Number,
    },
};
</script>
