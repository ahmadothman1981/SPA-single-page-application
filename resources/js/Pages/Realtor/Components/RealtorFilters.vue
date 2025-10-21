<template>
<form>
    <div class="mb-4 mt-4 flex flex-wrap gap-2">
        <div class="flex flex-nowrap items-center">
            <input v-model="filterForm.deleted" id="deleted" type="checkbox" class=" h-4 w-4 rounded border=gray-300 text-indigo-600 focus:ring-indigo-500"/>
            <label for="deleted" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Show Deleted</label>
        </div>
    </div>
</form>

</template>
<script setup>
import {reactive , watch} from 'vue'
import { router } from '@inertiajs/vue3' 
import { debounce } from 'lodash'

const filterForm = reactive({
    deleted: false,
})

watch(
  () => filterForm.deleted,
  
  debounce(() => {
    router.get('/realtor/listings', filterForm, {
      preserveScroll: true,
      preserveState: true,
    })
  }, 500)
)
</script>


