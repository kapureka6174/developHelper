<template>
    <div class="w-full flex items-center justify-around mb-3">
        <p
            class="
                font-bold
                text-gray-600
                bg-gray-200
                rounded-md
                py-2
                px-4
                w-4/5
                mx-3
                text-center
            "
        >
            {{
                $page.url.split("/")[1] == "create"
                    ? pages[index].requirements[requirementIndex]
                    : pages[index].requirements[requirementIndex].content
            }}
        </p>
        <svg
            class="h-6 w-6 text-red-600 my-2 mr-4 hover:text-red-400"
            viewBox="0 0 24 24"
            fill="none"
            stroke="currentColor"
            stroke-width="2"
            stroke-linecap="round"
            stroke-linejoin="round"
            @click="destroy($page.url, index, requirementIndex)"
        >
            <polyline points="3 6 5 6 21 6" />
            <path
                d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"
            />
            <line x1="10" y1="11" x2="10" y2="17" />
            <line x1="14" y1="11" x2="14" y2="17" />
        </svg>
    </div>
</template>
<script>
import { inject } from "vue";
export default {
    props: {
        index: Number,
        requirementIndex: Number,
    },
    setup() {
        const pages = inject("pages");

        const deleteData = inject("deleteData");
        const destroy = (url, index, detailIndex) => {
            if (url.split("/")[1] == "create") {
                pages[index].requirements.splice(detailIndex, 1);
            } else {
                let deleteContent = pages[index].requirements.splice(
                    detailIndex,
                    1
                )[0];
                if (deleteContent.id) {
                    deleteData.pageRequirements.push({
                        page_id: pages[index].id,
                        id: deleteContent.id,
                    });
                }
            }
        };
        return { pages, destroy };
    },
};
</script>
