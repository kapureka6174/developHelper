<template>
    <button
        class="
            p-0
            w-10
            h-10
            bg-white
            rounded-full
            active:shadow-lg
            mouse
            shadow-xl
            transition
            ease-in
            duration-200
            focus:outline-none
            fixed
            bottom-10
            left-20
            md:hidden
            flex
            items-center
            justify-center
            border-gray-500 border-2
        "
    >
        <svg
            class="h-8 w-8 text-gray-500 relative"
            width="24"
            height="24"
            viewBox="0 0 24 24"
            stroke-width="2"
            stroke="currentColor"
            fill="none"
            stroke-linecap="round"
            stroke-linejoin="round"
        >
            <path stroke="none" d="M0 0h24v24H0z" />
            <rect x="8" y="8" width="12" height="12" rx="2" />
            <path
                d="M16 8v-2a2 2 0 0 0 -2 -2h-8a2 2 0 0 0 -2 2v8a2 2 0 0 0 2 2h2"
            />
        </svg>
        <div
            v-if="copied"
            class="
                w-32
                text-gray-600 text-center text-xs
                rounded-lg
                py-2
                absolute
                bottom-10
                px-3
                pointer-events-none
                bg-white
            "
        >
            リンクをコピーしました
        </div>
    </button>
</template>

<script>
export default {
    props: {
        copied: Boolean,
    },
};
</script>
