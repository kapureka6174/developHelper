<template>
    <div
        class="
            leading-sm
            inline-flex
            items-center
            mx-2
            my-1
            px-3
            py-1
            text-blue-700 text-xs
            font-bold
            hover:bg-blue-100
            bg-blue-200
            rounded-full
            uppercase
        "
    >
        {{ tagname }}
        <button
            class="inline-block align-middle w-6 h-6 text-gray-500 rounded-full focus:outline-none"
            @click="selectTag(index)"
        >
            <svg
                class="mx-auto w-6 h-6 fill-current"
                xmlns="http://www.w3.org/2000/svg"
                viewBox="0 0 24 24"
            >
                <path
                    fill-rule="evenodd"
                    d="M15.78 14.36a1 1 0 0 1-1.42 1.42l-2.82-2.83-2.83 2.83a1 1 0 1 1-1.42-1.42l2.83-2.82L7.3 8.7a1 1 0 0 1 1.42-1.42l2.83 2.83 2.82-2.83a1 1 0 0 1 1.42 1.42l-2.83 2.83 2.83 2.82z"
                />
            </svg>
        </button>
    </div>
</template>

<script>
    export default {
        props: {
            tagname: String,
        },
        setup(props, ctx) {
            const selectTag = (index) => {
                ctx.emit("selectTag", index);
            };

            return { selectTag };
        },
    };
</script>
