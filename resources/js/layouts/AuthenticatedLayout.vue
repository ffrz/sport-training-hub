<script setup>
import {
  computed,
  defineComponent,
  onMounted,
  onUnmounted,
  ref,
  watch,
} from "vue";
import { router, usePage } from "@inertiajs/vue3";
import { useQuasar } from "quasar";

defineComponent({
  name: "AuthenticatedLayout",
});

const $q = useQuasar();
const page = usePage();
const leftDrawerOpen = ref(
  JSON.parse(localStorage.getItem("sth.layout.left-drawer-open"))
);
const isDropdownOpen = ref(false);
const activeTab = ref(null);
const toggleLeftDrawer = () => (leftDrawerOpen.value = !leftDrawerOpen.value);

watch(leftDrawerOpen, (newValue) => {
  localStorage.setItem("sth.layout.left-drawer-open", newValue);
});

onMounted(() => {
  leftDrawerOpen.value = JSON.parse(
    localStorage.getItem("sth.layout.left-drawer-open")
  );

  // tutup aja drawernya, kan layar kecil kasian user
  if ($q.screen.lt.md) {
   leftDrawerOpen.value = false;
  }
});

const hasSubpath = computed(() => {
  const segments = page.url.split("/").filter(Boolean); // Split the path and filter out empty segments
  return segments.length > 1; // More than one segment indicates a subpath
});
</script>

