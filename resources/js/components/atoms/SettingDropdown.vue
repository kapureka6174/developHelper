<template>
    <div class="ml-3 relative">
        <jet-dropdown align="right" width="48">
            <template #trigger>
                <template v-if="$page.props.user">
                    <span class="inline-flex rounded-md">
                        <button
                            type="button"
                            class="
                                inline-flex
                                items-center
                                px-3
                                py-2
                                border border-transparent
                                text-sm
                                leading-4
                                font-medium
                                rounded-md
                                text-gray-500
                                bg-white
                                hover:text-gray-700
                                focus:outline-none
                                transition
                            "
                        >
                            {{ $page.props.user.name }}

                            <svg
                                class="ml-2 -mr-0.5 h-4 w-4"
                                xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 20 20"
                                fill="currentColor"
                            >
                                <path
                                    fill-rule="evenodd"
                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                    clip-rule="evenodd"
                                />
                            </svg>
                        </button>
                    </span>
                </template>

                <template v-else>
                    <span>
                        <inertia-link :href="route('login')">
                            <button
                                type="button"
                                class="
                                    inline-flex
                                    items-center
                                    px-3
                                    py-2
                                    border border-transparent
                                    text-sm
                                    leading-4
                                    font-medium
                                    rounded-md
                                    text-gray-500
                                    bg-white
                                    hover:text-gray-700
                                    focus:outline-none
                                    transition
                                "
                            >
                                ログイン
                            </button>
                        </inertia-link>
                    </span>

                    <span>
                        <inertia-link :href="route('register')">
                            <button
                                type="button"
                                class="
                                    inline-flex
                                    items-center
                                    px-3
                                    py-2
                                    border border-transparent
                                    text-sm
                                    leading-4
                                    font-medium
                                    rounded-md
                                    text-gray-500
                                    bg-white
                                    hover:text-gray-700
                                    focus:outline-none
                                    transition
                                "
                            >
                                アカウント作成
                            </button>
                        </inertia-link>
                    </span>
                </template>
            </template>

            <template #content v-if="$page.props.user">
                <!-- Account Management -->
                <div class="block px-4 py-2 text-xs text-gray-400">
                    アカウント管理
                </div>

                <jet-dropdown-link :href="route('profile.show')">
                    プロフィール
                </jet-dropdown-link>

                <div class="border-t border-gray-100"></div>

                <!-- Authentication -->
                <form @submit.prevent="logout">
                    <jet-dropdown-link as="button">
                        ログアウト
                    </jet-dropdown-link>
                </form>
            </template>
        </jet-dropdown>
    </div>
</template>

<script>
import JetDropdown from "@/Jetstream/Dropdown";
import JetDropdownLink from "@/Jetstream/DropdownLink";

export default {
    components: {
        JetDropdown,
        JetDropdownLink,
    },

    methods: {
        logout() {
            this.$inertia.post(route("logout"));
        },
    },
};
</script>
