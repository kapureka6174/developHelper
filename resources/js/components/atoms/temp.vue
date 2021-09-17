<template>
    <!-- 開発中 -->
    <div class="w-full bg-gray-100 rounded p-6">
        <div class="flex items-center">
            <h2
                class="
                    text-gray-700
                    font-bold
                    text-2xl
                    mx-auto
                    my-1
                    w-4/5
                    text-center
                "
            >
                開発中
            </h2>
            <svg
                class="h-8 w-8 text-blue-500 hover:text-blue-300"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor"
                @click="
                    form.tasks.push({
                        taskname: '',
                        state: '開発中',
                        decidable: false,
                        isDelete: false,
                    })
                "
            >
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M12 4v16m8-8H4"
                />
            </svg>
        </div>
        <div
            v-for="task in getArray('開発中')"
            :key="task.index"
            class="my-2 flex items-center"
        >
            <input
                v-if="!form.tasks[task.index].decidable"
                type="text"
                v-model="form.tasks[task.index].taskname"
                @keyup.enter="addContent($event, task.index)"
                class="
                    appearance-none
                    block
                    w-4/5
                    bg-white
                    text-gray-700
                    border border-gray-200
                    rounded
                    py-3
                    mx-auto
                    leading-tight
                    focus:outline-none
                    focus:ring-1
                    focus:ring-blue-500
                    focus:border-blue-500
                "
            />
            <div
                v-else
                class="
                    mx-auto
                    bg-blue-200
                    w-4/5
                    rounded
                    text-center
                    flex
                    items-center
                    px-4
                    py-3
                    justify-between
                "
            >
                <svg
                    class="
                        h-8
                        w-8
                        text-blue-500
                        flex-shrink-0
                        hover:text-blue-300
                    "
                    width="24"
                    height="24"
                    viewBox="0 0 24 24"
                    stroke-width="2"
                    stroke="currentColor"
                    fill="none"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    @click="form.tasks[task.index].state = 'やるべきこと'"
                >
                    <path stroke="none" d="M0 0h24v24H0z" />
                    <polyline points="15 6 9 12 15 18" />
                </svg>
                <p
                    class="text-gray-600 font-semibold"
                    @click="form.tasks[task.index].decidable = false"
                >
                    {{ form.tasks[task.index].taskname }}
                </p>
                <svg
                    class="
                        h-8
                        w-8
                        text-blue-500
                        flex-shrink-0
                        hover:text-blue-300
                    "
                    width="24"
                    height="24"
                    viewBox="0 0 24 24"
                    stroke-width="2"
                    stroke="currentColor"
                    fill="none"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    @click="form.tasks[task.index].state = '完了'"
                >
                    <path stroke="none" d="M0 0h24v24H0z" />
                    <polyline points="9 6 15 12 9 18" />
                </svg>
            </div>
            <svg
                class="h-6 w-6 text-red-600 hover:text-red-400"
                viewBox="0 0 24 24"
                fill="none"
                stroke="currentColor"
                stroke-width="2"
                stroke-linecap="round"
                stroke-linejoin="round"
                @click="form.tasks[task.index].isDelete = true"
            >
                <polyline points="3 6 5 6 21 6" />
                <path
                    d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"
                />
                <line x1="10" y1="11" x2="10" y2="17" />
                <line x1="14" y1="11" x2="14" y2="17" />
            </svg>
        </div>
    </div>
    <!-- 完了 -->
    <div class="w-full bg-gray-100 rounded p-6">
        <div class="flex items-center">
            <h2
                class="
                    text-gray-700
                    font-bold
                    text-2xl
                    mx-auto
                    my-1
                    w-4/5
                    text-center
                "
            >
                完了
            </h2>
            <svg
                class="h-8 w-8 text-blue-500 hover:text-blue-300"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor"
                @click="
                    form.tasks.push({
                        taskname: '',
                        state: '完了',
                        decidable: false,
                        isDelete: false,
                    })
                "
            >
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M12 4v16m8-8H4"
                />
            </svg>
        </div>
        <div
            v-for="task in getArray('完了')"
            :key="task.index"
            class="my-2 flex items-center"
        >
            <input
                v-if="!form.tasks[task.index].decidable"
                type="text"
                v-model="form.tasks[task.index].taskname"
                @keyup.enter="addContent($event, task.index)"
                class="
                    appearance-none
                    block
                    w-4/5
                    bg-white
                    text-gray-700
                    border border-gray-200
                    rounded
                    py-3
                    mx-auto
                    leading-tight
                    focus:outline-none
                    focus:ring-1
                    focus:ring-blue-500
                    focus:border-blue-500
                "
            />
            <div
                v-else
                class="
                    mx-auto
                    bg-blue-200
                    w-4/5
                    rounded
                    text-center
                    flex
                    items-center
                    px-4
                    py-3
                    justify-between
                "
            >
                <svg
                    class="
                        h-8
                        w-8
                        text-blue-500
                        flex-shrink-0
                        hover:text-blue-300
                    "
                    width="24"
                    height="24"
                    viewBox="0 0 24 24"
                    stroke-width="2"
                    stroke="currentColor"
                    fill="none"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    @click="form.tasks[task.index].state = '開発中'"
                >
                    <path stroke="none" d="M0 0h24v24H0z" />
                    <polyline points="15 6 9 12 15 18" />
                </svg>
                <p
                    class="text-gray-600 font-semibold"
                    @click="form.tasks[task.index].decidable = false"
                >
                    {{ form.tasks[task.index].taskname }}
                </p>
            </div>
            <svg
                class="h-6 w-6 text-red-600 hover:text-red-400"
                viewBox="0 0 24 24"
                fill="none"
                stroke="currentColor"
                stroke-width="2"
                stroke-linecap="round"
                stroke-linejoin="round"
                @click="form.tasks[task.index].isDelete = true"
            >
                <polyline points="3 6 5 6 21 6" />
                <path
                    d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"
                />
                <line x1="10" y1="11" x2="10" y2="17" />
                <line x1="14" y1="11" x2="14" y2="17" />
            </svg>
        </div>
    </div>
</template>