<template>
  <q-layout view="lHh LpR lFf">
    <q-header>
      <q-toolbar class="bg-grey-1 text-black toolbar-scrolled">
        <q-btn
          v-if="!leftDrawerOpen"
          flat
          dense
          aria-label="Menu"
          @click="toggleLeftDrawer"
        >
          <q-icon class="material-symbols-outlined">dock_to_right</q-icon>
        </q-btn>
        <slot name="left-button"></slot>
        <q-toolbar-title
          :class="{ 'q-ml-sm': leftDrawerOpen }"
          style="font-size: 18px"
        >
          <slot name="title">{{ $config.APP_NAME }}</slot>
        </q-toolbar-title>
        <slot name="right-button"></slot>
      </q-toolbar>
      <slot name="header"></slot>
    </q-header>
    <q-drawer
      v-if="true || !$q.screen.lt.sm"
      v-model="leftDrawerOpen"
      bordered
      class="bg-grey-2"
      style="color: #444"
    >
      <div
        class="absolute-top"
        style="
          height: 50px;
          border-bottom: 1px solid #ddd;
          align-items: center;
          justify-content: center;
        "
      >
        <div
          style="
            width: 100%;
            padding: 8px;
            display: flex;
            justify-content: space-between;
          "
        >
          <q-btn-dropdown
            v-model="isDropdownOpen"
            class="profile-btn text-bold"
            flat
            :label="page.props.auth.user.name"
            style="
              justify-content: space-between;
              flex-grow: 1;
              overflow: hidden;
            "
            :class="{ 'profile-btn-active': isDropdownOpen }"
          >
            <q-list id="profile-btn-popup" style="color: #444">
              <q-item>
                <q-avatar style="margin-left: -15px"
                  ><q-icon class="material-symbols-outlined"
                    >person</q-icon
                  ></q-avatar
                >
                <q-item-section>
                  <q-item-label>
                    <div class="text-bold">{{ page.props.auth.user.name }}</div>
                  </q-item-label>
                </q-item-section>
              </q-item>
              <q-separator />
              <q-item
                dense
                v-close-popup
                class="subnav"
                clickable
                v-ripple
                :active="$page.url.startsWith('/settings/profile')"
                @click="router.get(route('profile.edit'))"
              >
                <q-item-section>
                  <q-item-label>
                    <q-icon class="material-symbols-outlined q-mr-sm"
                      >account_circle</q-icon
                    >
                    Profil Saya
                  </q-item-label>
                </q-item-section>
              </q-item>
              <q-item
                dense
                clickable
                v-close-popup
                v-ripple
                :href="route('logout')"
              >
                <q-item-section>
                  <q-item-label><q-icon name="logout" class="q-mr-sm" />Logout</q-item-label>
                </q-item-section>
              </q-item>
            </q-list>
          </q-btn-dropdown>
          <q-btn
            v-if="leftDrawerOpen"
            flat
            dense
            aria-label="Menu"
            @click="toggleLeftDrawer"
          >
            <q-icon class="material-symbols-outlined">dock_to_right</q-icon>
          </q-btn>
        </div>
      </div>
      <q-scroll-area style="height: calc(100% - 50px); margin-top: 50px">
        <q-list id="main-nav" style="margin-bottom: 50px">
          <q-item
            clickable
            v-ripple
            :active="$page.url.startsWith('/dashboard')"
            @click="router.get(route('dashboard'))"
          >
            <q-item-section avatar>
              <q-icon class="material-symbols-outlined">dashboard</q-icon>
            </q-item-section>
            <q-item-section>
              <q-item-label>Dashboard</q-item-label>
            </q-item-section>
          </q-item>
          <!-- <q-expansion-item
            expand-separator
            icon="storage"
            label="Teknis"
            :default-opened="$page.url.startsWith('/admin/settings')"
          >
            <q-item
              clickable
              v-ripple
              :active="$page.url.startsWith('/players')"
              @click="router.get(route('player.index'))"
            >
              <q-item-section avatar>
                <q-icon class="material-symbols-outlined">groups_2</q-icon>
              </q-item-section>
              <q-item-section>
                <q-item-label>Pemain</q-item-label>
              </q-item-section>
            </q-item>
            <q-item
              clickable
              v-ripple
              :active="$page.url.startsWith('/coaches')"
              @click="router.get(route('coach.index'))"
            >
              <q-item-section avatar>
                <q-icon class="material-symbols-outlined">group</q-icon>
              </q-item-section>
              <q-item-section>
                <q-item-label>Pelatih</q-item-label>
              </q-item-section>
            </q-item>
          </q-expansion-item> -->
          <q-expansion-item
            expand-separator
            icon="storage"
            label="Manajemen"
            :default-opened="$page.url.startsWith('/management')"
          >
            <q-item
              clickable
              v-ripple
              :active="$page.url.startsWith('/management/students')"
              @click="router.get(route('student.index'))"
            >
              <q-item-section avatar>
                <q-icon class="material-symbols-outlined">group</q-icon>
              </q-item-section>
              <q-item-section>
                <q-item-label>Siswa</q-item-label>
              </q-item-section>
            </q-item>
            <q-item
              clickable
              v-ripple
              :active="$page.url.startsWith('/management/student-groups')"
              @click="router.get(route('student-group.index'))"
            >
              <q-item-section avatar>
                <q-icon class="material-symbols-outlined">groups_2</q-icon>
              </q-item-section>
              <q-item-section>
                <q-item-label>Grup Siswa</q-item-label>
              </q-item-section>
            </q-item>
            <q-item
              clickable
              v-ripple
              :active="$page.url.startsWith('/management/coaches')"
              @click="router.get(route('coach.index'))"
            >
              <q-item-section avatar>
                <q-icon class="material-symbols-outlined">person</q-icon>
              </q-item-section>
              <q-item-section>
                <q-item-label>Pelatih</q-item-label>
              </q-item-section>
            </q-item>
          </q-expansion-item>
          <q-expansion-item
            expand-separator
            icon="settings"
            label="Pengaturan"
            :default-opened="$page.url.startsWith('/settings')"
          >
            <q-item
              class="subnav"
              clickable
              v-ripple
              :active="$page.url.startsWith('/settings/users')"
              @click="router.get(route('user.index'))"
            >
              <q-item-section avatar>
                <q-icon name="group" />
              </q-item-section>
              <q-item-section>
                <q-item-label>Pengguna</q-item-label>
              </q-item-section>
            </q-item>
            <q-item
              class="subnav"
              clickable
              v-ripple
              :active="$page.url.startsWith('/settings/profile')"
              @click="router.get(route('profile.edit'))"
            >
              <q-item-section avatar>
                <q-icon name="manage_accounts" />
              </q-item-section>
              <q-item-section>
                <q-item-label>Profil Saya</q-item-label>
              </q-item-section>
            </q-item>
            <q-item
              class="subnav"
              clickable
              v-ripple
              :active="$page.url.startsWith('/settings/academy-profile')"
              @click="router.get(route('settings.academy-profile'))"
            >
              <q-item-section avatar>
                <q-icon name="apartment" />
              </q-item-section>
              <q-item-section>
                <q-item-label>Profil Akademi</q-item-label>
              </q-item-section>
            </q-item>
          </q-expansion-item>

          <div class="absolute-bottom text-grey-6 q-pa-md">
            &copy; 2025 -
            {{ $config.APP_NAME + " v" + $config.APP_VERSION_STR }}
          </div>
        </q-list>
      </q-scroll-area>
    </q-drawer>
    <q-page-container class="bg-grey-1">
      <q-page>
        <slot></slot>
      </q-page>
    </q-page-container>
    <!-- Footer hanya tampil jika di tampilan screen kecil, lihat di bagian style di bawah pada file ini -->
    <q-footer v-if="false && !hasSubpath">
      <q-tabs
        v-model="activeTab"
        indicator-color="yellow"
        class="bg-primary text-white shadow-2"
        align="justify"
        dense
      >
        <q-tab
          name="dashboard"
          icon="dashboard"
          label="Dashboard"
          @click="router.get(route('dashboard'))"
          :class="$page.url.startsWith('/dashboard') ? 'active' : ''"
        />
        <q-tab
          name="training"
          icon="sports_handball"
          label="Latihan"
          @click="router.get(route('training.index'))"
          :class="$page.url.startsWith('/trainings') ? 'active' : ''"
        />
        <q-tab
          name="settings"
          icon="settings"
          label="Pengaturan"
          @click="router.get(route('profile.edit'))"
          :class="$page.url.startsWith('/settings') ? 'active' : ''"
        />
      </q-tabs>
    </q-footer>
  </q-layout>
