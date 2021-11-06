<template>
    <div class="relative ml-3">
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
                                text-gray-500
                                hover:text-gray-700
                                text-sm
                                font-medium
                                leading-4
                                bg-white
                                border border-transparent
                                rounded-md
                                focus:outline-none
                                transition
                            "
                        >
                            {{ $page.props.user.name }}

                            <svg
                                class="-mr-0.5 ml-2 w-4 h-4"
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
                                    text-gray-500
                                    hover:text-gray-700
                                    text-sm
                                    font-medium
                                    leading-4
                                    bg-white
                                    border border-transparent
                                    rounded-md
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
                                    text-gray-500
                                    hover:text-gray-700
                                    text-sm
                                    font-medium
                                    leading-4
                                    bg-white
                                    border border-transparent
                                    rounded-md
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
                <div class="block px-4 py-2 text-gray-400 text-xs">アカウント管理</div>

                <jet-dropdown-link :href="route('profile.show')"> プロフィール </jet-dropdown-link>

                <div class="border-t border-gray-100"></div>

                <!-- Authentication -->
                <form @submit.prevent="logout">
                    <jet-dropdown-link as="button"> ログアウト </jet-dropdown-link>
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
