<template>
    <div class="flex py-16 justify-center">
        <div class="py-12 px-8 text-center max-w-4xl">
            <div class="md:text-3xl text-2xl font-bold">
                「 Web Service Hub 」 とは ?
            </div>
            <div class="md:text-lg text-sm font-normal mt-4">
                Web Service Hub
                とは個人でWebサービスを開発している方のための<strong>コミュニティサービス</strong>です。<br />
                サービスを登録したり、みんなのサービスを見て<strong>Webサービスの開発を学んで品質向上</strong>を目指す場です。
            </div>
            <div class="flex justify-evenly">
                <inertia-link
                    :href="route('login')"
                    class="mt-6 flex justify-center h-12"
                >
                    <div
                        class="
                            flex
                            shadow-md
                            font-medium
                            py-2
                            px-10
                            text-white
                            cursor-pointer
                            bg-blue-600
                            hover:bg-blue-400
                            rounded
                            text-lg
                        "
                    >
                        ログイン
                    </div>
                </inertia-link>
                <inertia-link
                    :href="route('register')"
                    class="mt-6 flex justify-center h-12"
                >
                    <div
                        class="
                            flex
                            shadow-md
                            font-medium
                            py-2
                            px-4
                            text-white
                            cursor-pointer
                            bg-blue-600
                            hover:bg-blue-400
                            rounded
                            text-lg
                        "
                    >
                        アカウント作成
                    </div>
                </inertia-link>
            </div>
        </div>
    </div>
</template>
