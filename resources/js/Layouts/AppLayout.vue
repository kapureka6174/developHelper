/* eslint-disable no-undef */
<template>
    <div>
        <jet-banner />

        <div class="min-h-screen bg-gray-100">
            <navbar />

            <!-- Page Heading -->
            <header class="bg-white shadow" v-if="$slots.header">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    <slot name="header"></slot>
                </div>
            </header>

            <!-- Page Content -->
            <main>
                <div class="py-12">
                    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                        <div
                            class="
                                bg-white
                                overflow-hidden
                                shadow-xl
                                sm:rounded-lg
                            "
                        >
                            <slot></slot>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
</template>

<script>
import Navbar from "../components/Navbar";

export default {
    components: {
        Navbar,
    },
};
</script>
