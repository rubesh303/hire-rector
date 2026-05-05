<template>
    <ul v-if="websites.length" class="website-list">
        <li v-for="site in websites" :key="site.id" class="website-item">
            <a href="#" @click.prevent="confirmVisit(site.url)" class="website-link">
                {{ site.url }}
            </a>
        </li>
    </ul>

    <ConfirmModal
        v-if="showModal"
        :url="selectedUrl"
        @close="showModal=false"
    />
</template>

<script setup>
import { ref } from 'vue'
import ConfirmModal from './ConfirmModal.vue'

defineProps(['websites'])

const showModal = ref(false)
const selectedUrl = ref('')

const confirmVisit = (url) => {
    selectedUrl.value = url
    showModal.value = true
}
</script>

<style scoped>
.website-list {
    list-style: none;
    padding: 0;
}

.website-item {
    margin-bottom: 10px;
}

.website-link {
    color: blue;
    text-decoration: none;
}

.website-link:hover {
    text-decoration: underline;
}
</style>