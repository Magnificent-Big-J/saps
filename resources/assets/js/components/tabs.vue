<template>
    <div>
        <nav class="mb-2">
            <ul class="nav nav-pills">
                <li class="nav-item mr-2" v-for="tab in tabs" :class="{ 'active': tab.isActive }">
                    <a :href="tab.href" @click="selectTab(tab)" class="nav-link active">{{ tab.name }}</a>
                </li>
            </ul>
        </nav>

        <div class="tabs-details">
            <slot></slot>
        </div>
    </div>
</template>

<script>
    export default {
        name: "tabs",
        data() {
            return { tabs: [] };
        },

        created() {
            this.tabs = this.$children;
        },

        methods: {
            selectTab(selectedTab) {
                this.tabs.forEach(tab => {
                    tab.isActive = (tab.href == selectedTab.href);
                });
            }
        }
    }
</script>

<style scoped>

</style>