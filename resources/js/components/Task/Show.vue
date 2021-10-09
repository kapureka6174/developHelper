<template>
    <section-title title="タスク" />
    <div
        v-if="
            $page.props.user == null ||
            $page.props.user.id != $page.props.service.user_id
        "
        class="grid grid-cols-1 md:grid-cols-3 gap-4"
    >
        <div
            v-for="(task, index) in classifiedTasks()"
            :key="index"
            class="w-full bg-gray-100 rounded py-6 px-2"
        >
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
                {{ task.state }}
            </h2>
            <div
                v-for="(content, index) in task.contents"
                :key="index"
                class="my-2"
            >
                <p
                    class="
                        text-gray-600
                        font-semibold
                        mx-auto
                        py-3
                        w-11/12
                        bg-blue-200
                        rounded
                        text-center
                    "
                >
                    {{ content.taskname }}
                </p>
            </div>
        </div>
    </div>
</template>

<script>
import SectionTitle from "../Utility/SectionTitle";

export default {
    components: {
        SectionTitle,
    },
    props: {
        tasks: Array,
        id: Number,
    },
    setup(props) {
        const classifiedTasks = () => {
            const results = [];
            const states = ["やるべきこと", "開発中", "完了"];

            states.forEach((name) => {
                results.push({
                    state: name,
                    contents: props.tasks.filter((e) => e.state == name),
                });
            });

            return results;
        };

        return { classifiedTasks };
    },
};
</script>
