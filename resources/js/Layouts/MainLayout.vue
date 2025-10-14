<template>
      <header class="border-b border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-900 w-full">
        <div class="container ">
            <nav class="flex justify-between items-center p-4">
                 <div class="text-lg font-medium">
                    <Link href="/listings">Home </Link>
                </div>
                <div class="text-xl text-indigo-600 dark:text-indigo-300 font-medium">
                    <Link href="/listings">Listings </Link>
                </div>
                <div class="text-lg font-medium btn-primary">
                    <Link href="/listings/create">Create New Listing </Link>
                </div>
               
            </nav>
        </div>
      </header>
      <main class="container mx-auto p-4">
        <div v-if="flashSuccess"
         class="bg-green-100 text-green-700 p-4 rounded-md shadow-sm border border-green-300">
         {{ flashSuccess }}
        </div>
          <slot>Default</slot>
      </main>
      
</template>
<script setup>
    import {Link ,usePage } from '@inertiajs/vue3'
    import { computed } from 'vue';
  
const page = usePage();
const flashSuccess = computed(() => page.props.flash.success);
   
</script>
