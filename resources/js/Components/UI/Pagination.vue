<template>
  <div class="flex gap-1">
    <template v-for="(link, index) in links" :key="index">
      <Link
        v-if="link.url"
        :href="link.url"
        class="py-2 px-4 rounded-md"
        :class="{
          'bg-indigo-500 dark:bg-indigo-800 text-white': link.active,
          'text-gray-700 dark:text-gray-300': !link.active
        }"
        preserve-scroll
      >
        <span v-html="link.label" />
      </Link>
      <span
        v-else
        class="py-2 px-4 rounded-md opacity-50 cursor-not-allowed"
        :class="{
          'bg-indigo-500 dark:bg-indigo-800 text-white': link.active,
          'text-gray-500 dark:text-gray-600': !link.active
        }"
      >
        <span v-html="link.label" />
      </span>
    </template>
  </div>
</template>

<script setup>
import { Link } from '@inertiajs/vue3'

defineProps({
  links: Array
})
</script>