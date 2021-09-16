<template>
    <div
        class="
            relative
            max-w-md
            py-4
            md:px-8
            px-4
            bg-indigo-50
            shadow-lg
            rounded-lg
            my-10
        "
    >
        <div>
            <div class="md:h-16 flex items-center">
                <h2 class="text-gray-800 text-2xl font-semibold line-clamp-2">
                    {{ title }}
                </h2>
            </div>
            <h4 class="h-48 mt-2 text-gray-600 line-clamp-8">
                {{ description }}
            </h4>
        </div>
        <div class="flex justify-between mt-4">
            <div class="flex items-center">
                <inertia-link
                    v-if="user"
                    :href="route('User', { id: user.id })"
                >
                    <img
                        v-if="user"
                        class="h-10 w-10 mr-2 rounded-full object-cover"
                        :src="user.profile_photo_url"
                        :alt="user.name"
                    />
                </inertia-link>
                <div>
                    <inertia-link
                        v-if="user"
                        :href="route('User', { id: user.id })"
                    >
                        <h2 class="w-40 text-gray-600 font-medium truncate">
                            作成者：{{ user.name }}
                        </h2>
                    </inertia-link>
                    <div class="text-gray-600 font-medium">
                        投稿日：{{ date.split("T")[0] }}
                    </div>
                </div>
            </div>
            <div>
                <div class="flex">
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

                <inertia-link
                    :href="route('Service', { id: id })"
                    class="text-xl font-medium text-indigo-500"
                >
                    詳しくみる
                </inertia-link>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        id: Number,
        title: String,
        description: String,
        user: Object,
        date: String,
        tags: Array,
        likes: Number,
        comments: Number,
    },
};
</script>
