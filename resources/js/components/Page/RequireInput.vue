<template>
    <div class="flex items-center justify-around mb-3 w-full">
        <!-- ページの機能 -->
        <p class="mx-3 px-4 py-2 w-4/5 text-center text-gray-600 font-bold bg-gray-200 rounded-md">
            {{
                $page.url.split("/")[1] == "create"
                    ? pages[index].requirements[requirementIndex]
                    : pages[index].requirements[requirementIndex].content
            }}
        </p>
        <!-- 削除ボタン -->
        <svg
            class="mr-4 my-2 w-6 h-6 hover:text-red-400 text-red-600"
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

            // データの削除
            const deleteData = inject("deleteData");
            const destroy = (url, index, detailIndex) => {
                // 新規作成画面ならそのままデータ消す
                if (url.split("/")[1] == "create") {
                    pages[index].requirements.splice(detailIndex, 1);
                } else {
                    // 編集画面なら削除データをDBに引き渡すためにdeleteDataに保存（ただしidが既にあるデータのみ）
                    let deleteContent = pages[index].requirements.splice(detailIndex, 1)[0];
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
