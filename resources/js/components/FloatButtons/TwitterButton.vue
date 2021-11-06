<template>
    <button
        class="
            group
            relative
            flex
            inline-block
            items-center
            justify-center
            my-4
            w-12
            h-12
            bg-white
            border-2 border-blue-500
            rounded-full
            shadow-xl
            cursor-pointer
        "
    >
        <svg
            class="w-8 h-8 text-blue-500"
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
            <path
                d="M22 4.01c-1 .49-1.98.689-3 .99-1.121-1.265-2.783-1.335-4.38-.737S11.977 6.323 12 8v1c-3.245.083-6.135-1.395-8-4 0 0-4.182 7.433 4 11-1.872 1.247-3.739 2.088-6 2 3.308 1.803 6.913 2.423 10.034 1.517 3.58-1.04 6.522-3.723 7.651-7.742a13.84 13.84 0 0 0 .497 -3.753C20.18 7.773 21.692 5.25 22 4.009z"
            />
        </svg>
        <div
            class="
                absolute
                bottom-full
                mb-2
                px-3
                py-2
                w-28
                text-center text-gray-600 text-xs
                bg-gray-200
                rounded-lg
                opacity-0
                group-hover:opacity-100
                pointer-events-none
            "
        >
            Twitterでツイート
            <svg
                class="absolute left-0 top-full w-full h-2 text-gray-200"
                x="0px"
                y="0px"
                viewBox="0 0 255 255"
                xml:space="preserve"
            >
                <polygon class="fill-current" points="0,0 127.5,127.5 255,0" />
            </svg>
        </div>
    </button>
</template>
