<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { ref, onMounted, computed } from 'vue';
import Layout from '../Layouts/Layout.vue';

defineOptions({
  layout: Layout
});

// Load cards from localStorage if available, otherwise use default value
const cards = ref(JSON.parse(localStorage.getItem('cards')) || [
  {
    project_name: 'HCA Battle of the Bands 2024',
    subject: 'Champion'
  }
]);

const projectName = ref('');
const projectSubject = ref('');
const showForm = ref(false);
const isEditing = ref(false);
const editingIndex = ref(null);

const buttonText = computed(() => (isEditing.value ? 'Save Changes' : 'Add Achievement'));

function toggleForm() {
  showForm.value = !showForm.value;
  if (!showForm.value) {
    resetForm();
  }
}

function resetForm() {
  projectName.value = '';
  projectSubject.value = '';
  isEditing.value = false;
  editingIndex.value = null;
}

function addCard() {
  cards.value.push({ project_name: projectName.value, subject: projectSubject.value });
  saveCardsToLocalStorage();
  resetForm();
}

function updateCard() {
  if (editingIndex.value !== null) {
    cards.value[editingIndex.value].project_name = projectName.value;
    cards.value[editingIndex.value].subject = projectSubject.value;
    saveCardsToLocalStorage();
    resetForm();
  }
}

function saveCardsToLocalStorage() {
  localStorage.setItem('cards', JSON.stringify(cards.value));
}

function handleSubmit() {
  if (isEditing.value) {
    updateCard();
  } else {
    addCard();
  }
  toggleForm();
}

function editCard(index) {
  projectName.value = cards.value[index].project_name;
  projectSubject.value = cards.value[index].subject;
  isEditing.value = true;
  editingIndex.value = index;
  showForm.value = true;
}

function removeCard(index) {
  const confirmation = confirm("Are you sure you want to delete this achievement?");
  if (confirmation) {
    cards.value.splice(index, 1);
    saveCardsToLocalStorage();
  }
}

onMounted(() => {
  document.querySelector('.project').classList.add('fade-in');
});
</script>


<template>
  <AuthenticatedLayout>
    <div class="project">
      <div class="project-header">
        <h2>Achievements</h2>
        <button class="button-54 project-button" @click="toggleForm">{{ isEditing.value ? 'Cancel' : 'Add' }}</button>
      </div>
      <hr class="hr" />
      <div id="card-container">
        <div class="card" v-for="(card, index) in cards" :key="index">
          <div class="button-container">
            <button class="edit-button" @click="editCard(index)">Edit</button>
            <button class="remove-button" @click="removeCard(index)">Delete</button>
          </div>
          <div class="card-content">
            <div class="text-content">
              <h3 class="card-project_name">{{ card.project_name }}</h3>
              <p>{{ card.subject }}</p>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="overlay" v-if="showForm">
      <div class="form-container slide-up" style="text-align: center;">
        <form @submit.prevent="handleSubmit">
          <label for="projectName">Event:</label>
          <input type="text" id="projectName" v-model="projectName" required />
          <label for="projectSubject">Achievement</label>
          <textarea id="projectSubject" v-model="projectSubject" required></textarea>
          <button type="submit">{{ buttonText }}</button>
        </form>
      </div>
    </div>
  </AuthenticatedLayout>
</template>

<style scoped>
@keyframes fadeIn {
  from {
    opacity: 0;
  }
  to {
    opacity: 1;
  }
}

.fade-in {
  animation: fadeIn 1s ease-in-out;
}

@keyframes slideUp {
  from {
    transform: translateY(100%);
  }
  to {
    transform: translateY(0);
  }
}

.slide-up {
  animation: slideUp 0.5s ease-out;
}

.project {
  display: block;
  text-align: left;
  margin-top: 10%;
  margin-left: auto;
  margin-right: auto;
  width: 60%;
}

.project h2 {
  margin-bottom: 10px;
  font-size: xx-large;
}

.hr {
  border-top: 1px solid #000000;
}

.project-header {
  display: flex;
  align-items: center;
}

.project-header h2 {
  margin-right: auto;
}

.project-button {
  padding: 5px 20px;
  background-color: transparent;
  color: #000000;
  border: 1px solid #000000;
  border-radius: 5px;
  cursor: pointer;
  font-weight: bolder;
  margin-bottom: 10px;
  transition: background 0.3s, transform 0.3s;
}

.project-button:hover {
  background-color: #f0f0f0;
}

.project-button:active {
  transform: scale(0.95);
}

.card-project_name {
  font-weight: bold;
}

.card {
  padding: 10px;
  margin-top: 20px;
  background-color: #d8d2d26c;
  border: 1px solid #ccc;
  border-radius: 5px;
  position: relative;
}

.card-content {
  display: flex;
}

.button-container {
  position: absolute;
  top: 50%;
  right: 10px;
  transform: translateY(-50%);
  display: flex;
  gap: 10px;
}

.edit-button, .remove-button {
  background: #f0f0f0;
  border: 1px solid #ccc;
  border-radius: 3px;
  padding: 5px 10px;
  color: #333;
  cursor: pointer;
  transition: background 0.3s ease, color 0.3s ease;
}

.edit-button:hover {
  background: #d0d0ff;
  color: blue;
}

.remove-button:hover {
  background: #ffd0d0;
  color: red;
}

.overlay {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0, 0, 0, 0.5);
  display: flex;
  justify-content: center;
  align-items: center;
}

.form-container {
  background-color: white;
  padding: 20px;
  border-radius: 8px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

label {
  display: block;
  margin-bottom: 5px;
}

input[type="text"], textarea {
  width: 100%;
  padding: 8px;
  margin-bottom: 10px;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
}

button[type="submit"] {
  padding: 10px 20px;
  background-color: #000000;
  color: white;
  border: none;
  border-radius: 4px;
  cursor: pointer;
  transition: background 0.3s;
}

button[type="submit"]:hover {
  background-color: #69abf1;
}

.button-54 {
  font-family: "Open Sans", sans-serif;
  font-size: 16px;
  letter-spacing: 2px;
  text-decoration: none;
  text-transform: uppercase;
  color: #000;
  cursor: pointer;
  border: 3px solid;
  padding: 0.25em 0.5em;
  box-shadow: 1px 1px 0px 0px, 2px 2px 0px 0px, 3px 3px 0px 0px, 4px 4px 0px 0px, 5px 5px 0px 0px;
  position: relative;
  user-select: none;
  -webkit-user-select: none;
  touch-action: manipulation;
}

.button-54:active {
  box-shadow: 0px 0px 0px 0px;
  top: 5px;
  left: 5px;
}

@media (min-width: 768px) {
  .button-54 {
    padding: 0.25em 0.75em;
  }
}
</style>
