<template>
    <div class="container">
        <h1>Website Uptime Monitor</h1>
        <select v-model="selected" @change="loadWebsites" class="select">
            <option value="">Select Client</option>
            <option
                v-for="client in clients"
                :key="client.id"
                :value="client.id"
            >
                {{ client.email }}
            </option>
        </select>

        <WebsiteList :websites="websites"/>
    </div>
</template>

<script setup>
import axios from 'axios'
import { ref, onMounted } from 'vue'
import WebsiteList from './WebsiteList.vue'

const clients = ref([])
const websites = ref([])
const selected = ref('')

onMounted(async () => {
    let response = await axios.get('/api/clients')
    clients.value = response.data
})

const loadWebsites = async () => {
    let response = await axios.get(`/api/clients/${selected.value}/websites`)
    websites.value = response.data.websites
}
</script>

<style scoped>
.container {
    max-width: 800px;
    margin: 0 auto;
    padding: 20px;
}

.select {
    width: 100%;
    padding: 10px;
    margin-bottom: 20px;
}
</style>