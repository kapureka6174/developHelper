<template>
    <jet-authentication-card>
        <template #logo>
            <jet-authentication-card-logo />
        </template>

        <jet-validation-errors class="mb-4" />

        <div v-if="status" class="mb-4 text-green-600 text-sm font-medium">
            {{ status }}
        </div>

        <form @submit.prevent="submit">
            <div>
                <jet-label for="email" value="メールアドレス" />
                <jet-input
                    id="email"
                    type="email"
                    class="block mt-1 w-full"
                    v-model="form.email"
                    required
                    autofocus
                />
            </div>

            <div class="mt-4">
                <jet-label for="password" value="パスワード" />
                <jet-input
                    id="password"
                    type="password"
                    class="block mt-1 w-full"
                    v-model="form.password"
                    required
                    autocomplete="current-password"
                />
            </div>

            <div class="block mt-4">
                <label class="flex items-center">
                    <jet-checkbox name="remember" v-model:checked="form.remember" />
                    <span class="ml-2 text-gray-600 text-sm">ログイン状態を保持する</span>
                </label>
            </div>

            <div class="flex items-center justify-end mt-4">
                <inertia-link
                    v-if="canResetPassword"
                    :href="route('password.request')"
                    class="text-gray-600 hover:text-gray-900 underline text-sm"
                >
                    パスワードを忘れた方はこちら
                </inertia-link>

                <jet-button
                    class="ml-4"
                    :class="{ 'opacity-25': form.processing }"
                    :disabled="form.processing"
                >
                    ログイン
                </jet-button>
            </div>

            <hr class="my-4" />

            <div class="flex justify-center my-2">
                <h2 class="font-semibold">または</h2>
            </div>

            <div class="flex justify-around">
                <!-- -- Login with GitHub -- -->
                <inertia-link class="btn" :href="route('Github_Login')">
                    <div
                        class="
                            flex
                            items-center
                            px-4
                            py-2
                            hover:bg-gray-100
                            bg-green-100
                            border-2 border-green-300
                            rounded-md
                        "
                    >
                        <svg
                            fill="#000000"
                            xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 32 32"
                            width="24px"
                            height="24px"
                        >
                            <path
                                fill-rule="evenodd"
                                d="M 16 4 C 9.371094 4 4 9.371094 4 16 C 4 21.300781 7.4375 25.800781 12.207031 27.386719 C 12.808594 27.496094 13.027344 27.128906 13.027344 26.808594 C 13.027344 26.523438 13.015625 25.769531 13.011719 24.769531 C 9.671875 25.492188 8.96875 23.160156 8.96875 23.160156 C 8.421875 21.773438 7.636719 21.402344 7.636719 21.402344 C 6.546875 20.660156 7.71875 20.675781 7.71875 20.675781 C 8.921875 20.761719 9.554688 21.910156 9.554688 21.910156 C 10.625 23.746094 12.363281 23.214844 13.046875 22.910156 C 13.15625 22.132813 13.46875 21.605469 13.808594 21.304688 C 11.144531 21.003906 8.34375 19.972656 8.34375 15.375 C 8.34375 14.0625 8.8125 12.992188 9.578125 12.152344 C 9.457031 11.851563 9.042969 10.628906 9.695313 8.976563 C 9.695313 8.976563 10.703125 8.65625 12.996094 10.207031 C 13.953125 9.941406 14.980469 9.808594 16 9.804688 C 17.019531 9.808594 18.046875 9.941406 19.003906 10.207031 C 21.296875 8.65625 22.300781 8.976563 22.300781 8.976563 C 22.957031 10.628906 22.546875 11.851563 22.421875 12.152344 C 23.191406 12.992188 23.652344 14.0625 23.652344 15.375 C 23.652344 19.984375 20.847656 20.996094 18.175781 21.296875 C 18.605469 21.664063 18.988281 22.398438 18.988281 23.515625 C 18.988281 25.121094 18.976563 26.414063 18.976563 26.808594 C 18.976563 27.128906 19.191406 27.503906 19.800781 27.386719 C 24.566406 25.796875 28 21.300781 28 16 C 28 9.371094 22.628906 4 16 4 Z"
                            />
                        </svg>
                        <p class="text-sm font-medium">GitHubでログイン</p>
                    </div>
                </inertia-link>
                <!-- -- Login with Google -- -->
                <inertia-link class="btn" :href="route('Google_Login')">
                    <div
                        class="
                            flex
                            items-center
                            px-4
                            py-2
                            bg-blue-100
                            hover:bg-gray-100
                            border-2 border-blue-300
                            rounded-md
                        "
                    >
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 48 48"
                            width="24px"
                            height="24px"
                        >
                            <path
                                fill="#FFC107"
                                d="M43.611,20.083H42V20H24v8h11.303c-1.649,4.657-6.08,8-11.303,8c-6.627,0-12-5.373-12-12c0-6.627,5.373-12,12-12c3.059,0,5.842,1.154,7.961,3.039l5.657-5.657C34.046,6.053,29.268,4,24,4C12.955,4,4,12.955,4,24c0,11.045,8.955,20,20,20c11.045,0,20-8.955,20-20C44,22.659,43.862,21.35,43.611,20.083z"
                            />
                            <path
                                fill="#FF3D00"
                                d="M6.306,14.691l6.571,4.819C14.655,15.108,18.961,12,24,12c3.059,0,5.842,1.154,7.961,3.039l5.657-5.657C34.046,6.053,29.268,4,24,4C16.318,4,9.656,8.337,6.306,14.691z"
                            />
                            <path
                                fill="#4CAF50"
                                d="M24,44c5.166,0,9.86-1.977,13.409-5.192l-6.19-5.238C29.211,35.091,26.715,36,24,36c-5.202,0-9.619-3.317-11.283-7.946l-6.522,5.025C9.505,39.556,16.227,44,24,44z"
                            />
                            <path
                                fill="#1976D2"
                                d="M43.611,20.083H42V20H24v8h11.303c-0.792,2.237-2.231,4.166-4.087,5.571c0.001-0.001,0.002-0.001,0.003-0.002l6.19,5.238C36.971,39.205,44,34,44,24C44,22.659,43.862,21.35,43.611,20.083z"
                            />
                        </svg>
                        <p class="text-sm font-medium">Googleでログイン</p>
                    </div>
                </inertia-link>
            </div>

            <hr class="my-4" />
            <div class="flex justify-center my-2">
                <h2 class="font-semibold">ユーザー登録せずに機能を試したい方はこちら</h2>
            </div>
            <!-- -- ゲストログイン -- -->
            <inertia-link class="btn text-white" :href="route('Guest_Login')">
                <div
                    class="
                        items-center
                        px-4
                        py-2
                        text-center
                        hover:bg-yellow-300
                        bg-yellow-600
                        rounded-md
                    "
                >
                    ゲストユーザーログイン
                </div>
            </inertia-link>
        </form>
    </jet-authentication-card>
    <hr />
    <footer />
</template>

<script>
    import JetAuthenticationCard from "@/Jetstream/AuthenticationCard";
    import JetAuthenticationCardLogo from "@/Jetstream/AuthenticationCardLogo";
    import JetButton from "@/Jetstream/Button";
    import JetInput from "@/Jetstream/Input";
    import JetCheckbox from "@/Jetstream/Checkbox";
    import JetLabel from "@/Jetstream/Label";
    import JetValidationErrors from "@/Jetstream/ValidationErrors";
    import Footer from "../components/Layout/Footer";

    export default {
        components: {
            JetAuthenticationCard,
            JetAuthenticationCardLogo,
            JetButton,
            JetInput,
            JetCheckbox,
            JetLabel,
            JetValidationErrors,
            Footer,
        },

        props: {
            canResetPassword: Boolean,
            status: String,
        },

        data() {
            return {
                form: this.$inertia.form({
                    email: "",
                    password: "",
                    remember: false,
                }),
            };
        },

        methods: {
            submit() {
                this.form
                    .transform((data) => ({
                        ...data,
                        remember: this.form.remember ? "on" : "",
                    }))
                    .post(this.route("login"), {
                        onFinish: () => this.form.reset("password"),
                    });
            },
        },
    };
</script>
