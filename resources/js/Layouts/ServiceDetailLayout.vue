/* eslint-disable no-undef */
<template>
    <div>
        <jet-banner />

        <div class="min-h-screen bg-gray-100">
            <navbar />

            <!-- Page Heading -->
            <header class="bg-white shadow" v-if="$slots.header">
                <div class="mx-auto px-4 py-6 max-w-7xl sm:px-6 lg:px-8">
                    <slot name="header"></slot>
                </div>
            </header>

            <!-- Page Content -->
            <main>
                <div class="py-12">
                    <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                        <div class="grid md:gap-4 md:grid-cols-8">
                            <slot></slot>
                        </div>
                    </div>
                </div>
            </main>
            <hr />
            <footer />
        </div>
    </div>
</template>

<script>
    import Navbar from "../components/Layout/Navbar";
    import Footer from "../components/Layout/Footer";

    export default {
        components: {
            Navbar,
            Footer,
        },
    };
</script>
