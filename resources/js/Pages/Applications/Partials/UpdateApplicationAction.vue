<script setup>
import Modal from '@/Components/Modal.vue';
import { useForm } from '@inertiajs/vue3';
import TextInput from '@/Components/TextInput.vue';
import InputLabel from '@/Components/InputLabel.vue';
import InputError from '@/Components/InputError.vue';
import SelectInput from '@/Components/SelectInput.vue';
import TextArea from '@/Components/TextArea.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { watch } from 'vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';

const props = defineProps({
  updateModalOpen: Boolean,
  application: Object,
  action: Object,
  statusFilters: Array,
});

const emits = defineEmits(['closeModal']);

const form = useForm({
  status: props.action?.new_status ? props.action.new_status.toLowerCase() : '',
  title: props.action?.title ?? '',
  notes: props.action?.notes ?? '',
  interview_date: props?.application?.interview_date ?? '',
  interview_time: props?.application?.interview_time ?? '',
});

watch(
  () => props.action,
  (action) => {
    form.status = action?.new_status ? action.new_status.toLowerCase() : '';
    form.title = action?.title ?? '';
    form.notes = action?.notes ?? '';
  }
);

const submit = () => {
  form.put(
    route('application-action.update', [props.application.id, props.action.id]),
    {
      preserveScroll: true,
      onSuccess: () => {
        form.reset();
        emits('closeModal');
      },
    }
  );
};

const removeAction = () => {
  if (confirm('Are you sure you want to remove this action?')) {
    form.delete(
      route('application-action.destroy', [
        props.application.id,
        props.action.id,
      ]),
      {
        preserveScroll: true,
        onSuccess: () => {
          form.reset();
          emits('closeModal');
        },
      }
    );
  }
};
</script>

<template>
  <Modal :show="updateModalOpen" @close="$emit('closeModal')">
    <form @submit.prevent="submit">
      <div>
        <InputLabel for="status" value="Status" />
        <SelectInput
          id="status"
          class="mt-1 block w-full"
          v-model="form.status"
          :options="statusFilters"
        />
        <InputError class="mt-2" :message="form.errors.status" />
      </div>
      <div v-if="form.status === 'interview_scheduled'" class="mt-4">
        <InputLabel for="interview_date" value="Interview Date" />
        <TextInput
          id="interview_date"
          type="date"
          class="mt-1 block w-full"
          v-model="form.interview_date"
        />
        <InputError class="mt-2" :message="form.errors.interview_date" />
      </div>
      <div v-if="form.status === 'interview_scheduled'" class="mt-4">
        <InputLabel for="interview_time" value="Interview Time" />
        <TextInput
          id="interview_time"
          type="time"
          class="mt-1 block w-full"
          v-model="form.interview_time"
        />
        <InputError class="mt-2" :message="form.errors.interview_time" />
      </div>
      <div class="mt-4">
        <InputLabel for="title" value="Action" />
        <TextInput
          id="title"
          type="text"
          class="mt-1 block w-full"
          v-model="form.title"
        />
        <InputError class="mt-2" :message="form.errors.title" />
      </div>
      <div class="mt-4">
        <InputLabel for="notes" value="Notes" />
        <TextArea
          id="notes"
          type="text"
          class="mt-1 block w-full"
          v-model="form.notes"
        />
        <InputError class="mt-2" :message="form.errors.notes" />
      </div>
      <div class="flex items-center justify-end gap-4 mt-4">
        <SecondaryButton
          :class="{ 'opacity-25': form.processing }"
          :disabled="form.processing"
          @click.prevent="removeAction"
        >
          Remove
        </SecondaryButton>
        <PrimaryButton
          :class="{ 'opacity-25': form.processing }"
          :disabled="form.processing"
        >
          Save
        </PrimaryButton>
      </div>
    </form>
  </Modal>
</template>
