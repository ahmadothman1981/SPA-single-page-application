<template>
<div>
    <span class="font-bold">{{ listing.beds }} </span>Beds | <span class="text-gary-500">{{ listing.baths }} </span>ba | <span class=" font-bold text-gary-500">{{ listing.area }} </span>m2
</div>
</template>
<script setup>
defineProps({
    listing:Object,
})
</script>