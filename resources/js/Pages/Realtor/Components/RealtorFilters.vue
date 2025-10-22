<template>
<form>
    <div class="mb-4 mt-4 flex flex-wrap gap-2">
        <div class="flex flex-nowrap items-center">
            <input v-model="filterForm.deleted" id="deleted" type="checkbox" class=" h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500"/>
            <label for="deleted" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Show Deleted</label>
        </div>
        <div>
          <select class="input-filter-l w-28" v-model="filterForm.by">
            <option value="created_at">Added</option>
            <option value="price" >Price</option>
          </select>
          <select class="input-filter-r w-28" v-model="filterForm.order">
            <option v-for="option in sortOption" :key="option.value"
             :value="option.value">{{option.label}}</option>
          </select>
        </div>
    </div>
</form>

</template>
<script setup>
import {reactive , watch , computed } from 'vue'
import { router } from '@inertiajs/vue3' 
import { debounce } from 'lodash'

const sortLabels ={
  created_at : [{
    label : 'Latest',
    value : 'desc',
  },
  {
    label : 'Oldest',
    value : 'asc',
  }],
  price : [{
    label : 'Highest',
    value : 'desc',
  },
  {
    label : 'Lowest',
    value : 'asc',
  }],
}
const props = defineProps({
    filters: {
        type: Object, 
    },
});

const filterForm = reactive({
    deleted: props.filters.deleted,
    by: props.filters.by,
    order: props.filters.order,
})
const sortOption = computed(() => sortLabels[filterForm.by] )
watch(
  () =>({...filterForm}),
  
  debounce(() => {
    router.get('/realtor/listings', filterForm, {
      preserveScroll: true,
      preserveState: true,
    })
  }, 500)
)
</script>


