<template>
  <h1> My dashboard</h1>
  <h1> {{ user.token}}</h1>
</template>

<script setup>
import {computed} from 'vue';
import store from "../store";

const user = computed(() => store.state.user)
</script>

<style scoped>

</style>
