<template>
    <div>
        <button
            type="submit"
            class="
                block
                px-4
                py-2
                w-full
                text-left text-gray-700 text-sm
                leading-5
                hover:bg-gray-100
                focus:bg-gray-100 focus:outline-none
                transition
            "
            v-if="as == 'button'"
        >
            <slot></slot>
        </button>

        <a
            :href="href"
            class="
                block
                px-4
                py-2
                text-gray-700 text-sm
                leading-5
                hover:bg-gray-100
                focus:bg-gray-100 focus:outline-none
                transition
            "
            v-else-if="as == 'a'"
        >
            <slot></slot>
        </a>

        <inertia-link
            :href="href"
            class="
                block
                px-4
                py-2
                text-gray-700 text-sm
                leading-5
                hover:bg-gray-100
                focus:bg-gray-100 focus:outline-none
                transition
            "
            v-else
        >
            <slot></slot>
        </inertia-link>
    </div>
</template>

<script>
    export default {
        props: ["href", "as"],
    };
</script>
