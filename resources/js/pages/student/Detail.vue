<script setup>
import { usePage } from "@inertiajs/vue3";
import { capitalizeFirstLetter, format_gender, pointToRating, calculateAge } from '@/helpers/utils';
import { ref } from "vue";

const page = usePage();
const title = page.props.data.name;
const rating = ref(4);
let total = 0;
let count = 0;


function generateRandomSkillData() {
  const categories = {
    technical: ["Passing", "Setting", "Spiking", "Blocking", "Serving", "Digging"],
    physical: ["Speed", "Jumping", "Balance", "Endurance", "Strength"],
    mental: ["Focus", "Tactical Intelligence", "Communication", "Mental Toughness"]
  };
  let skills = { technical: {}, physical: {}, mental: {} };

  Object.keys(categories).forEach(category => {
    categories[category].forEach(skill => {
      const point = Math.floor(Math.random() * (100 - 60 + 1)) + 60;
      skills[category][skill] = point;

      total += point;
      count ++;
    });
  });

  total = (total / count).toFixed(2);

  return skills;
}

function generateRandomAchievments() {
  const achievements = [
    "Best Spiker",
    "Best Blocker",
    "Best Server",
    "Best Setter",
    "Best Digger",
    "Best Receiver",
    "MVP (Most Valuable Player)",
    "Top Scorer",
    "Fair Play Award",
    "Champion",
    "Runner-up",
    "Third Place",
    "Undefeated Team",
    "Best Defensive Team",
    "Best Attacking Team",
    "Comeback Team",
    "Triple Crown",
    "Grand Slam",
    "Fastest Spike",
    "Perfect Game",
    "Longest Winning Streak"
  ];

  // Tentukan jumlah pencapaian yang dimiliki pemain (acak 1-5 pencapaian)
  const numAchievements = Math.floor(Math.random() * 5) + 1;

  // Pilih pencapaian secara acak tanpa duplikasi
  const playerAchievements = [];
  while (playerAchievements.length < numAchievements) {
    let randomAch = achievements[Math.floor(Math.random() * achievements.length)];
    if (!playerAchievements.includes(randomAch)) {
      playerAchievements.push(randomAch);
    }
  }

  return playerAchievements;
}

const skillData = ref(generateRandomSkillData());
const achievments = ref(generateRandomAchievments());

rating.value = pointToRating(total);

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
                    <td style="width: 125px">Nama Lengkap</td>
                    <td style="width: 1px">:</td>
                    <td>{{ page.props.data.name }}</td>
                  </tr>
                  <tr>
                    <td>Grup</td>
                    <td>:</td>
                    <td>{{ page.props.data.group ? page.props.data.group.name : 'Belum dipilih' }}</td>
                  </tr>
                  <tr>
                    <td>Jenis Kelamin</td>
                    <td>:</td>
                    <td>{{ format_gender(page.props.data.gender) }}</td>
                  </tr>
                  <tr>
                    <td>Overall Rating</td>
                    <td>:</td>
                    <td>
                      <q-rating
                        readonly
                        v-model="rating"
                        size="2em"
                        :max="5"
                        color="primary"
                      />
                    </td>
                  </tr>
                  <tr>
                    <td>Overall Point</td>
                    <td>:</td>
                    <td>{{ total }}</td>
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
                      {{ calculateAge(page.props.data.birth_date) }}
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
              <table class="detail q-mt-md" v-for="category in Object.keys(skillData)" :key="category">
                <tbody>
                  <tr>
                    <td colspan="3" class="text-bold text-grey-8">{{ capitalizeFirstLetter(category) }}</td>
                  </tr>
                  <tr v-for="skill in Object.keys(skillData[category])" :key="skill">
                    <td style="width:150px;">{{ skill }}</td>
                    <td style="width:1px">:</td>
                    <td>{{ skillData[category][skill] }}</td>
                  </tr>
                </tbody>
              </table>
            </q-card-section>
            <q-card-section>
              <div class="text-subtitle1 text-bold text-grey-8">Pencapaian</div>
              <table class="detail">
                <tbody v-if="achievments.length > 0">
                  <tr v-for="achievment in achievments" :key="achievment">
                    <td>{{ achievment }}</td>
                  </tr>
                </tbody>
                <tbody v-else>
                  <tr><td>Belum ada pencapaian</td></tr>
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
