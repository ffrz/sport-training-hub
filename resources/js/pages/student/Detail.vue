<script setup>
import { usePage } from "@inertiajs/vue3";

const page = usePage();
const title = "Rincian " + page.props.data.name;
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
              <div class="text-subtitle1 text-bold text-grey-8">
                Profil Siswa
              </div>
              <table class="detail">
                <tbody>
                  <tr>
                    <td>Nama Lengkap</td>
                    <td>:</td>
                    <td>{{ page.props.data.name }}</td>
                  </tr>
                  <tr>
                    <td>Tanggal Lahir</td>
                    <td>:</td>
                    <td>
                      {{
                        $dayjs(page.props.data.birth_date).format("D MMMM YYYY")
                      }}
                    </td>
                  </tr>
                  <tr>
                    <td>Usia</td>
                    <td>:</td>
                    <td>
                      {{
                        $dayjs().diff(
                          $dayjs(page.props.data.birth_date),
                          "year"
                        )
                      }}
                      tahun
                    </td>
                  </tr>
                  <tr>
                    <td>No. Telepon</td>
                    <td>:</td>
                    <td>{{ page.props.data.phone }}</td>
                  </tr>
                  <tr>
                    <td>Alamat</td>
                    <td>:</td>
                    <td>{{ page.props.data.address }}</td>
                  </tr>
                </tbody>
              </table>
            </q-card-section>
            <q-card-section>
              <div class="text-subtitle1 text-bold text-grey-8">
                Statistik Skill
              </div>
              <table class="detail">
                <tbody>
                  <tr>
                    <td style="width: 125px">Skill 1</td>
                    <td style="width: 1px">:</td>
                    <td>92</td>
                  </tr>
                  <tr>
                    <td>Skill 2</td>
                    <td>:</td>
                    <td>73</td>
                  </tr>
                  <tr>
                    <td>Skill 3</td>
                    <td>:</td>
                    <td>85</td>
                  </tr>
                  <tr>
                    <td>Skill 4</td>
                    <td>:</td>
                    <td>68</td>
                  </tr>
                  <tr>
                    <td>Skill 5</td>
                    <td>:</td>
                    <td>94</td>
                  </tr>
                </tbody>
              </table>
            </q-card-section>
            <q-card-section>
              <div class="text-subtitle1 text-bold text-grey-8">
                Informasi Ekstra
              </div>
              <table class="detail">
                <tbody>
                  <tr>
                    <td style="width: 125px">Akun Pengguna</td>
                    <td style="width: 1px">:</td>
                    <td>
                      <template v-if="!!page.props.data.user">
                        <i-link
                          :href="
                            route('admin.user.detail', {
                              id: page.props.data.user.id,
                            })
                          "
                        >
                          {{ page.props.data.user.username }}
                        </i-link>
                      </template>
                      <template v-else>
                        <span class="text-grey-9">Tidak terhubung</span>
                      </template>
                    </td>
                  </tr>
                  <tr>
                    <td style="width: 125px">Dibuat</td>
                    <td style="width: 1px">:</td>
                    <td>
                      {{
                        $dayjs(new Date(page.props.data.created_at)).format(
                          "DD MMMM YY HH:mm:ss"
                        )
                      }}
                    </td>
                  </tr>
                  <tr>
                    <td>Diperbarui</td>
                    <td>:</td>
                    <td>
                      {{
                        $dayjs(new Date(page.props.data.updated_at)).format(
                          "DD MMMM YY HH:mm:ss"
                        )
                      }}
                    </td>
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
