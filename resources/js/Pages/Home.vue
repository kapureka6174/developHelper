<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                ホーム
            </h2>
        </template>

        <div class="mx-2 py-6">
            <hero />
            <div
                class="
                    flex
                    items-center
                    flex-col
                    md:grid md:grid-cols-3 md:gap-4
                    pb-12
                "
            >
                <cards
                    v-for="(type, index) in [1, 2, 3]"
                    :key="index"
                    :type="type"
                />
            </div>
            <div
                class="
                    flex
                    items-center
                    flex-col
                    md:grid md:grid-cols-3 md:gap-4
                    pb-12
                "
            >
                <intro
                    v-for="(type, index) in [1, 2, 3]"
                    :key="index"
                    :type="type"
                />
            </div>
        </div>
    </app-layout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout";
import Hero from "../components/Home/Hero";
import Cards from "../components/Home/Cards";
import Intro from "../components/Home/Intro";

export default {
    components: {
        AppLayout,
        Hero,
        Cards,
        Intro,
    },
};
</script>
