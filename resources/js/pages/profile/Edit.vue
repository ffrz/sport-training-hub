<script setup>
import UpdatePasswordForm from './partials/UpdatePasswordForm.vue';
import UpdateProfileInformationForm from './partials/UpdateProfileInformationForm.vue';
import { router } from "@inertiajs/vue3";
import axios from 'axios'; // For manual POST requests

const title = 'Profil Saya';

const logout = async () => {
    try {
        await axios.post(route('logout'));
        window.location.href = '/';
    } catch (error) {
        console.error('Logout failed:', error);
    }
};

</script>

<template>
  <i-head :title="title" />
  <authenticated-layout>
    <template #title>{{ title }}</template>
    <div class="row justify-center">
      <div class="col col-md-6 q-pa-sm q-col-gutter-sm">
        <UpdateProfileInformationForm />
        <UpdatePasswordForm />
      </div>
    </div>
  </authenticated-layout>
</template>
