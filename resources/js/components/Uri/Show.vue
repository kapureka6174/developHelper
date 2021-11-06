<template>
    <div>
        <section-title title="URI設計" />
        <div class="overflow-x-auto">
            <div class="m-5 mx-auto text-gray-800 bg-gray-200 rounded-t-lg">
                <Header />
                <div
                    v-for="(uri, index) in uris"
                    :key="index"
                    class="
                        flex flex-nowrap
                        items-center
                        w-full
                        max-h-40
                        bg-gray-100
                        border-b border-gray-200
                        overflow-x-auto
                    "
                >
                    <div class="flex-none px-4 py-3 text-center break-words md:w-2/12">
                        {{ uri.uri }}
                    </div>
                    <div class="flex-none px-4 py-3 w-20 text-center break-words md:w-2/12">
                        {{ uri.method }}
                    </div>
                    <div class="flex-none px-4 py-3 text-center md:w-8/12">
                        {{ uri.explain }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import SectionTitle from "../Utility/SectionTitle";
    import Header from "./Header";
    export default {
        components: {
            SectionTitle,
            Header,
        },
        props: {
            uris: Array,
        },
    };
</script>
