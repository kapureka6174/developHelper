<template>
    <div class="w-full bg-gray-100 rounded py-6 px-2">
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
            {{ state }}
        </h2>
        <service-task-normal-detail-content
            v-for="(content, index) in contents"
            :key="index"
            :taskname="content.taskname"
        />
    </div>
</template>
<script>
import ServiceTaskNormalDetailContent from "./ServiceTaskNormalDetailContent.vue";

export default {
    components: {
        ServiceTaskNormalDetailContent,
    },
    props: {
        state: String,
        contents: Array,
    },
    setup(props) {
        console.log(props.contents);
    },
};
</script>
