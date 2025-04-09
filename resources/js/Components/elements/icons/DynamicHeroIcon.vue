<script>
import * as HeroIcons from "@heroicons/vue/20/solid";

export default {
    name: "DynamicHeroIcon",
    props: {
        icon: {
            type: String,
            required: true,
        },
        className: {
            type: String,
            required: true,
        },
    },
    computed: {
        SingleIcon() {
            return HeroIcons[this.icon];
        },
    },
};
</script>

<template>
    <component :is="SingleIcon" :class="className" />
</template>