<template>
  <Box>
    <template #header>Upload New Images</template>
    <form @submit.prevent="upload" enctype="multipart/form-data">
      <section class="flex items-center my-4 gap-2">
        <div>
          <input
            class="border rounded-md file:px-4 file:py-2 file:border-0 file:bg-[#f0f0f0] file:text-sm file:font-medium file:text-[#333]"
            ref="fileInput"
            type="file"
            @change="addFiles"
            multiple
            accept="image/*"
            name="files[]"
          />
          <button
            class="btn-outline disabled:opacity-25 disabled:cursor-not-allowed"
            type="submit"
            :disabled="selectedFiles.length === 0"
          >
            Upload
          </button>
          <button class="btn-outline" type="button" @click="reset">
            Reset
          </button>
        </div>
      </section>
    </form>
  </Box>
  <Box v-if="props.listing.images.length > 0" class="mt-4">
    <template #header>Preview Images</template>

    <section class="mt-4 grid grid-cols-3 gap-4">
     
    <div v-for="image in props.listing.images" :key="image.id" class="flex flex-col justify-between">
      <img :src="image.src" alt="Preview" class="w-40 h-40 object-cover rounded-md" />
   <Link
  :href="`/realtor/listings/${props.listing.id}/images/${image.id}`"
  method="delete"
  as="button"
  class="btn-outline mt-2 text-xs w-40 h-7"
>
  Delete
</Link>
     
    </div>
 
    </section>
  </Box>
 
</template>

<script setup>
import { ref } from 'vue';
import { router } from '@inertiajs/vue3';
import Box from '../../../Components/UI/Box.vue';
import {Link} from '@inertiajs/vue3'

const props = defineProps({
  listing: {
    type: Object,
    required: true,
  },
});

const fileInput = ref(null);
const selectedFiles = ref([]);

const addFiles = (event) => {
  selectedFiles.value = [...selectedFiles.value, ...Array.from(event.target.files)];
};

const upload = () => {
  const formData = new FormData();
  selectedFiles.value.forEach(file => {
    formData.append('files[]', file);
  });

  router.post(`/realtor/listings/${props.listing.id}/images`, formData, {
    preserveScroll: true,
    forceFormData: true,
    onSuccess: () => {
      reset();
    },
  });
};

const reset = () => {
  selectedFiles.value = [];
  if (fileInput.value) {
    fileInput.value.value = '';
  }
};
</script>