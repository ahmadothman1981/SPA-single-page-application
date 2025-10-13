<template>
    
         <div>
        <h1>index</h1>
        <Link href="/show">Show Page </Link>
        <p>{{message}}</p>
    </div>
    
   
</template>

<script setup>
    import {Link } from '@inertiajs/vue3'
    
    
    defineProps(['message'])
</script>
