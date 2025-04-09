<template>
    <div class="min-h-[100vh] h-full scroll-smooth bg-PrimaryBg">
        <AdminHeader :user="user" />
        <div class="relative h-full">
            <AdminSidebar :user="user" />
            <div class="flex flex-1 flex-col lg:pl-[300px] h-full min-h-[100vh]">
                <main class="container mx-auto flex-1 bg-PrimaryBg p-3 mt-3 sm:mt-0 sm:py-8 lg:p-2">
                    <slot />
                </main>
            </div>
            <!-- <AdminFooter /> -->
        </div>
        <!-- <FlashAlerts :flash="pageProps.flash" /> -->
    </div>
</template>

<script>
import { defineComponent } from "vue";
import { usePage } from "@inertiajs/vue3";
// import FlashAlerts from "@/Components/elements/Alert/FlashAlert.vue";
// import AdminFooter from "@/Components/shared/AdminFooter.vue";
import AdminHeader from "@/Components/Shared/AdminHeader.vue";
// import AdminSidebar from "@/Components/shared/AdminSidebar/AdminSideBar.vue";

export default defineComponent({
    components: {
        FlashAlerts,
        AdminFooter,
        AdminHeader,
        AdminSidebar,
    },
    setup() {
        const pageProps = usePage().props.value;
        const user = pageProps.auth?.user;

        console.log(pageProps, "pageProps");    
        return {
            pageProps,
            user,
        };

    },
});
</script>

