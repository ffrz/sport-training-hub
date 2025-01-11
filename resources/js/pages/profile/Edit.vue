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
    <template #left-button v-if="$q.screen.lt.sm">
      <q-btn icon="arrow_back" dense flat @click="router.get(route('dashboard'))"/>
    </template>
    <template #title>{{ title }}</template>
    <template #right-button v-if="$q.screen.lt.md">
      <q-btn icon="logout" color="grey" label="Logout" dense  @click="logout"/>
    </template>
    <div class="row justify-center">
      <div class="col col-lg-6 q-py-md q-px-sm q-gutter-md">
        <UpdateProfileInformationForm />
        <UpdatePasswordForm />
      </div>
    </div>
  </authenticated-layout>
</template>
