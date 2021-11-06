<template>
    <jet-authentication-card>
        <template #logo>
            <jet-authentication-card-logo />
        </template>

        <div class="mb-4 text-gray-600 text-sm">
            ご登録いただいたメールアドレスを入力してください。パスワード再設定用のURLをメールにてお送りします。
        </div>

        <div v-if="status" class="mb-4 text-green-600 text-sm font-medium">
            {{ status }}
        </div>

        <jet-validation-errors class="mb-4" />

        <form @submit.prevent="submit">
            <div>
                <jet-label for="email" value="Email" />
                <jet-input
                    id="email"
                    type="email"
                    class="block mt-1 w-full"
                    v-model="form.email"
                    required
                    autofocus
                />
            </div>

            <div class="flex items-center justify-end mt-4">
                <jet-button :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    送信
                </jet-button>
            </div>
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
    import JetLabel from "@/Jetstream/Label";
    import JetValidationErrors from "@/Jetstream/ValidationErrors";
    import Footer from "../components/Layout/Footer";

    export default {
        components: {
            JetAuthenticationCard,
            JetAuthenticationCardLogo,
            JetButton,
            JetInput,
            JetLabel,
            JetValidationErrors,
            Footer,
        },

        props: {
            status: String,
        },

        data() {
            return {
                form: this.$inertia.form({
                    email: "",
                }),
            };
        },

        methods: {
            submit() {
                this.form.post(this.route("password.email"));
            },
        },
    };
</script>
