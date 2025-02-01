<script setup>
import { usePage } from "@inertiajs/vue3";
import { capitalizeFirstLetter, format_gender, pointToRating } from '@/helpers/utils';
import { ref } from "vue";

const page = usePage();
const title = page.props.data.name;

</script>

<template>
  <i-head :title="title" />
  <authenticated-layout>
    <template #title>{{ title }}</template>
    <q-page class="row justify-center">
      <div class="col col-lg-6 q-pa-sm">
        <div class="row">
          <q-card square flat bordered class="col">
            <q-card-section>

              <table class="detail">
                <tbody>
                  <tr>
                    <td style="width: 125px">Nama Grup</td>
                    <td style="width: 1px">:</td>
                    <td>{{ page.props.data.name }}</td>
                  </tr>
                  <tr>
                    <td>Jumlah Siswa</td>
                    <td>:</td>
                    <td>{{ 1 }}</td>
                  </tr>
                </tbody>
              </table>
            </q-card-section>
          </q-card>
        </div>
      </div>
    </q-page>
  </authenticated-layout>
</template>
