<template>
    <PageComponent>
        <template v-slot:header>
            <div class="flex justify-between items-center">
                <h1 class="text-3xl font-bold tracking-tight text-gray-900">My Transactions</h1>
                <div class="">
                    <router-link
                        :to="{ name: 'Transactions'}"
                        class="px-3 py-2 rounded text-white bg-emerald-500 hover:bg-emerald-600">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 -mt-1 inline-block">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18.75a60.07 60.07 0 0115.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 013 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 00-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 01-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 003 15h-.75M15 10.5a3 3 0 11-6 0 3 3 0 016 0zm3 0h.008v.008H18V10.5zm-12 0h.008v.008H6V10.5z" />
                        </svg>
                        Deposit
                    </router-link>
                    <router-link
                        :to="{ name: 'Transactions'}"
                        class="px-3 py-2 rounded text-white bg-amber-500 hover:bg-amber-600 ml-3">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 -mt-1 inline-block">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 9.75h4.875a2.625 2.625 0 010 5.25H12M8.25 9.75L10.5 7.5M8.25 9.75L10.5 12m9-7.243V21.75l-3.75-1.5-3.75 1.5-3.75-1.5-3.75 1.5V4.757c0-1.108.806-2.057 1.907-2.185a48.507 48.507 0 0111.186 0c1.1.128 1.907 1.077 1.907 2.185z" />
                        </svg>
                        Transfer
                    </router-link>
                </div>
            </div>
        </template>
        <div v-if="transactions.loading" class="flex justify-center text-xl font-bold text-indigo-500">
            Loading...
        </div>
        <div v-else>
            <div class="overflow-x-auto">
                <table class="min-w-full border-collapse border border-gray-300">
                    <thead>
                    <tr>
                        <th class="bg-gray-100 border border-gray-300 px-4 py-2">Type</th>
                        <th class="bg-gray-100 border border-gray-300 px-4 py-2">From</th>
                        <th class="bg-gray-100 border border-gray-300 px-4 py-2">To</th>
                        <th class="bg-gray-100 border border-gray-300 px-4 py-2">Amount</th>
                        <th class="bg-gray-100 border border-gray-300 px-4 py-2">Date & Time</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="transaction in transactions.data" :key="transaction.id">
                        <td class="border border-gray-300 px-4 py-2">{{ transaction.type}}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ transaction.senderAccount}}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ transaction.recipientAccount}}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ transaction.amount}}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ transaction.created_at}}</td>
                    </tr>
                    <!-- Add more rows as needed -->
                    </tbody>
                </table>
            </div>
        </div>
    </PageComponent>
</template>

<script setup>

    import PageComponent from "../components/PageComponent.vue";
    import store from "../store";
    import {computed} from "vue";

    const transactions = computed(() => store.state.transactions);

    store.dispatch('getTransactions').then((res) => {
        alert('done')
    });
</script>


<style scoped>

</style>
