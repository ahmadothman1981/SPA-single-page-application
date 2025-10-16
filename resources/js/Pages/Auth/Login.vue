<template>
    <form @submit.prevent="login">
        <div class="w-1/2 mx-auto">
            <div>
            <label for="email" class="label">Email</label>
            <input type="email" id="email" name="email" required class="input" v-model="form.email"/>
            <div class="input-error" v-if="form.errors.email">{{ form.errors.email }}</div>
            </div>
            <div>
            <label for="password" class="label">Password</label>
            <input type="password" id="password" name="password" required class="input" v-model="form.password"/>
            <div class="input-error" v-if="form.errors.password">{{ form.errors.password }}</div>   
            </div>
            <div class="mt-4">
            <button type="submit" class="btn-primary w-full ">Login</button>
            <div class="mt-2 text-center">
                <Link href="/register" class="text-sm text-gray-600 dark:text-gray-300 font-medium">Need an account ? Click here </Link>
            </div>
            </div>
        </div>
    </form>
</template>
<script setup>
import {useForm , Link} from '@inertiajs/vue3';

const form = useForm({
    email: '',
    password: '',
});
const login = () => form.post('/login');
</script>