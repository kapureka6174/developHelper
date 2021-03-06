<template>
    <jet-form-section @submitted="updatePassword">
        <template #title> パスワード更新 </template>

        <template #description> 長くてランダムなパスワードを設定してください。 </template>

        <template #form>
            <!-- 注意文 -->
            <div v-if="$page.props.user.id == 25" class="col-span-6 sm:col-span-4">
                <h2 class="text-red-400 font-semibold">
                    ※ゲストユーザーは、パスワードを更新できません。
                </h2>
            </div>

            <!-- 現在のパスワード（ゲスト表示） -->
            <div v-if="$page.props.user.id == 25" class="col-span-6 sm:col-span-4">
                <jet-label for="current_password" value="現在のパスワード" />
                <jet-input type="password" class="block mt-1 w-full bg-gray-300" readonly />
            </div>
            <!-- 現在のパスワード（通常表示） -->
            <div v-else-if="$page.props.existPass" class="col-span-6 sm:col-span-4">
                <jet-label for="current_password" value="現在のパスワード" />
                <jet-input
                    id="current_password"
                    type="password"
                    class="block mt-1 w-full"
                    v-model="form.current_password"
                    ref="current_password"
                    autocomplete="current-password"
                />
                <jet-input-error :message="form.errors.current_password" class="mt-2" />
            </div>

            <!-- 新しいパスワード（ゲスト表示） -->
            <div v-if="$page.props.user.id == 25" class="col-span-6 sm:col-span-4">
                <jet-label value="新しいパスワード" />
                <jet-input type="password" class="block mt-1 w-full bg-gray-300" readonly />
            </div>

            <!-- 新しいパスワード（通常表示） -->
            <div v-else class="col-span-6 sm:col-span-4">
                <jet-label for="password" value="新しいパスワード" />
                <jet-input
                    id="password"
                    type="password"
                    class="block mt-1 w-full"
                    v-model="form.password"
                    ref="password"
                    autocomplete="new-password"
                />
                <jet-input-error :message="form.errors.password" class="mt-2" />
            </div>

            <!-- 確認用パスワード（ゲスト表示） -->
            <div v-if="$page.props.user.id == 25" class="col-span-6 sm:col-span-4">
                <jet-label value="パスワード（確認用）" />
                <jet-input type="password" class="block mt-1 w-full bg-gray-300" readonly />
            </div>
            <!-- 確認用パスワード（通常表示） -->
            <div v-else class="col-span-6 sm:col-span-4">
                <jet-label for="password_confirmation" value="パスワード（確認用）" />
                <jet-input
                    id="password_confirmation"
                    type="password"
                    class="block mt-1 w-full"
                    v-model="form.password_confirmation"
                    autocomplete="new-password"
                />
                <jet-input-error :message="form.errors.password_confirmation" class="mt-2" />
            </div>
        </template>

        <template #actions>
            <jet-action-message :on="form.recentlySuccessful" class="mr-3">
                更新完了
            </jet-action-message>

            <!-- ゲスト表示 -->
            <jet-button
                v-if="$page.props.user.id == 25"
                :class="{ 'opacity-25': form.processing }"
                type="button"
            >
                更新
            </jet-button>
            <!-- 通常表示 -->
            <jet-button
                v-else
                :class="{ 'opacity-25': form.processing }"
                :disabled="form.processing"
            >
                更新
            </jet-button>
        </template>
    </jet-form-section>
</template>

<script>
    import JetActionMessage from "@/Jetstream/ActionMessage";
    import JetButton from "@/Jetstream/Button";
    import JetFormSection from "@/Jetstream/FormSection";
    import JetInput from "@/Jetstream/Input";
    import JetInputError from "@/Jetstream/InputError";
    import JetLabel from "@/Jetstream/Label";

    export default {
        components: {
            JetActionMessage,
            JetButton,
            JetFormSection,
            JetInput,
            JetInputError,
            JetLabel,
        },

        data() {
            return {
                form: this.$inertia.form({
                    current_password: "",
                    password: "",
                    password_confirmation: "",
                }),
            };
        },

        methods: {
            updatePassword() {
                this.form.put(route("user-password.update"), {
                    errorBag: "updatePassword",
                    preserveScroll: true,
                    onSuccess: () => this.form.reset(),
                    onError: () => {
                        if (this.form.errors.password) {
                            this.form.reset("password", "password_confirmation");
                            this.$refs.password.focus();
                        }

                        if (this.form.errors.current_password) {
                            this.form.reset("current_password");
                            this.$refs.current_password.focus();
                        }
                    },
                });
            },
        },
    };
</script>
