<template>
   <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-4">
     <Box v-for="listing in listings" :key="listing.id">
    <div>
      <Link :href="`/listings/${listing.id}`"><h2>{{listing.city}}</h2></Link>
      <Price :price="listing.price" class="text-2xl font-bold"/>
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
   </div>
</template>
<script setup>
import {Link} from '@inertiajs/vue3'
import ListingAddress from '../../Components/ListingAddress.vue'
import Box from '../../Components/UI/Box.vue'
import ListingSpace from '../../Components/UI/ListingSpace.vue'
import Price from '../../Components/Price.vue'



    defineProps({
        listings:Array,
    })

</script>
