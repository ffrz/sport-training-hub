<script setup>
import { handleSubmit } from "@/helpers/client-req-handler";
import { create_options } from "@/helpers/utils";
import { validateEmail } from "@/helpers/validations";
import { router, useForm, usePage } from "@inertiajs/vue3";

const roles = create_options(window.CONSTANTS.USER_ROLES);
const page = usePage();
const title = !!page.props.data.id ? 'Edit Pengguna' : 'Tambah Pengguna';
const form = useForm({
  id: page.props.data.id,
  name: page.props.data.name,
  email: page.props.data.email,
  password: "",
  role: !!page.props.data.role ? page.props.data.role : roles[0].value,
  active: !!page.props.data.active,
});

const submit = () =>
  handleSubmit({form, url: route('user.save')});

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
              <q-input autofocus v-model.trim="form.name" label="Nama" lazy-rules :error="!!form.errors.name"
                :disable="form.processing" :error-message="form.errors.name" :rules="[
                  (val) => (val && val.length > 0) || 'Nama harus diisi.',
                ]" />
              <q-input v-model.trim="form.email" type="email" label="Email" lazy-rules :disable="form.processing"
                :error="!!form.errors.email" :error-message="form.errors.email"
                :rules="[(val) => validateEmail(val) || 'Email harus valid.']" />
              <q-input v-model="form.password" type="password" label="Kata Sandi" lazy-rules :disable="form.processing"
                :error="!!form.errors.password" :error-message="form.errors.password" />
              <q-select v-model="form.role" label="Hak Akses" :options="roles" map-options emit-value lazy-rules
                :disable="form.processing" transition-show="jump-up" transition-hide="jump-up"
                :error="!!form.errors.role" :error-message="form.errors.role">
              </q-select>
              <div style="margin-left:-10px;">
                <q-checkbox class="full-width" v-model="form.active" :disable="form.processing" label="Aktif" />
              </div>
            </q-card-section>
            <q-card-actions>
              <q-btn icon="save" type="submit" label="Simpan" color="primary" :disable="form.processing"
                @click="submit" />
              <q-btn icon="cancel" label="Batal" class="text-black" :disable="form.processing"
                @click="router.get(route('user.index'))" />
            </q-card-actions>
          </q-card>
        </q-form>
      </div>
    </div>
  </authenticated-layout>
</template>
