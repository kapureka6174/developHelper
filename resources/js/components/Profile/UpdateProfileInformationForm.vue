<template>
    <jet-form-section @submitted="updateProfileInformation">
        <template #title> プロフィール情報 </template>

        <template #description> プロフィール情報とメールアドレスを更新する。 </template>

        <template #form>
            <guest-update-profile-information-form v-if="$page.props.user.id == 25" :form="form" />

            <!-- Profile Photo -->
            <div
                class="col-span-6 sm:col-span-4"
                v-if="$page.props.jetstream.managesProfilePhotos && $page.props.user.id !== 25"
            >
                <!-- Profile Photo File Input -->
                <input type="file" class="hidden" ref="photo" @change="updatePhotoPreview" />

                <jet-label for="photo" value="Photo" />

                <!-- Current Profile Photo -->
                <div class="mt-2" v-show="!photoPreview">
                    <img
                        :src="user.profile_photo_url"
                        :alt="user.name"
                        class="w-20 h-20 rounded-full object-cover"
                    />
                </div>

                <!-- New Profile Photo Preview -->
                <div class="mt-2" v-show="photoPreview">
                    <span
                        class="block w-20 h-20 rounded-full"
                        :style="
                            'background-size: cover; background-repeat: no-repeat; background-position: center center; background-image: url(\'' +
                            photoPreview +
                            '\');'
                        "
                    >
                    </span>
                </div>

                <jet-secondary-button
                    class="mr-2 mt-2"
                    type="button"
                    @click.prevent="selectNewPhoto"
                >
                    新しい写真を選択
                </jet-secondary-button>

                <jet-secondary-button
                    type="button"
                    class="mt-2"
                    @click.prevent="deletePhoto"
                    v-if="user.profile_photo_path"
                >
                    写真を削除
                </jet-secondary-button>

                <jet-input-error :message="form.errors.photo" class="mt-2" />
            </div>

            <!-- 名前 -->
            <div v-if="$page.props.user.id !== 25" class="col-span-6 sm:col-span-4">
                <jet-label for="name" value="名前" />
                <jet-input
                    id="name"
                    type="text"
                    class="block mt-1 w-full"
                    v-model="form.name"
                    autocomplete="name"
                />
                <jet-input-error :message="form.errors.name" class="mt-2" />
            </div>

            <!-- Email -->
            <div v-if="$page.props.user.id !== 25" class="col-span-6 sm:col-span-4">
                <jet-label for="email" value="メールアドレス" />
                <jet-input id="email" type="email" class="block mt-1 w-full" v-model="form.email" />
                <jet-input-error :message="form.errors.email" class="mt-2" />
            </div>

            <!-- ツイッターアカウント -->
            <div v-if="$page.props.user.id !== 25" class="col-span-6 sm:col-span-4">
                <jet-label for="twitter_account" value="Twitterユーザー名" />
                <jet-input
                    id="twitter_account"
                    type="text"
                    class="block mt-1 w-full"
                    v-model="form.twitter_account"
                    placeholder="＠なしで入力してください"
                />
                <jet-input-error :message="form.errors.twitter_account" class="mt-2" />
            </div>

            <!-- Githubアカウント -->
            <div v-if="$page.props.user.id !== 25" class="col-span-6 sm:col-span-4">
                <jet-label for="github_account" value="GitHubユーザー名" />
                <jet-input
                    id="github_account"
                    type="text"
                    class="block mt-1 w-full"
                    v-model="form.github_account"
                    placeholder="ユーザー名だけを入力してください"
                />
                <jet-input-error :message="form.errors.github_account" class="mt-2" />
            </div>

            <!-- 得意言語 -->
            <div v-if="$page.props.user.id !== 25" class="col-span-6 sm:col-span-4">
                <jet-label for="fav_lang" value="得意言語" />
                <jet-input
                    id="fav_lang"
                    type="text"
                    class="block mt-1 w-full"
                    v-model="form.fav_lang"
                    placeholder="一つだけ入力してください"
                />
                <jet-input-error :message="form.errors.fav_lang" class="mt-2" />
            </div>

            <!-- プログラミング歴 -->
            <div v-if="$page.props.user.id !== 25" class="col-span-6 sm:col-span-4">
                <jet-label for="dev_years" value="プログラミング歴" />
                <jet-input
                    id="dev_years"
                    type="text"
                    class="block mt-1 w-full"
                    v-model="form.dev_years"
                    placeholder="〇年〇ヶ月で入力してください"
                />
                <jet-input-error :message="form.errors.dev_years" class="mt-2" />
            </div>

            <!-- 紹介文 -->
            <div v-if="$page.props.user.id !== 25" class="col-span-6 sm:col-span-4">
                <jet-label for="introduction" value="紹介文" />
                <textarea
                    class="
                        block
                        mt-1
                        w-full
                        border-gray-300
                        focus:border-indigo-300
                        rounded-md
                        shadow-sm
                        focus:ring focus:ring-indigo-200 focus:ring-opacity-50
                    "
                    id="introduction"
                    type="text"
                    v-model="form.introduction"
                    rows="10"
                />
                <jet-input-error :message="form.errors.introduction" class="mt-2" />
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
                :disabled="form.processing"
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
    import JetButton from "@/Jetstream/Button";
    import JetFormSection from "@/Jetstream/FormSection";
    import JetInput from "@/Jetstream/Input";
    import JetInputError from "@/Jetstream/InputError";
    import JetLabel from "@/Jetstream/Label";
    import JetActionMessage from "@/Jetstream/ActionMessage";
    import JetSecondaryButton from "@/Jetstream/SecondaryButton";
    import GuestUpdateProfileInformationForm from "./GuestUpdateProfileInformationForm";

    export default {
        components: {
            JetActionMessage,
            JetButton,
            JetFormSection,
            JetInput,
            JetInputError,
            JetLabel,
            JetSecondaryButton,
            GuestUpdateProfileInformationForm,
        },

        props: ["user"],

        data() {
            return {
                form: this.$inertia.form({
                    _method: "PUT",
                    name: this.user.name,
                    email: this.user.email,
                    introduction: this.user.introduction,
                    twitter_account: this.user.twitter_account,
                    github_account: this.user.github_account,
                    fav_lang: this.user.fav_lang,
                    dev_years: this.user.dev_years,
                    photo: null,
                }),

                photoPreview: null,
            };
        },

        methods: {
            updateProfileInformation() {
                if (this.$refs.photo) {
                    this.form.photo = this.$refs.photo.files[0];
                }

                this.form.post(route("user-profile-information.update"), {
                    errorBag: "updateProfileInformation",
                    preserveScroll: true,
                    onSuccess: () => this.clearPhotoFileInput(),
                });
            },

            selectNewPhoto() {
                this.$refs.photo.click();
            },

            updatePhotoPreview() {
                const photo = this.$refs.photo.files[0];

                if (!photo) return;

                const reader = new FileReader();

                reader.onload = (e) => {
                    this.photoPreview = e.target.result;
                };

                reader.readAsDataURL(photo);
            },

            deletePhoto() {
                this.$inertia.delete(route("current-user-photo.destroy"), {
                    preserveScroll: true,
                    onSuccess: () => {
                        this.photoPreview = null;
                        this.clearPhotoFileInput();
                    },
                });
            },

            clearPhotoFileInput() {
                if (this.$refs.photo?.value) {
                    this.$refs.photo.value = null;
                }
            },
        },
    };
</script>
