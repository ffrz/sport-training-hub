<script setup>
import { handleSubmit } from "@/helpers/client-req-handler";
import { router, useForm, usePage } from "@inertiajs/vue3";

const page = usePage();
const title = !!page.props.data.id ? "Edit Grup Siswa" : "Tambah Grup Siswa";
const form = useForm({
  id: page.props.data.id,
  name: page.props.data.name,
});

const submit = () => handleSubmit({ form, url: route("student-group.save") });
</script>

<template>
  <i-head :title="title" />
  <authenticated-layout>
    <template #title>{{ title }}</template>
    <div class="row justify-center">
      <div class="col col-md-6 q-pa-sm">
        <q-form class="row" @submit.prevent="submit">
          <q-card square flat bordered class="col">
            <q-card-section class="q-pt-none">
              <input type="hidden" name="id" v-model="form.id" />
              <q-input
                v-model.trim="form.name"
                label="Nama"
                lazy-rules
                :error="!!form.errors.name"
                :disable="form.processing"
                :error-message="form.errors.name"
                :rules="[
                  (val) => (val && val.length > 0) || 'Nama harus diisi.',
                ]"
              />
            </q-card-section>
            <q-card-actions>
              <q-btn
                icon="save"
                type="submit"
                label="Simpan"
                color="primary"
                :disable="form.processing"
                @click="submit"
              />
              <q-btn
                icon="cancel"
                label="Batal"
                class="text-black"
                :disable="form.processing"
                @click="router.get(route('student-group.index'))"
              />
            </q-card-actions>
          </q-card>
        </q-form>
      </div>
    </div>
  </authenticated-layout>
</template>
