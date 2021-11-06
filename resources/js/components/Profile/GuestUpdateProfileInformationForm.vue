<template>
    <!-- 注意文 -->
    <div class="col-span-6 sm:col-span-4">
        <h2 class="text-red-400 font-semibold">
            ※ゲストユーザーは、プロフィールを編集できません。
        </h2>
    </div>

    <!-- ゲスト表示（名前） -->
    <div class="col-span-6 sm:col-span-4">
        <jet-label for="name" value="名前" />
        <jet-input
            id="name"
            type="text"
            class="block mt-1 w-full bg-gray-300"
            v-model="form.name"
            readonly
            autocomplete="name"
        />
        <jet-input-error :message="form.errors.name" class="mt-2" />
    </div>

    <!-- ゲスト表示（Email） -->
    <div class="col-span-6 sm:col-span-4">
        <jet-label for="email" value="メールアドレス" />
        <jet-input
            id="email"
            type="email"
            class="block mt-1 w-full bg-gray-300"
            v-model="form.email"
            readonly
        />
    </div>

    <!-- ツイッターアカウント -->
    <div v-if="$page.props.user.id !== 10" class="col-span-6 sm:col-span-4">
        <jet-label for="twitter_account" value="Twitterユーザー名" />
        <jet-input
            id="twitter_account"
            type="text"
            class="block mt-1 w-full bg-gray-300"
            v-model="form.twitter_account"
            autocomplete="twitter_account"
            placeholder="＠なしで入力してください"
            readonly
        />
    </div>

    <!-- Githubアカウント -->
    <div v-if="$page.props.user.id !== 10" class="col-span-6 sm:col-span-4">
        <jet-label for="github_account" value="GitHubユーザー名" />
        <jet-input
            id="github_account"
            type="text"
            class="block mt-1 w-full bg-gray-300"
            v-model="form.github_account"
            autocomplete="github_account"
            placeholder="ユーザー名だけを入力してください"
            readonly
        />
        <jet-input-error :message="form.errors.github_account" class="mt-2" />
    </div>

    <!-- 得意言語 -->
    <div v-if="$page.props.user.id !== 10" class="col-span-6 sm:col-span-4">
        <jet-label for="fav_lang" value="得意言語" />
        <jet-input
            id="fav_lang"
            type="text"
            class="block mt-1 w-full bg-gray-300"
            v-model="form.fav_lang"
            autocomplete="fav_lang"
            placeholder="一つだけ入力してください"
            readonly
        />
        <jet-input-error :message="form.errors.fav_lang" class="mt-2" />
    </div>

    <!-- プログラミング歴 -->
    <div v-if="$page.props.user.id !== 10" class="col-span-6 sm:col-span-4">
        <jet-label for="dev_year" value="プログラミング歴" />
        <jet-input
            id="dev_year"
            type="text"
            class="block mt-1 w-full bg-gray-300"
            v-model="form.dev_year"
            autocomplete="dev_year"
            placeholder="〇年〇ヶ月で入力してください"
            readonly
        />
        <jet-input-error :message="form.errors.dev_year" class="mt-2" />
    </div>

    <!-- ゲスト表示（紹介文） -->
    <div class="col-span-6 sm:col-span-4">
        <jet-label for="introduction" value="紹介文" />
        <textarea
            class="
                block
                mt-1
                w-full
                bg-gray-300
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
            readonly
        />
    </div>
</template>
<script>
    import JetInput from "@/Jetstream/Input";
    import JetLabel from "@/Jetstream/Label";
    export default {
        components: {
            JetInput,
            JetLabel,
        },
        props: {
            form: Object,
        },
    };
</script>
