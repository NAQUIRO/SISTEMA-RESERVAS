@extends('layouts.app')

@section('content')
<div id="app">
    <div class="max-w-7xl mx-auto">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-bold text-gray-800">Reserva tu Mesa</h2>
                <div class="flex space-x-4">
                    <input type="date" v-model="selectedDate" class="rounded border-gray-300" @change="checkAvailability">
                    <input type="time" v-model="selectedTime" class="rounded border-gray-300" @change="checkAvailability">
                </div>
            </div>

            <div v-if="availableTables.length > 0" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <div v-for="table in availableTables" :key="table.id" class="border rounded-lg p-4 hover:shadow-lg transition">
                    <div class="flex justify-between items-start">
                        <div>
                            <h3 class="text-lg font-semibold">Mesa #@{{ table.number }}</h3>
                            <p class="text-gray-600">Capacidad: @{{ table.capacity }} personas</p>
                            <p class="text-gray-600">Ubicación: @{{ table.location }}</p>
                        </div>
                        <button @click="selectTable(table)" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">
                            Reservar
                        </button>
                    </div>
                </div>
            </div>
            <div v-else class="text-center py-8">
                <p class="text-gray-600">No hay mesas disponibles para la fecha y hora seleccionada</p>
            </div>
        </div>
    </div>

    <!-- Modal de Reserva -->
    <div v-if="showReservationModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center">
        <div class="bg-white p-6 rounded-lg max-w-md w-full">
            <h3 class="text-xl font-bold mb-4">Hacer Reserva</h3>
            <form @submit.prevent="makeReservation">
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Nombre</label>
                        <input type="text" v-model="reservationForm.customer_name" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Email</label>
                        <input type="email" v-model="reservationForm.customer_email" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Teléfono</label>
                        <input type="tel" v-model="reservationForm.customer_phone" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Número de Personas</label>
                        <input type="number" v-model="reservationForm.number_of_guests" required min="1" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Peticiones Especiales</label>
                        <textarea v-model="reservationForm.special_requests" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"></textarea>
                    </div>
                </div>
                <div class="mt-6 flex justify-end space-x-3">
                    <button type="button" @click="showReservationModal = false" class="px-4 py-2 border rounded-md hover:bg-gray-50">
                        Cancelar
                    </button>
                    <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600">
                        Confirmar Reserva
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
const { createApp } = Vue

createApp({
    data() {
        return {
            selectedDate: '',
            selectedTime: '',
            availableTables: [],
            showReservationModal: false,
            selectedTable: null,
            reservationForm: {
                customer_name: '',
                customer_email: '',
                customer_phone: '',
                number_of_guests: 1,
                special_requests: ''
            }
        }
    },
    mounted() {
        // Establecer la fecha de hoy como valor predeterminado
        const today = new Date()
        this.selectedDate = today.toISOString().split('T')[0]
        this.selectedTime = '19:00'
        this.checkAvailability()
    },
    methods: {
        async checkAvailability() {
            if (!this.selectedDate || !this.selectedTime) return
            
            try {
                const response = await axios.get(`/api/tables/available/${this.selectedDate}/${this.selectedTime}`)
                this.availableTables = response.data
            } catch (error) {
                console.error('Error al obtener mesas disponibles:', error)
            }
        },
        selectTable(table) {
            this.selectedTable = table
            this.showReservationModal = true
        },
        async makeReservation() {
            if (!this.selectedTable) return

            const reservationData = {
                ...this.reservationForm,
                table_id: this.selectedTable.id,
                reservation_date: `${this.selectedDate} ${this.selectedTime}`
            }

            try {
                const response = await axios.post('/api/reservations', reservationData)
                alert('¡Reserva confirmada!')
                this.showReservationModal = false
                this.checkAvailability()
                this.resetForm()
            } catch (error) {
                alert('Error al hacer la reserva. Por favor, inténtelo de nuevo.')
                console.error('Error al hacer la reserva:', error)
            }
        },
        resetForm() {
            this.reservationForm = {
                customer_name: '',
                customer_email: '',
                customer_phone: '',
                number_of_guests: 1,
                special_requests: ''
            }
            this.selectedTable = null
        }
    }
}).mount('#app')
</script>
@endpush