<template>
    <jet-form-section @submitted="updateProfileInformation">
        <template #title> プロフィール情報 </template>

        <template #description>
            プロフィール情報とメールアドレスを更新する。
        </template>

        <template #form>
            <!-- 注意文 -->
            <div class="col-span-6 sm:col-span-4">
                <h2 class="font-semibold text-red-400">
                    ※ゲストユーザーは、プロフィールを編集できません。
                </h2>
            </div>

            <!-- Profile Photo -->
            <div
                class="col-span-6 sm:col-span-4"
                v-if="$page.props.jetstream.managesProfilePhotos"
            >
                <!-- Profile Photo File Input -->
                <input
                    type="file"
                    class="hidden"
                    ref="photo"
                    @change="updatePhotoPreview"
                />

                <jet-label for="photo" value="Photo" />

                <!-- Current Profile Photo -->
                <div class="mt-2" v-show="!photoPreview">
                    <img
                        :src="user.profile_photo_url"
                        :alt="user.name"
                        class="rounded-full h-20 w-20 object-cover"
                    />
                </div>

                <!-- New Profile Photo Preview -->
                <div class="mt-2" v-show="photoPreview">
                    <span
                        class="block rounded-full w-20 h-20"
                        :style="
                            'background-size: cover; background-repeat: no-repeat; background-position: center center; background-image: url(\'' +
                            photoPreview +
                            '\');'
                        "
                    >
                    </span>
                </div>

                <jet-secondary-button
                    class="mt-2 mr-2"
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

            <!-- ゲスト表示（名前） -->
            <div
                v-if="$page.props.user.id == 10"
                class="col-span-6 sm:col-span-4"
            >
                <jet-label for="name" value="名前" />
                <jet-input
                    id="name"
                    type="text"
                    class="mt-1 block w-full bg-gray-300"
                    v-model="form.name"
                    readonly
                    autocomplete="name"
                />
                <jet-input-error :message="form.errors.name" class="mt-2" />
            </div>
            <!-- 通常表示（名前） -->
            <div v-else class="col-span-6 sm:col-span-4">
                <jet-label for="name" value="名前" />
                <jet-input
                    id="name"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.name"
                    autocomplete="name"
                />
                <jet-input-error :message="form.errors.name" class="mt-2" />
            </div>

            <!-- ゲスト表示（Email） -->
            <div
                v-if="$page.props.user.id == 10"
                class="col-span-6 sm:col-span-4"
            >
                <jet-label for="email" value="メールアドレス" />
                <jet-input
                    id="email"
                    type="email"
                    class="mt-1 block w-full bg-gray-300"
                    v-model="form.email"
                    readonly
                />
            </div>
            <!-- 通常表示（Email） -->
            <div v-else class="col-span-6 sm:col-span-4">
                <jet-label for="email" value="メールアドレス" />
                <jet-input
                    id="email"
                    type="email"
                    class="mt-1 block w-full"
                    v-model="form.email"
                />
                <jet-input-error :message="form.errors.email" class="mt-2" />
            </div>

            <!-- ゲスト表示（紹介文） -->
            <div
                v-if="$page.props.user.id == 10"
                class="col-span-6 sm:col-span-4"
            >
                <jet-label for="introduction" value="紹介文" />
                <textarea
                    class="
                        border-gray-300
                        focus:border-indigo-300
                        focus:ring
                        focus:ring-indigo-200
                        focus:ring-opacity-50
                        rounded-md
                        shadow-sm
                        mt-1
                        block
                        w-full
                        bg-gray-300
                    "
                    id="introduction"
                    type="text"
                    v-model="form.introduction"
                    rows="10"
                    readonly
                />
            </div>
            <!-- 通常表示（紹介文） -->
            <div v-else class="col-span-6 sm:col-span-4">
                <jet-label for="introduction" value="紹介文" />
                <textarea
                    class="
                        border-gray-300
                        focus:border-indigo-300
                        focus:ring
                        focus:ring-indigo-200
                        focus:ring-opacity-50
                        rounded-md
                        shadow-sm
                        mt-1
                        block
                        w-full
                    "
                    id="introduction"
                    type="text"
                    v-model="form.introduction"
                    rows="10"
                />
                <jet-input-error
                    :message="form.errors.introduction"
                    class="mt-2"
                />
            </div>
        </template>

        <template #actions>
            <jet-action-message :on="form.recentlySuccessful" class="mr-3">
                更新完了
            </jet-action-message>

            <!-- ゲスト表示 -->
            <jet-button
                v-if="$page.props.user.id == 13"
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

export default {
    components: {
        JetActionMessage,
        JetButton,
        JetFormSection,
        JetInput,
        JetInputError,
        JetLabel,
        JetSecondaryButton,
    },

    props: ["user"],

    data() {
        return {
            form: this.$inertia.form({
                _method: "PUT",
                name: this.user.name,
                email: this.user.email,
                introduction: this.user.introduction,
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