</template>

<style>
.q-tabs .q-tab {
  width: 33.33%;
}

.q-tabs .q-tab__label {
  font-weight: normal;
  text-transform: none;
  font-size: 12px;
}
.q-tabs .q-tab__icon {
  font-size: 20px;
  font-weight: normal;
}

.q-tabs .q-tab__icon,
.q-tabs .q-tab__label {
  opacity: 80%;
}

.q-tabs .active .q-tab__icon,
.q-tabs .active .q-tab__label,
.q-tabs .active .q-tab__indicator {
  opacity: 100%;
  color: white;
}

.q-tabs .active .q-tab__icon {
  font-size: 22px;
}

.q-tabs .active .q-tab__label {
  font-size: 13px;
}

.q-tabs .active * {
  color: white !important;
}

.q-tab {
  flex: 1 1 auto; /* Ensures all tabs take equal space */
  text-align: center;
}

.profile-btn span.block {
  text-align: left !important;
  width: 100% !important;
  margin-left: 10px !important;
}
</style>
<style scoped>
@media screen and (min-width: 768px) {
  .q-footer {
    display: none;
  }
}

/* .q-toolbar {
  border-bottom: 1px solid transparent;
} */

.toolbar-scrolled {
  /*box-shadow: 0px 1px 2px rgba(0, 0, 0, 0.05); */
  border-bottom: 1px solid #ddd;
}

.profile-btn-active {
  background-color: #ddd !important;
}

#profile-btn-popup .q-item--active {
  color: inherit !important;
}
</style>
