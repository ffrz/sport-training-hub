<template>
  <q-input v-model="pickedDate" :label="props.label" :readonly="props.readonly" :disable="props.disable"
    :error="props.error" :rules="[...props.rules]" :error-message="errorMessage" :mask="props.mask"
    >
    <template v-slot:append>
      <!-- Date Picker Icon -->
      <q-icon name="event" class="cursor-pointer">
        <q-popup-proxy cover transition-show="scale" transition-hide="scale">
          <q-date v-model="dateValue" mask="YYYY-MM-DD" @update:model-value="updateDate">
            <div class="row items-center justify-end">
              <q-btn v-close-popup label="Close" color="primary" flat />
            </div>
          </q-date>
        </q-popup-proxy>
      </q-icon>
    </template>
  </q-input>
</template>

<script setup>
import { ref, watch, defineProps, defineEmits, onMounted } from 'vue';

const props = defineProps({
  modelValue: {
    type: String,
    required: true,
  },
  label: {
    type: String,
    default: '',
  },
  readonly: {
    type: Boolean,
    default: false,
  },
  disable: {
    type: Boolean,
    default: false,
  },
  error: {
    type: Boolean,
    default: false,
  },
  errorMessage: {
    type: String,
    default: '',
  },
  rules: {
    type: Array,
    default: [],
  },
  mask: {
    type: String,
    default: '####-##-##',
  }
});

const emit = defineEmits(['update:modelValue']);
const dateValue = ref('');

onMounted(() => {
  if (props.modelValue !== '') {
    dateValue.value = props.modelValue;
  }
});

watch(() => props.modelValue, (newValue) => {
  const [date, time] = newValue.split(' ');
  dateValue.value = date || '';
});

const pickedDate = ref(props.modelValue);

const updateDate = () => {
  let val = '';
  if (dateValue.value) {
    val = `${dateValue.value} 00:00`;
  }

  emit('update:modelValue', val);
  pickedDate.value = val;
};

</script>


