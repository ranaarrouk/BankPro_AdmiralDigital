<template>
    <PageComponent title="Dashboard">
        <span class="mt-5 tex-xl font-medium flex justify-center">
            Welcome {{ user.name }} to Bank Pro
        </span>
    </PageComponent>
</template>

<script setup>

    import PageComponent from "../components/PageComponent.vue";

    import store from "../store";
    import {computed} from "vue";

    const user = computed(() => store.state.user.data);

</script>

<style scoped>

</style>
