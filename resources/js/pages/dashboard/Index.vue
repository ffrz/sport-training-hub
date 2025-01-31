<script setup>
import { onMounted } from "vue";


const title = "Dashboard";

onMounted(() => {

});


</script>

<template>
  <i-head :title="title" />
  <authenticated-layout>
    <template #title>{{ title }}</template>
    <div class="row justify-center">

    </div>
  </authenticated-layout>
</template>
