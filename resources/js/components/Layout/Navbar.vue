<template>
    <nav class="bg-white border-b border-gray-100">
        <!-- Primary Navigation Menu -->
        <div class="mx-auto px-4 max-w-7xl sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex">
                    <!-- Logo -->
                    <div class="flex flex-shrink-0 items-center">
                        <inertia-link :href="route('Home')">
                            <jet-application-mark class="block w-auto h-9" />
                        </inertia-link>
                    </div>

                    <!-- Navigation Links -->
                    <div class="hidden space-x-8 sm:flex sm:-my-px sm:ml-10">
                        <jet-nav-link :href="route('Home')" :active="route().current('Home')">
                            ホーム
                        </jet-nav-link>
                    </div>
                    <div class="hidden space-x-8 sm:flex sm:-my-px sm:ml-10">
                        <jet-nav-link
                            :href="route('Services')"
                            :active="route().current('Services')"
                        >
                            サービス
                        </jet-nav-link>
                    </div>
                    <div class="hidden space-x-8 sm:flex sm:-my-px sm:ml-10">
                        <jet-nav-link :href="route('Users')" :active="route().current('Users')">
                            開発者
                        </jet-nav-link>
                    </div>
                    <div class="hidden space-x-8 sm:flex sm:-my-px sm:ml-10">
                        <jet-nav-link :href="route('Create')" :active="route().current('Create')">
                            新規作成
                        </jet-nav-link>
                    </div>
                    <div
                        v-if="$page.props.user !== null"
                        class="hidden space-x-8 sm:flex sm:-my-px sm:ml-10"
                    >
                        <jet-nav-link
                            :href="route('User', { id: $page.props.user.id })"
                            :active="
                                route().current('User', {
                                    id: $page.props.user.id,
                                })
                            "
                        >
                            マイページ
                        </jet-nav-link>
                    </div>
                </div>

                <div class="hidden sm:flex sm:items-center sm:ml-6">
                    <setting-dropdown />
                </div>

                <!-- Hamburger -->
                <div class="flex items-center -mr-2 sm:hidden">
                    <button
                        @click="showingNavigationDropdown = !showingNavigationDropdown"
                        class="
                            inline-flex
                            items-center
                            justify-center
                            p-2
                            text-gray-400
                            hover:text-gray-500
                            focus:text-gray-500
                            hover:bg-gray-100
                            focus:bg-gray-100
                            rounded-md
                            focus:outline-none
                            transition
                        "
                    >
                        <svg class="w-6 h-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                            <path
                                :class="{
                                    hidden: showingNavigationDropdown,
                                    'inline-flex': !showingNavigationDropdown,
                                }"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16"
                            />
                            <path
                                :class="{
                                    hidden: !showingNavigationDropdown,
                                    'inline-flex': showingNavigationDropdown,
                                }"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M6 18L18 6M6 6l12 12"
                            />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Responsive Navigation Menu -->
        <div
            :class="{
                block: showingNavigationDropdown,
                hidden: !showingNavigationDropdown,
            }"
            class="sm:hidden"
        >
            <div class="pb-3 pt-2 space-y-1">
                <jet-responsive-nav-link :href="route('Home')" :active="route().current('Home')">
                    ホーム
                </jet-responsive-nav-link>
            </div>

            <div class="pb-3 pt-2 space-y-1">
                <jet-responsive-nav-link
                    :href="route('Services')"
                    :active="route().current('Services')"
                >
                    サービス
                </jet-responsive-nav-link>
            </div>

            <div class="pb-3 pt-2 space-y-1">
                <jet-responsive-nav-link :href="route('Users')" :active="route().current('Users')">
                    開発者
                </jet-responsive-nav-link>
            </div>

            <div class="pb-3 pt-2 space-y-1">
                <jet-responsive-nav-link
                    :href="route('Create')"
                    :active="route().current('Create')"
                >
                    新規作成
                </jet-responsive-nav-link>
            </div>

            <div v-if="$page.props.user !== null" class="pb-3 pt-2 space-y-1">
                <jet-responsive-nav-link
                    :href="route('User', { id: $page.props.user.id })"
                    :active="
                        route().current('User', {
                            id: $page.props.user.id,
                        })
                    "
                >
                    マイページ
                </jet-responsive-nav-link>
            </div>

            <!-- Responsive Settings Options -->
            <div class="pb-1 pt-4 border-t border-gray-200">
                <div class="flex items-center px-4">
                    <div
                        v-if="$page.props.jetstream.managesProfilePhotos && $page.props.user"
                        class="flex-shrink-0 mr-3"
                    >
                        <img
                            class="w-10 h-10 rounded-full object-cover"
                            :src="$page.props.user.profile_photo_url"
                            :alt="$page.props.user.name"
                        />
                    </div>

                    <div v-if="$page.props.user">
                        <div class="text-gray-800 text-base font-medium">
                            {{ $page.props.user.name }}
                        </div>
                        <div class="text-gray-500 text-sm font-medium">
                            {{ $page.props.user.email }}
                        </div>
                    </div>
                </div>

                <div class="mt-3 space-y-1" v-if="$page.props.user">
                    <jet-responsive-nav-link
                        :href="route('profile.show')"
                        :active="route().current('profile.show')"
                    >
                        プロフィール
                    </jet-responsive-nav-link>

                    <!-- Authentication -->
                    <form method="POST" @submit.prevent="logout">
                        <jet-responsive-nav-link as="button"> ログアウト </jet-responsive-nav-link>
                    </form>
                </div>

                <div class="mt-3 space-y-1" v-else>
                    <jet-responsive-nav-link :href="route('login')">
                        ログイン
                    </jet-responsive-nav-link>

                    <jet-responsive-nav-link :href="route('register')">
                        アカウント作成
                    </jet-responsive-nav-link>
                </div>
            </div>
        </div>
    </nav>
</template>

<script>
    import JetApplicationMark from "@/Jetstream/ApplicationMark";
    import JetNavLink from "@/Jetstream/NavLink";
    import JetResponsiveNavLink from "@/Jetstream/ResponsiveNavLink";
    import SettingDropdown from "./SettingDropdown";

    export default {
        components: {
            JetApplicationMark,
            JetNavLink,
            JetResponsiveNavLink,
            SettingDropdown,
        },

        methods: {
            logout() {
                this.$inertia.post(route("logout"));
            },
        },

        data() {
            return {
                showingNavigationDropdown: false,
            };
        },
    };
</script>
