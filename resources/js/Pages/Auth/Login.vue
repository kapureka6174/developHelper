<template>
    <jet-authentication-card>
        <template #logo>
            <jet-authentication-card-logo />
        </template>

        <jet-validation-errors class="mb-4" />

        <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
            {{ status }}
        </div>

        <form @submit.prevent="submit">
            <div>
                <jet-label for="email" value="メールアドレス" />
                <jet-input
                    id="email"
                    type="email"
                    class="mt-1 block w-full"
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
                    class="mt-1 block w-full"
                    v-model="form.password"
                    required
                    autocomplete="current-password"
                />
            </div>

            <div class="block mt-4">
                <label class="flex items-center">
                    <jet-checkbox
                        name="remember"
                        v-model:checked="form.remember"
                    />
                    <span class="ml-2 text-sm text-gray-600"
                        >ログイン状態を保持する</span
                    >
                </label>
            </div>

            <div class="flex items-center justify-end mt-4">
                <inertia-link
                    v-if="canResetPassword"
                    :href="route('password.request')"
                    class="underline text-sm text-gray-600 hover:text-gray-900"
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
                <inertia-link
                    class="btn text-white"
                    :href="route('Github_Login')"
                >
                    <div
                        class="bg-black hover:bg-gray-700 rounded-md px-4 py-2"
                    >
                        GitHubでログイン
                    </div>
                </inertia-link>
                <!-- -- Login with Google -- -->
                <inertia-link
                    class="btn text-white"
                    :href="route('Google_Login')"
                >
                    <div
                        class="bg-red-600 hover:bg-red-400 rounded-md px-4 py-2"
                    >
                        Googleでログイン
                    </div>
                </inertia-link>
            </div>

            <hr class="my-4" />
            <div class="flex justify-center my-2">
                <h2 class="font-semibold">
                    ユーザー登録せずに機能を試したい方はこちら
                </h2>
            </div>
            <!-- -- Login with GitHub -- -->
            <inertia-link class="btn text-white" :href="route('Guest_Login')">
                <div
                    class="
                        bg-yellow-600
                        hover:bg-yellow-300
                        rounded-md
                        px-4
                        py-2
                        items-center
                        text-center
                    "
                >
                    ゲストユーザーログイン
                </div>
            </inertia-link>
        </form>
    </jet-authentication-card>
</template>

<script>
import JetAuthenticationCard from "@/Jetstream/AuthenticationCard";
import JetAuthenticationCardLogo from "@/Jetstream/AuthenticationCardLogo";
import JetButton from "@/Jetstream/Button";
import JetInput from "@/Jetstream/Input";
import JetCheckbox from "@/Jetstream/Checkbox";
import JetLabel from "@/Jetstream/Label";
import JetValidationErrors from "@/Jetstream/ValidationErrors";

export default {
    components: {
        JetAuthenticationCard,
        JetAuthenticationCardLogo,
        JetButton,
        JetInput,
        JetCheckbox,
        JetLabel,
        JetValidationErrors,
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
