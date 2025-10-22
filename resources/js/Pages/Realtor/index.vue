<template>
    <h1 class="text-2xl font-bold mb-4">Your Listings</h1>
    <section>
       <RealtorFilters :filters="filters"/>
    </section>
    <section class="grid grid-cols-1 lg:grid-cols-2 gap-2">

        <Box v-for="listing in listings.data" :key="listing.id" :listing="listing">
            <div class="flex flex-col md:flex-row gap-2 md:items-center justify-between">
                <div>
                    <div class="xl:flex items-center gap-2">
                        <Price :price="listing.price" class="text-2xl font-medium"/>
                        <ListingSpace :listing="listing"/>
                        </div>
                        <ListingAddress :listing="listing" class="text-gray-500"/>
                </div>

                <div class="flex items-center gap-2 text-gray-500 dark:text-gray-400">
                <Link class="btn-outline text-xs font-medium">Perview</Link>
                 <Link class="btn-outline text-xs font-medium" :href="`/realtor/listings/${listing.id}/edit`">Edit</Link> 
                 <Link class="btn-outline text-xs font-medium" :href="`/realtor/listings/${listing.id}`" as="button" method="delete">Delete</Link> 

                </div>
            </div>
        </Box>
    </section>
    <section v-if="listings.data.length" class="w-full flex justify-center mt-4 mb-4">
        <Pagination :links="listings.links"  />
    </section>
</template>
<script setup>
import Box from '../../Components/UI/Box.vue'
import Price from '../../Components/Price.vue'
import ListingSpace from '../../Components/UI/ListingSpace.vue'
import ListingAddress from '../../Components/ListingAddress.vue'
import RealtorFilters from '../../Pages/Realtor/Components/RealtorFilters.vue'
import Pagination from '../../Components/UI/Pagination.vue'
import {Link} from '@inertiajs/vue3'


defineProps({
    listings: {
        type: Object, 
    },
    filters: {
        type: Object, 
    },
});
</script>