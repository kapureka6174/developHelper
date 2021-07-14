<template>
    <jet-action-section>
        <template #title> 二段階認証 </template>

        <template #description>
            セキュリティ強化のため二段階認証を追加
        </template>

        <template #content>
            <h3
                class="text-lg font-medium text-gray-900"
                v-if="twoFactorEnabled"
            >
                二段階認証が有効です。
            </h3>

            <h3 class="text-lg font-medium text-gray-900" v-else>
                二段階認証が未設定です。
            </h3>

            <div class="mt-3 max-w-xl text-sm text-gray-600">
                <p>
                    二段階認証を有効化した場合、ログイン時に安全かつランダムなトークンが与えられます。トークンはGoogle
                    Authenticatorアプリから取得できます。
                </p>
            </div>

            <div v-if="twoFactorEnabled">
                <div v-if="qrCode">
                    <div class="mt-4 max-w-xl text-sm text-gray-600">
                        <p class="font-semibold">
                            二段階認証を有効化しました。QRコードをアプリからスキャンしてください。
                        </p>
                    </div>

                    <div class="mt-4" v-html="qrCode"></div>
                </div>

                <div v-if="recoveryCodes.length > 0">
                    <div class="mt-4 max-w-xl text-sm text-gray-600">
                        <p class="font-semibold">
                            パスワード管理ツールにリカバリーコードを保存してください。二段階認証に使用する端末を紛失した場合にリカバリーコードを使ってログインできます。
                        </p>
                    </div>

                    <div
                        class="
                            grid
                            gap-1
                            max-w-xl
                            mt-4
                            px-4
                            py-4
                            font-mono
                            text-sm
                            bg-gray-100
                            rounded-lg
                        "
                    >
                        <div v-for="code in recoveryCodes" :key="code">
                            {{ code }}
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-5">
                <div v-if="!twoFactorEnabled">
                    <jet-confirms-password
                        @confirmed="enableTwoFactorAuthentication"
                    >
                        <jet-button
                            type="button"
                            :class="{ 'opacity-25': enabling }"
                            :disabled="enabling"
                        >
                            有効化
                        </jet-button>
                    </jet-confirms-password>
                </div>

                <div v-else>
                    <jet-confirms-password @confirmed="regenerateRecoveryCodes">
                        <jet-secondary-button
                            class="mr-3"
                            v-if="recoveryCodes.length > 0"
                        >
                            リカバリーコード再生成
                        </jet-secondary-button>
                    </jet-confirms-password>

                    <jet-confirms-password @confirmed="showRecoveryCodes">
                        <jet-secondary-button
                            class="mr-3"
                            v-if="recoveryCodes.length === 0"
                        >
                            リカバリーコードを表示
                        </jet-secondary-button>
                    </jet-confirms-password>

                    <jet-confirms-password
                        @confirmed="disableTwoFactorAuthentication"
                    >
                        <jet-danger-button
                            :class="{ 'opacity-25': disabling }"
                            :disabled="disabling"
                        >
                            無効化
                        </jet-danger-button>
                    </jet-confirms-password>
                </div>
            </div>
        </template>
    </jet-action-section>
</template>

<script>
import JetActionSection from "@/Jetstream/ActionSection";
import JetButton from "@/Jetstream/Button";
import JetConfirmsPassword from "@/Jetstream/ConfirmsPassword";
import JetDangerButton from "@/Jetstream/DangerButton";
import JetSecondaryButton from "@/Jetstream/SecondaryButton";

export default {
    components: {
        JetActionSection,
        JetButton,
        JetConfirmsPassword,
        JetDangerButton,
        JetSecondaryButton,
    },

    data() {
        return {
            enabling: false,
            disabling: false,

            qrCode: null,
            recoveryCodes: [],
        };
    },

    methods: {
        enableTwoFactorAuthentication() {
            this.enabling = true;

            this.$inertia.post(
                "/user/two-factor-authentication",
                {},
                {
                    preserveScroll: true,
                    onSuccess: () =>
                        Promise.all([
                            this.showQrCode(),
                            this.showRecoveryCodes(),
                        ]),
                    onFinish: () => (this.enabling = false),
                }
            );
        },

        showQrCode() {
            return axios.get("/user/two-factor-qr-code").then((response) => {
                this.qrCode = response.data.svg;
            });
        },

        showRecoveryCodes() {
            return axios
                .get("/user/two-factor-recovery-codes")
                .then((response) => {
                    this.recoveryCodes = response.data;
                });
        },

        regenerateRecoveryCodes() {
            axios.post("/user/two-factor-recovery-codes").then((response) => {
                this.showRecoveryCodes();
            });
        },

        disableTwoFactorAuthentication() {
            this.disabling = true;

            this.$inertia.delete("/user/two-factor-authentication", {
                preserveScroll: true,
                onSuccess: () => (this.disabling = false),
            });
        },
    },

    computed: {
        twoFactorEnabled() {
            return !this.enabling && this.$page.props.user.two_factor_enabled;
        },
    },
};
</script>
