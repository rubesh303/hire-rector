<template>
    <div class="modal-overlay" @click="$emit('close')">
        <div class="modal-content" @click.stop>
            <p>
                You are about to visit {{ url }}.
                Do you want to continue?
            </p>
            <div class="modal-buttons">
                <button @click="visit">Continue</button>
                <button @click="$emit('close')">Cancel</button>
            </div>
        </div>
    </div>
</template>

<script setup>
const props = defineProps(['url'])

const visit = () => {
    window.open(props.url, '_blank')
}
</script>

<style scoped>
.modal-overlay {
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

.modal-content {
    background: white;
    padding: 20px;
    border-radius: 8px;
    max-width: 400px;
    text-align: center;
}

.modal-buttons {
    margin-top: 20px;
}

.modal-buttons button {
    margin: 0 10px;
    padding: 10px 20px;
}
</style>