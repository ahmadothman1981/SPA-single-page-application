<template>
    
  <form @submit.prevent="update">
    <div>
      <div>
        <label>Beds</label>
        <input v-model.number="form.beds" type="text" />
        <div v-if="form.errors.beds" class="text-red-500">{{ form.errors.beds }}</div>
      </div>

      <div>
        <label>Baths</label>
        <input v-model="form.baths" type="text" />
        <div v-if="form.errors.baths" class="text-red-500">{{ form.errors.baths }}</div>
      </div>

      <div>
        <label>Area</label>
        <input v-model="form.area" type="text" />
        <div v-if="form.errors.area" class="text-red-500">{{ form.errors.area }}</div>
      </div>

      <div>
        <label>City</label>
        <input v-model="form.city" type="text" />
        <div v-if="form.errors.city" class="text-red-500">{{ form.errors.city }}</div>
      </div>

      <div>
        <label>Post Code</label>
        <input v-model="form.code" ype="text" />
        <div v-if="form.errors.code" class="text-red-500">{{ form.errors.code }}</div>
      </div>

      <div>
        <label>Street</label>
        <input v-model="form.street" type="text" />
        <div v-if="form.errors.street" class="text-red-500">{{ form.errors.street }}</div>
      </div>

      <div>
        <label>Street Nr</label>
        <input v-model="form.street_nr" type="text" />
        <div v-if="form.errors.street_nr" class="text-red-500">{{ form.errors.street_nr }}</div>
      </div>

      <div>
        <label>Price</label>
        <input v-model="form.price" type="text" />
        <div v-if="form.errors.price" class="text-red-500">{{ form.errors.price }}</div>
      </div>

      <div>
        <button type="submit">Update</button>
      </div>
    </div>
  </form>
</template>

<style scoped>
label {
  margin-right: 2em;
}

div {
  padding: 2px
}
</style>

<script setup>

import {useForm } from '@inertiajs/vue3';
const props =defineProps({
    listing:Object,
})
const form = useForm({
    beds: props.listing.beds,
    baths: props.listing.baths,
    area: props.listing.area,
    city: props.listing.city,
    code: props.listing.code,
    street: props.listing.street,
    street_nr: props.listing.street_nr,
    price: props.listing.price,

})
const update = () => form.put(`/listings/${props.listing.id}`)
</script>
