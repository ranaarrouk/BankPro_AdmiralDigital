<template>
    <PageComponent title="Transfer">
        <div v-if="0" class="flex justify-center text-xl font-bold text-indigo-500">
            Loading...
        </div>
        <div v-else class="flex justify-center">
            <form class="w-full max-w-lg" @submit.prevent="transfer">
                <div v-if="errorMsg"
                     class="flex items-center justify-between mb-5 px-6 py-3 bg-red-500 text-white rounded">
                    {{ errorMsg }}
                    <span @click="errorMsg = ''"
                          class="w-8 h-8 flex items-center justify-center rounded-full transition-colors cursor-pointer hover:bg-[rgba(0,0,0,0.2)]">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" strokeWidth={1.5}
               stroke="currentColor" className="w-6 h-6">
            <path strokeLinecap="round" strokeLinejoin="round" d="M6 18L18 6M6 6l12 12"/>
          </svg>
        </span>
                </div>
                <div class="flex flex-wrap -mx-3 mb-6">
                    <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                               for="account_number">
                            Account Number
                        </label>
                        <input
                            class="appearance-none block w-full bg-gray-200 text-gray-700 border border-red-500 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                            id="account_number" name="account_number" v-model="model.account_number" type="text"
                            placeholder="xxxxxxxxxx">
                        <p class="text-red-500 text-xs italic">Please fill out this field.</p>
                    </div>
                    <div class="w-full md:w-1/2 px-3">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                               for="amount">
                            Amount
                        </label>
                        <input
                            class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                            id="amount" name="amount" v-model="model.amount" type="text" placeholder="0">
                    </div>
                    <div class="px-4 py-3 bg-grey-50 text-right sm:px-6">
                        <button type="submit"
                                class="inline-flex justify-center
                  px-4 py-2 bg-indigo-600 hover:bg-indigo-700
                  border border-transparent text-white shadow-sm
                  focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 focus:outline-none
                  sm:text-sm font-medium">Save
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </PageComponent>
</template>

<script setup>

    import PageComponent from "../components/PageComponent.vue";
    import store from "../store";
    import {computed} from "vue";
    import {ref} from "vue";

    let errorMsg = ref('');

    const model = ref({
        account_number: null,
        amount: 0
    });

    function transfer() {
        errorMsg.value = null;
        if (model.value.amount <= 0)
            errorMsg.value = "The amount field must be at least 0.1";

        store.dispatch('transfer', model.value)
            .then((res) => {
                store.commit('notify', {
                    type: 'success',
                    message: 'Transfer successfully'
                });
            }).catch(err => {
            errorMsg.value = err.response.data.message;
        });
    }
</script>


<style scoped>

</style>
