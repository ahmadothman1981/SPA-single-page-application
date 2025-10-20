<template>
  <form @submit.prevent="filter">
    <div class="mb-8 mt-4 flex flex-wrap gap-2">
      <!-- Price -->
      <div class="flex flex-nowrap items-center">
        <input
          type="number"
          inputmode="numeric"
          class="input-filter-l w-28"
          placeholder="Price Min"
          v-model.number="filterForm.priceFrom"
        />
        <input
          type="number"
          inputmode="numeric"
          placeholder="Price Max"
          class="input-filter-r w-28"
          v-model.number="filterForm.priceTo"
        />
      </div>

      <!-- Beds & Baths -->
      <div class="flex flex-nowrap items-center">
        <select class="input-filter-l w-28" v-model="filterForm.beds">
          <option :value="null" disabled>Beds</option>
          <option v-for="n in 5" :key="n" :value="n"> {{ n }} </option>
          <option :value="6">6+</option> <!-- ✅ Send number 6 -->
        </select>
        <select class="input-filter-r w-28" v-model="filterForm.baths">
          <option :value="null" disabled>Bath</option>
          <option v-for="n in 5" :key="n" :value="n"> {{ n }} </option>
          <option :value="6">6+</option> <!-- ✅ Send number 6 -->
        </select>
      </div>

      <!-- Area -->
      <div class="flex flex-nowrap items-center">
        <input
          type="number"
          inputmode="numeric"
          placeholder="Area from"
          class="input-filter-l w-28"
          v-model.number="filterForm.areaFrom"
        />
        <input
          type="number"
          inputmode="numeric"
          placeholder="Area to"
          class="input-filter-r w-28"
          v-model.number="filterForm.areaTo"
        />
      </div>

      <button type="submit" class="btn-normal">Filter</button>
      <button type="button" @click="clear" class="btn-normal">Clear</button>
    </div>
  </form>
</template>

<script setup>
import { useForm } from '@inertiajs/vue3'

const props = defineProps({
  filters: Object,
})

const filterForm = useForm({
  priceFrom: props.filters.priceFrom ?? null,
  priceTo: props.filters.priceTo ?? null,
  beds: props.filters.beds ?? null,
  baths: props.filters.baths ?? null,
  areaFrom: props.filters.areaFrom ?? null,
  areaTo: props.filters.areaTo ?? null,
})

const filter = () => {
  // 🔑 KEY FIX: Always reset to page 1 when filtering
  filterForm.get('/listings', {
    data: { page: 1 }, // 👈 forces first page of filtered results
    preserveState: true,
    preserveScroll: true,
  })
}

const clear = () => {
  filterForm.reset() // ✅ Clean reset to initial (null) values
  filter() // Re-fetch with empty filters (and page=1)
}
</script>