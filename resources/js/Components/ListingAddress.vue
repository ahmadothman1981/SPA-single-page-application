<template>
    <div>
        <h2>Street Number :{{listing.street}} </h2>
        <h2>City :{{ listing.city }}</h2>
    </div>
</template>
<script setup>
defineProps({
    listing:Object,
})
</script>
