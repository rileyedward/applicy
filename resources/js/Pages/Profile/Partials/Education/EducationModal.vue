<script setup>
import Modal from '@/Components/Breeze/Modal.vue';
import { useForm } from '@inertiajs/vue3';
import TextInput from '@/Components/Breeze/TextInput.vue';
import InputLabel from '@/Components/Breeze/InputLabel.vue';
import InputError from '@/Components/Breeze/InputError.vue';
import TextArea from '@/Components/Breeze/TextArea.vue';
import SecondaryButton from '@/Components/Breeze/SecondaryButton.vue';
import PrimaryButton from '@/Components/Breeze/PrimaryButton.vue';
import { computed, watch } from 'vue';

const props = defineProps({
  show: Boolean,
  selectedEducationExperience: {
    type: Object,
    required: false,
  },
});

const emits = defineEmits(['close']);

watch(
  () => props.selectedEducationExperience,
  (value) => {
    form.institution_name = value?.institution_name ?? '';
    form.location = value?.location ?? '';
    form.degree = value?.degree ?? '';
    form.field_of_study = value?.field_of_study ?? '';
    form.start_date = value?.start_date ?? '';
    form.end_date = value?.end_date ?? '';
    form.description = value?.description ?? '';
  }
);

const formTitle = computed(() => {
  if (props.selectedEducationExperience) {
    return 'Manage Education Experience';
  }

  return 'Add Education Experience';
});

const form = useForm({
  institution_name: props.selectedEducationExperience?.institution_name ?? '',
  location: props.selectedEducationExperience?.location ?? '',
  degree: props.selectedEducationExperience?.degree ?? '',
  field_of_study: props.selectedEducationExperience?.field_of_study ?? '',
  start_date: props.selectedEducationExperience?.start_date ?? '',
  end_date: props.selectedEducationExperience?.end_date ?? '',
  description: props.selectedEducationExperience?.description ?? '',
});

const createEducationExperience = () => {
  form.post(route('education.store'), {
    onSuccess: () => {
      form.reset();
      emits('close');
    },
  });
};

const updateEducationExperience = () => {
  form.put(route('education.update', props.selectedEducationExperience.id), {
    onSuccess: () => {
      form.reset();
      emits('close');
    },
  });
};

const removeEducationExperience = () => {
  if (confirm('Are you sure you want to delete this education experience?')) {
    form.delete(
      route('education.destroy', props.selectedEducationExperience.id),
      {
        onSuccess: () => {
          form.reset();
          emits('close');
        },
      }
    );
  }
};
</script>

<template>
  <Modal :show="show" @close="$emit('close')">
    <div class="p-6">
      <h3 class="text-lg font-medium text-neutral-100 mb-4">{{ formTitle }}</h3>

      <form class="space-y-6">
        <div class="flex flex-col lg:flex-row gap-4">
          <div class="flex-1">
            <InputLabel for="institution_name" value="Institution Name" />
            <TextInput
              v-model="form.institution_name"
              id="institution_name"
              type="text"
              class="mt-1 block w-full bg-neutral-700 border-none"
              placeholder="Monster University"
            />
            <InputError :message="form.errors.institution_name" class="mt-1" />
          </div>
          <div class="flex-1">
            <InputLabel for="location" value="Location" />
            <TextInput
              v-model="form.location"
              id="location"
              type="text"
              class="mt-1 block w-full bg-neutral-700 border-none"
              placeholder="Monstropolis"
            />
            <InputError :message="form.errors.location" class="mt-1" />
          </div>
        </div>

        <div class="flex flex-col lg:flex-row gap-4">
          <div class="flex-1">
            <InputLabel for="degree" value="Degree" />
            <TextInput
              v-model="form.degree"
              id="degree"
              type="text"
              class="mt-1 block w-full bg-neutral-700 border-none"
              placeholder="Bachelor of Scaring"
            />
            <InputError :message="form.errors.degree" class="mt-1" />
          </div>
          <div class="flex-1">
            <InputLabel for="field_of_study" value="Field of Study" />
            <TextInput
              v-model="form.field_of_study"
              id="field_of_study"
              type="text"
              class="mt-1 block w-full bg-neutral-700 border-none"
              placeholder="Scaring"
            />
            <InputError :message="form.errors.field_of_study" class="mt-1" />
          </div>
        </div>

        <div class="flex flex-col lg:flex-row gap-4">
          <div class="flex-1">
            <InputLabel for="start_date" value="Start Date" />
            <TextInput
              v-model="form.start_date"
              id="start_date"
              type="date"
              class="mt-1 block w-full bg-neutral-700 border-none"
            />
            <InputError :message="form.errors.start_date" class="mt-1" />
          </div>
          <div class="flex-1">
            <InputLabel for="end_date" value="End Date" />
            <TextInput
              v-model="form.end_date"
              id="end_date"
              type="date"
              class="mt-1 block w-full bg-neutral-700 border-none"
            />
            <InputError :message="form.errors.end_date" class="mt-1" />
          </div>
        </div>

        <div>
          <InputLabel for="description" value="Description" />
          <TextArea
            v-model="form.description"
            id="description"
            class="mt-1 block w-full bg-neutral-700 border-none"
          />
          <InputError :message="form.errors.description" class="mt-1" />
        </div>

        <div class="flex justify-end gap-4">
          <SecondaryButton
            v-if="selectedEducationExperience"
            @click.prevent="removeEducationExperience"
          >
            Remove
          </SecondaryButton>
          <PrimaryButton
            v-if="selectedEducationExperience"
            @click.prevent="updateEducationExperience"
            class="bg-orange-600 hover:bg-orange-500"
          >
            Update
          </PrimaryButton>
          <PrimaryButton
            v-else
            @click.prevent="createEducationExperience"
            class="bg-orange-600 hover:bg-orange-500"
          >
            Add
          </PrimaryButton>
        </div>
      </form>
    </div>
  </Modal>
</template>
