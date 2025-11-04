<template>
    <div class="flex flex-col-reverse md:grid md:grid-cols-12 gap-4">
        <Box class=" col-span-12 md:col-span-7 flex items-center w-full">
          <div v-if="listing.images.length" class="grid grid-cols-2 gap-1">
            <img v-for="image in listing.images" :key="image.id" :src="image.src" class="w-40 h-7"/>
          </div>
           <div v-else class="w-full text-center font-medium text-gray-500"> No images</div>
        </Box>
        <div class="md:col-span-5 flex flex-col gap-4">
      <Box >
        <template #header>
            Basic info
        </template>
         <Price :price="listing.price" class="text-2xl font-bold"/>
         <ListingSpace :listing="listing" class="text-lg"/>
        <ListingAddress :listing="listing" class="text-gray-500"/>
      </Box>
      <Box>
         <template #header>
           Monthly Payment
        </template>
        <div>
          <label class="label">Interest rate ({{ interestRate }}%)</label>
          <input type="range" min="0.1" max="10" step="0.1" v-model.number="interestRate"
          class="w-full h-4 bg-gray-200 rounded-lg appearance-none cursor-pointer dark:bg-gray-700"/>
          <label class="label">Duration ({{ duration }} Years)</label>
          <input type="range" min="1" max="35" step="1" v-model.number="duration"
          class="w-full h-4 bg-gray-200 rounded-lg appearance-none cursor-pointer dark:bg-gray-700"/>

          <div class="text-gray-600 dark:text-gray-300 mt-2">
            <div class="text-gray-400">
                Monthly Payment
            </div>
            <Price :price="monthlyPayment" class="text-2xl font-bold"/> 
          </div>
          <div class="mt-2 text-gray-500">
            <div class="flex justify-between">
              <div>Total Paid</div>
              <div><Price :price="totalPaid"  class="text-md font-bold"/></div>
            </div>
             <div class="flex justify-between">
              <div>Principle Paid</div>
              <div><Price :price="listing.price"  class="text-md font-bold"/></div>
            </div>
             <div class="flex justify-between">
              <div>Interest Paid</div>
              <div><Price :price="totalInterest"  class="text-md font-bold"/></div>
            </div>
          </div>
        </div>
    </Box>
      </div>
    </div>

</template>
<script setup>
import ListingAddress from '../../Components/ListingAddress.vue'
import ListingSpace from '../../Components/UI/ListingSpace.vue'
import Price from '../../Components/Price.vue'
import Box from '../../Components/UI/Box.vue'
import {ref } from 'vue'
import { useMonthlyPayment } from '../../Composables/useMonthlyPayment.js'

const interestRate = ref(2.5)
const duration = ref(25)
const props =defineProps({
    listing:Object,
})
const {monthlyPayment , totalPaid , totalInterest} = useMonthlyPayment(props.listing.price , interestRate , duration)
</script>
<style></style>