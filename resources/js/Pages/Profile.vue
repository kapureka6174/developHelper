<template>
    <app-layout>
        <template #header>
            <h2 class="text-gray-800 text-xl font-semibold leading-tight">プロフィール</h2>
        </template>

        <div>
            <div class="mx-auto py-10 max-w-7xl sm:px-6 lg:px-8">
                <div v-if="$page.props.jetstream.canUpdateProfileInformation">
                    <update-profile-information-form :user="$page.props.user" />

                    <jet-section-border />
                </div>

                <div v-if="$page.props.jetstream.canUpdatePassword">
                    <update-password-form class="mt-10 sm:mt-0" />

                    <jet-section-border />
                </div>

                <logout-other-browser-sessions-form :sessions="sessions" class="mt-10 sm:mt-0" />

                <template v-if="$page.props.jetstream.hasAccountDeletionFeatures">
                    <jet-section-border />

                    <delete-user-form class="mt-10 sm:mt-0" />
                </template>
            </div>
        </div>
    </app-layout>
</template>

<script>
    import AppLayout from "@/Layouts/AppLayout";
    import DeleteUserForm from "../components/Profile/DeleteUserForm";
    import JetSectionBorder from "@/Jetstream/SectionBorder";
    import LogoutOtherBrowserSessionsForm from "../components/Profile/LogoutOtherBrowserSessionsForm";
    import UpdatePasswordForm from "../components/Profile/UpdatePasswordForm";
    import UpdateProfileInformationForm from "../components/Profile/UpdateProfileInformationForm";

    export default {
        props: ["sessions"],

        components: {
            AppLayout,
            DeleteUserForm,
            JetSectionBorder,
            LogoutOtherBrowserSessionsForm,
            UpdatePasswordForm,
            UpdateProfileInformationForm,
        },
    };
</script>
