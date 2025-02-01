<script setup>
import { handleSubmit } from "@/helpers/client-req-handler";
import { create_gender_options, create_options_v2, calculateAge } from "@/helpers/utils";
import { router, useForm, usePage } from "@inertiajs/vue3";
import DatePicker from "@/components/DatePicker.vue";
import { computed } from "vue";

const genders = create_gender_options();
const page = usePage();
const groups = create_options_v2(page.props.groups, "id", "name");
const title = !!page.props.data.id ? "Edit Siswa" : "Tambah Siswa";
const form = useForm({
  id: page.props.data.id,
  name: page.props.data.name,
  group_id: page.props.data.group_id,
  gender: page.props.data.gender,
  birth_date: page.props.data.birth_date ?? "",
  address: page.props.data.address,
  phone: page.props.data.phone,
  active: !!page.props.data.active,
});

const submit = () => handleSubmit({ form, url: route("student.save") });
const computedAge = computed(() => {
  return form.birth_date ? calculateAge(form.birth_date) + ' tahun' : 'Tgl lahir belum diisi.';
});
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
              <q-select
                v-model="form.gender"
                label="Jenis Kelamin"
                :options="genders"
                map-options
                emit-value
                lazy-rules
                :disable="form.processing"
                transition-show="jump-up"
                transition-hide="jump-up"
                :error="!!form.errors.gender"
                :error-message="form.errors.gender"
              />
              <date-picker
                v-model="form.birth_date"
                label="Tanggal Lahir"
                :error="!!form.errors.birth_date"
                :disable="form.processing"
              />
              <q-input
                readonly
                v-model="computedAge"
                label="Usia"
                error-message=""
              />
              <q-select
                v-model="form.group_id"
                label="Grup"
                :options="groups"
                map-options
                emit-value
                lazy-rules
                :disable="form.processing"
                transition-show="jump-up"
                transition-hide="jump-up"
                :error="!!form.errors.group_id"
                :error-message="form.errors.group_id"
              />
              <q-input
                v-model.trim="form.phone"
                label="Telepon"
                lazy-rules
                :disable="form.processing"
                :error="!!form.errors.phone"
                :error-message="form.errors.phone"
              />

              <q-input
                v-model.trim="form.address"
                type="textarea"
                autogrow
                counter
                maxlength="1000"
                label="Alamat"
                lazy-rules
                :disable="form.processing"
                :error="!!form.errors.address"
                :error-message="form.errors.address"
              />
              <div style="margin-left: -10px">
                <q-checkbox
                  class="full-width"
                  v-model="form.active"
                  :disable="form.processing"
                  label="Aktif"
                />
              </div>
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
                @click="router.get(route('student.index'))"
              />
            </q-card-actions>
          </q-card>
        </q-form>
      </div>
    </div>
  </authenticated-layout>
</template>
