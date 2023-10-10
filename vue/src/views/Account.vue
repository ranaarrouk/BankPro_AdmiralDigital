<template>
    <PageComponent title="My account information">
        <div class="overflow-x-auto">
            <table class="min-w-full border-collapse border border-gray-300">
                <thead>
                <tr>
                    <th class="bg-gray-100 border border-gray-300 px-4 py-2">Account number</th>
                    <th class="bg-gray-100 border border-gray-300 px-4 py-2 ">Balance</th>
                </tr>
                </thead>
                <tbody>
                <tr class="text-center">
                    <td class="border border-gray-300 px-4 py-2">{{ user.account_number}}</td>
                    <td class="border border-gray-300 px-4 py-2 ">{{ user.balance}}</td>
                </tr>
                </tbody>
            </table>
        </div>
    </PageComponent>
</template>

<script setup>

    import PageComponent from "../components/PageComponent.vue";
    import store from "../store";
    import {computed} from "vue";
    import {ref} from "vue";

    let errorMsg = ref('');

    const user = computed(() => store.state.user.data);
</script>


<style scoped>

</style>
