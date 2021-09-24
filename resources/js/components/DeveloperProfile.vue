<template>
    <div class="md:px-32 md:pt-16 px-4 pt-8">
        <div class="md:flex md:items-center md:justify-between">
            <img
                class="md:h-32 md:w-32 h-16 w-16 rounded-full mr-12 mb-3"
                :src="image_url"
                alt="プロフィール写真"
            />
            <div>
                <h3 class="font-bold text-3xl mb-2">{{ username }}</h3>
                <p class="font-semibold">{{ introduction }}</p>
            </div>
        </div>
        <div class="flex flex-col mt-6 justify-center md:justify-between">
            <div
                class="
                    flex flex-col
                    md:flex-row
                    justify-center
                    mb-3
                    items-center
                "
            >
                <p
                    v-if="fav_lang"
                    class="font-semibold text-xl mb-3 md:mr-3 md:mb-0"
                >
                    得意な言語：{{ fav_lang }}
                </p>
                <p v-if="dev_years" class="font-semibold text-xl">
                    プログラミング歴：{{ dev_years }}
                </p>
            </div>
            <div class="flex items-start justify-center">
                <div class="flex flex-col justify-center items-center">
                    <svg
                        class="h-8 w-8 text-red-500"
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="2"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                    >
                        <path
                            d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"
                        />
                    </svg>
                    <p class="text-red-500">{{ likes }}</p>
                </div>
                <a
                    v-if="github"
                    :href="github_url"
                    target="_blank"
                    rel="noopener noreferrer"
                >
                    <svg
                        class="h-8 w-8 text-black ml-6"
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="2"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                    >
                        <path
                            d="M9 19c-5 1.5-5-2.5-7-3m14 6v-3.87a3.37 3.37 0 0 0-.94-2.61c3.14-.35 6.44-1.54 6.44-7A5.44 5.44 0 0 0 20 4.77 5.07 5.07 0 0 0 19.91 1S18.73.65 16 2.48a13.38 13.38 0 0 0-7 0C6.27.65 5.09 1 5.09 1A5.07 5.07 0 0 0 5 4.77a5.44 5.44 0 0 0-1.5 3.78c0 5.42 3.3 6.61 6.44 7A3.37 3.37 0 0 0 9 18.13V22"
                        />
                    </svg>
                </a>
                <a
                    v-if="twitter"
                    :href="twitter_url"
                    target="_blank"
                    rel="noopener noreferrer"
                >
                    <svg
                        class="h-8 w-8 text-blue-500 ml-6"
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="2"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                    >
                        <path
                            d="M23 3a10.9 10.9 0 0 1-3.14 1.53 4.48 4.48 0 0 0-7.86 3v1A10.66 10.66 0 0 1 3 4s-4 9 5 13a11.64 11.64 0 0 1-7 2c9 5 20 0 20-11.5a4.5 4.5 0 0 0-.08-.83A7.72 7.72 0 0 0 23 3z"
                        />
                    </svg>
                </a>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        username: String,
        introduction: String,
        github: String,
        twitter: String,
        image_url: String,
        likes: Number,
        comments: Number,
        fav_lang: String,
        dev_years: String,
    },
    setup(props) {
        const github_url = `https://github.com/${props.github}`;
        const twitter_url = `https://twitter.com/${props.twitter}`;

        return { github_url, twitter_url };
    },
};
</script>
