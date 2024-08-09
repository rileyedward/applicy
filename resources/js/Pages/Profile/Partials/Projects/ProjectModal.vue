<script setup>
import { useForm } from '@inertiajs/vue3';
import { computed, watch } from 'vue';
import Modal from '@/Components/Breeze/Modal.vue';
import SecondaryButton from '@/Components/Breeze/SecondaryButton.vue';
import PrimaryButton from '@/Components/Breeze/PrimaryButton.vue';
import InputLabel from '@/Components/Breeze/InputLabel.vue';
import TextInput from '@/Components/Breeze/TextInput.vue';
import InputError from '@/Components/Breeze/InputError.vue';
import TextArea from '@/Components/Breeze/TextArea.vue';

const props = defineProps({
  show: Boolean,
  selectedPortfolioProject: {
    type: Object,
    required: false,
  },
});

const emits = defineEmits(['close']);

watch(
  () => props.selectedPortfolioProject,
  (value) => {
    form.name = value?.name ?? '';
    form.description = value?.description ?? '';
    form.url = value?.url ?? '';
  }
);

const formTitle = computed(() => {
  if (props.selectedPortfolioProject) {
    return 'Manage Portfolio Project';
  }

  return 'Add Portfolio Project';
});

const form = useForm({
  name: props.selectedPortfolioProject?.name ?? '',
  description: props.selectedPortfolioProject?.description ?? '',
  url: props.selectedPortfolioProject?.url ?? '',
});

const createPortfolioProject = () => {
  form.post(route('portfolio.store'), {
    preserveScroll: true,
    onSuccess: () => {
      form.reset();
      emits('close');
    },
  });
};

const updatePortfolioProject = () => {
  form.put(route('portfolio.update', props.selectedPortfolioProject.id), {
    preserveScroll: true,
    onSuccess: () => {
      form.reset();
      emits('close');
    },
  });
};

const deletePortfolioProject = () => {
  if (confirm('Are you sure you want to delete this project?')) {
    form.delete(route('portfolio.destroy', props.selectedPortfolioProject.id), {
      preserveScroll: true,
      onSuccess: () => {
        form.reset();
        emits('close');
      },
    });
  }
};
</script>

<template>
  <Modal :show="show" @close="$emit('close')">
    <div class="p-6">
      <h3 class="text-lg font-medium text-neutral-100 mb-1">{{ formTitle }}</h3>
      <p class="text-sm text-neutral-300 mb-6">
        Add a new portfolio project to your profile.
      </p>

      <form class="space-y-6">
        <div class="w-full">
          <InputLabel for="name" value="Name" />
          <TextInput
            v-model="form.name"
            id="name"
            type="text"
            class="mt-1 block w-full bg-neutral-700 border-none"
            placeholder="Project Name"
          />
          <InputError :message="form.errors.name" class="mt-1" />
        </div>

        <div class="w-full">
          <InputLabel for="url" value="Project URL" />
          <TextInput
            v-model="form.url"
            id="url"
            type="text"
            class="mt-1 block w-full bg-neutral-700 border-none"
            placeholder="https://example.com"
          />
          <InputError :message="form.errors.url" class="mt-1" />
        </div>

        <div class="w-full">
          <InputLabel for="description" value="Description" />
          <TextArea
            v-model="form.description"
            id="url"
            class="mt-1 block w-full bg-neutral-700 border-none"
          />
          <InputError :message="form.errors.url" class="mt-1" />
        </div>

        <div class="flex justify-end gap-4">
          <SecondaryButton
            v-if="selectedPortfolioProject"
            @click.prevent="deletePortfolioProject"
          >
            Remove
          </SecondaryButton>
          <PrimaryButton
            v-if="selectedPortfolioProject"
            @click.prevent="updatePortfolioProject"
            class="bg-orange-600 hover:bg-orange-500"
          >
            Update
          </PrimaryButton>
          <PrimaryButton
            v-else
            @click.prevent="createPortfolioProject"
            class="bg-orange-600 hover:bg-orange-500"
          >
            Add
          </PrimaryButton>
        </div>
      </form>
    </div>
  </Modal>
</template>
