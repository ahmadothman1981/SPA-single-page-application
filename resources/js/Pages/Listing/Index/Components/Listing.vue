<template>
     <Box >
    <div>
      <Link :href="`/listings/${listing.id}`"><h2>{{listing.city}}</h2></Link>
      <div class="flex items-center gap-1">
        <Price :price="listing.price" class="text-2xl font-bold"/>
        <div class="text-xs font-bold text-gray-500">
         <Price :price="monthlyPayment" />pm
        </div>
      </div>
      <ListingSpace :listing="listing" class="text-lg"/>
        <ListingAddress :listing="listing" class="text-gray-500"/>
    </div>
    <div>
        <Link :href="`/listings/${listing.id}/edit`">Edit</Link>

    </div>
    <div>
       <Link :href="`/listings/${listing.id}`" method="delete">Delete</Link>
    </div>
    </Box>
</template>
<script setup>
import {Link} from '@inertiajs/vue3'
import ListingAddress from '../../../../Components/ListingAddress.vue'
import Box from '../../../../Components/UI/Box.vue'
import ListingSpace from '../../../../Components/UI/ListingSpace.vue'
import Price from '../../../../Components/Price.vue'
import { useMonthlyPayment } from '../../../../Composables/useMonthlyPayment.js'


   const props =  defineProps({
        listing:Object,
    })
    const {monthlyPayment} = useMonthlyPayment(props.listing.price, 2.5, 25)
</script>
