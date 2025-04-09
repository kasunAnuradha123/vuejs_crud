<template>
    <div>
        <component
            v-if="link"
            :is="children?.length > 0 ? 'NavMulti' : 'NavSingle'"
            :name="name"
            :startWith="startWith"
            :routeName="routeName"
            :icon="icon"
            :svg="svg"
            :children="children"
        />
        <NavSeparator v-else-if="border" :name="name" />
        <NavTitle v-else :name="name" />
    </div>
</template>

<script>
import { usePage } from "@inertiajs/vue3";
import NavSeparator from "./NavSeparator.vue";
import NavTitle from "./NavTitle.vue";
import NavMulti from "./NavMulti.vue";
import NavSingle from "./NavSingle.vue";

export default {
    components: {
        NavSeparator,
        NavTitle,
        NavMulti,
        NavSingle,
    },
    props: {
        startWith: {
            type: String,
            default: true,
        },
        routeName: {
            type: String,
            default: true,
        },
        name: {
            type: String,
            required: true,
        },
        link: {
            type: Boolean,
            required: true,
        },
        border: {
            type: Boolean,
            required: true,
        },
        icon: {
            type: [String, Object],
            default: true,
        },
        children: {
            type: Array,
            required: true,
        },
        svg: {
            type: [String, Object],
            default: true,
        },
    },
    setup() {
        const { url } = usePage();

        function isActive(startWith) {
            if (startWith === "/admin") {
                return url === startWith;
            } else {
                return url.startsWith(startWith || "");
            }
        }

        return {
            isActive,
        };
    },
};
</script>