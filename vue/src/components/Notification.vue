<template>
  <div v-if="notification.show"
       class="fixed w-[500px] px-4 py-2 left-4 bottom-4 text-white animate-fade-in-down"
       :class="[notification.type === 'success' ? 'bg-green-500' : 'bg-red-500']">
    {{ notification.message }}
  </div>
</template>

<script setup>

  import {useStore} from "vuex";
  import {computed} from "vue";

  const store = useStore();
  const notification = computed(() => store.state.notification);

</script>

<style scoped>

</style>
