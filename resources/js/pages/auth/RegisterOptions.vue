<script setup>
import BtnLink from "@/components/BtnLink.vue";
</script>

<template>
  <i-head title="Daftar" />
  <guest-layout>
    <q-page class="row justify-center items-center">
      <div class="column">
        <div class="row">
          <q-card square bordered class="q-pt-sm q-pb-md q-px-md shadow-1">
            <q-card-section>
              <h6
                class="q-my-none text-center text-subtitle1 text-bold text-grey-8"
              >
                Buat Akun
              </h6>
            </q-card-section>

            <q-card-actions>
              <div class="full-width">
                <BtnLink
                  icon="email"
                  type="submit"
                  color="primary"
                  class="full-width"
                  label="Daftar dengan Email"
                  :url="route('register')"
                />
              </div>
            </q-card-actions>
            <q-card-actions>
              <div class="full-width">
                <q-btn
                  icon="arrow_right"
                  type="submit"
                  color="accent"
                  class="full-width"
                  label="Lanjutkan dengan akun Google"
                  :href="route('google.login')"
                />
              </div>
            </q-card-actions>
            <q-card-section
              class="flex justify-center items-center q-px-sm q-py-md"
            >
              <hr class="col line" />
              <span class="col-auto q-mx-sm">Sudah Punya Akun?</span>
              <hr class="col line" />
              <div class="full-width q-mt-md">
                <q-btn
                  icon="arrow_right"
                  type="submit"
                  color="primary"
                  class="full-width"
                  label="Masuk"
                  :href="route('login')"
                />
              </div>
            </q-card-section>
          </q-card>
        </div>
      </div>
    </q-page>
  </guest-layout>
</template>

<style scoped>
.line {
  border: none;
  border-top: 1px solid #ddd;
}
</style>
