<template>
    <div>
        <section-title title="URI設計" />
        <div class="overflow-x-auto">
            <div class="rounded-t-lg m-5 mx-auto bg-gray-200 text-gray-800">
                <Header />
                <div
                    v-for="(uri, index) in uris"
                    :key="index"
                    class="
                        bg-gray-100
                        border-b border-gray-200
                        flex flex-nowrap
                        items-center
                        overflow-x-auto
                        max-h-40
                        w-full
                    "
                >
                    <div
                        class="
                            flex-none
                            px-4
                            py-3
                            md:w-2/12
                            break-words
                            text-center
                        "
                    >
                        {{ uri.uri }}
                    </div>
                    <div
                        class="
                            flex-none
                            px-4
                            py-3
                            w-20
                            md:w-2/12
                            break-words
                            text-center
                        "
                    >
                        {{ uri.method }}
                    </div>
                    <div class="flex-none px-4 py-3 md:w-8/12 text-center">
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
