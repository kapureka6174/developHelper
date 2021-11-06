<template>
    <section-title title="タスク" />
    <div
        v-if="$page.props.user == null || $page.props.user.id != $page.props.service.user_id"
        class="grid gap-4 grid-cols-1 md:grid-cols-3"
    >
        <div
            v-for="(task, index) in classifiedTasks()"
            :key="index"
            class="px-2 py-6 w-full bg-gray-100 rounded"
        >
            <h2 class="mx-auto my-1 w-4/5 text-center text-gray-700 text-2xl font-bold">
                {{ task.state }}
            </h2>
            <div v-for="(content, index) in task.contents" :key="index" class="my-2">
                <p
                    class="
                        mx-auto
                        py-3
                        w-11/12
                        text-center text-gray-600
                        font-semibold
                        bg-blue-200
                        rounded
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
