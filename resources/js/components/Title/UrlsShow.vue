<template>
    <div v-if="github_url || site_url" class="flex items-center justify-evenly mb-3">
        <a v-if="github_url" :href="github_url" target="_blank" rel="noopener noreferrer"
            ><button class="p-3 text-white hover:bg-indigo-400 bg-indigo-600 rounded">
                GitHubページへ
            </button></a
        >
        <a v-if="site_url" :href="site_url" target="_blank" rel="noopener noreferrer"
            ><button
                class="p-3 text-white hover:bg-indigo-400 bg-indigo-600 rounded"
                :class="github_url ? 'md:ml-48' : ''"
            >
                サービスページへ
            </button></a
        >
    </div>
</template>
<script>
    export default {
        props: {
            github_url: String,
            site_url: String,
        },
    };
</script>
