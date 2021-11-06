<template>
    <div class="flex justify-center py-16">
        <div class="px-8 py-12 max-w-4xl text-center">
            <div class="text-2xl font-bold md:text-3xl">「 Web Service Hub 」 とは ?</div>
            <div class="mt-4 text-sm font-normal md:text-lg">
                Web Service Hub
                とは個人でWebサービスを開発している方のための<strong>コミュニティサービス</strong>です。<br />
                サービスを登録したり、みんなのサービスを見て<strong>Webサービスの開発を学んで品質向上</strong>を目指す場です。
            </div>
            <div class="flex justify-evenly">
                <inertia-link :href="route('login')" class="flex justify-center mt-6 h-12">
                    <div
                        class="
                            flex
                            px-10
                            py-2
                            text-white text-lg
                            font-medium
                            hover:bg-blue-400
                            bg-blue-600
                            rounded
                            shadow-md
                            cursor-pointer
                        "
                    >
                        ログイン
                    </div>
                </inertia-link>
                <inertia-link :href="route('register')" class="flex justify-center mt-6 h-12">
                    <div
                        class="
                            flex
                            px-4
                            py-2
                            text-white text-lg
                            font-medium
                            hover:bg-blue-400
                            bg-blue-600
                            rounded
                            shadow-md
                            cursor-pointer
                        "
                    >
                        アカウント作成
                    </div>
                </inertia-link>
            </div>
        </div>
    </div>
</template>
