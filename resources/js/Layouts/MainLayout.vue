<template>
      <header class="border-b border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-900 w-full">
        <div class="container mx-auto">
            <nav class="flex items-center p-4">
                <div class="flex-1">
                    <Link href="/listings" class="text-lg font-medium">Home</Link>
                </div>
                <div class="flex-1 text-center">
                    <Link href="/listings" class="text-xl text-indigo-600 dark:text-indigo-300 font-medium">Listings</Link>
                </div>
                <div class="flex-1 flex justify-end">
                    <div v-if="user" class="text-sm font-small flex items-center gap-2">
                        <Link :href="'/realtor/listings'" class="text-lg font-small text-indigo-600 dark:text-indigo-300">
                           
                            {{ user.name || 'Guest' }}
                        </Link>
                        <Link class="btn-primary" href="/listings/create">Create Listing</Link>
                        <div>
                            <form @submit.prevent="logout">
                                
                                <button type="submit" class="btn-primary">Logout</button>
                            </form>
                        </div>
                    </div>
                    <div v-else class="flex items-center gap-2">
                         <Link href="/register" class="btn-primary">Register</Link>
                        <Link href="/login" class="btn-primary">Login</Link>
                    </div>
                </div>
            </nav>
        </div>
      </header>
      <main class="container mx-auto p-4 w-full">
        <div v-if="flashSuccess"
         class="bg-green-100 text-green-700 p-4 rounded-md shadow-sm border border-green-300">
         {{ flashSuccess }}
        </div>
          <slot>Default</slot>
      </main>
      
</template>
<script setup>
    import {Link ,usePage , useForm} from '@inertiajs/vue3'
    import { computed } from 'vue';
  
const page = usePage();
const flashSuccess = computed(() => page.props.flash.success,
);
const user = computed(() => page.props.user,
);

const form = useForm({
    email: '',
    password: '',
});
const logout = () => form.post('/logout');



   
</script>
