<script setup>
import { router } from "@inertiajs/vue3";
import DatePicker from "@/components/DatePicker.vue";
import { handleSubmit } from "@/helpers/client-req-handler";
import { scrollToFirstErrorField } from "@/helpers/utils";
import { useForm, usePage } from "@inertiajs/vue3";
import LocaleNumberInput from "@/components/LocaleNumberInput.vue";

const title = "Profil Akademi";
const page = usePage();
const form = useForm({
  academy_name: page.props.data.academy_name,
  founded_date: page.props.data.founded_date,
  owner_name: page.props.data.owner_name,
  fee_amount: page.props.data.fee_amount,
});

const submit = () =>
  handleSubmit({ form, url: route("settings.academy-profile") });
</script>

<template>
  <i-head :title="title" />
  <authenticated-layout>
    <template #title>{{ title }}</template>
    <div class="row justify-center">
      <div class="col col-md-6 q-pa-sm q-px-sm">
        <q-form
          class="row"
          @submit.prevent="submit"
          @validation-error="scrollToFirstErrorField"
        >
          <q-card square flat bordered class="col">
            <q-card-section>
              <div class="text-h6 q-my-xs text-subtitle1">Profil Akademi</div>
              <p class="text-caption text-grey-9">Perbarui profil Akademi.</p>
              <q-input
                v-model.trim="form.academy_name"
                label="Nama Akademi"
                lazy-rules
                :disable="form.processing"
                :error="!!form.errors.academy_name"
                :error-message="form.errors.academy_name"
                :rules="[
                  (val) =>
                    (val && val.length > 0) || 'Nama Akademi harus diisi.',
                ]"
              />
              <date-picker
                v-model="form.founded_date"
                label="Tanggal Didirikan"
                lazy-rules
                :error="!!form.errors.founded_date"
                :error-message="form.errors.founded_date"
                :disable="form.processing"
              />
              <q-input
                v-model.trim="form.owner_name"
                label="Nama Pemilik"
                lazy-rules
                :disable="form.processing"
                :error="!!form.errors.name"
                :error-message="form.errors.name"
                :rules="[
                  (val) =>
                    (val && val.length > 0) || 'Nama Pemilik harus diisi.',
                ]"
              />
              <LocaleNumberInput
                v-model:modelValue="form.fee_amount"
                label="Besar Iuran"
                lazyRules
                :disable="form.processing"
                :error="!!form.errors.fee_amount"
                :errorMessage="form.errors.fee_amount"
                :rules="[
                  (val) => (val && val.length > 0) || 'Besar Iuran harus diisi.',
                ]"
              />
            </q-card-section>
            <q-card-section>
              <q-btn
                type="submit"
                color="primary"
                label="Simpan"
                :disable="form.processing"
                icon="save"
              />
            </q-card-section>
          </q-card>
        </q-form>
      </div>
    </div>
  </authenticated-layout>
</template>
