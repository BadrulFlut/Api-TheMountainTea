@extends('admin.layouts.app')

@section('title', 'Shipments Management')

@section('content')
<div class="space-y-6">
    <!-- Page Header -->
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-bold text-gray-900">Shipments Management</h1>
            <p class="text-gray-600">Track and manage delivery shipments</p>
        </div>
        <button onclick="openCreateModal()" class="bg-purple-600 hover:bg-purple-700 text-white px-4 py-2 rounded-lg flex items-center">
            <i class="fas fa-plus mr-2"></i>
            Add New Shipment
        </button>
    </div>

    <!-- Search and Filters -->
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
        <div class="flex flex-col md:flex-row gap-4">
            <div class="flex-1">
                <label for="search" class="block text-sm font-medium text-gray-700 mb-2">Search Shipments</label>
                <input type="text" id="search" placeholder="Search by tracking number, customer name, or destination..." 
                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500">
            </div>
            <div class="md:w-48">
                <label for="status" class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                <select id="status" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500">
                    <option value="">All Status</option>
                    <option value="pending">Pending</option>
                    <option value="in_transit">In Transit</option>
                    <option value="delivered">Delivered</option>
                    <option value="failed">Failed</option>
                </select>
            </div>
            <div class="md:w-48">
                <label for="priority" class="block text-sm font-medium text-gray-700 mb-2">Priority</label>
                <select id="priority" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500">
                    <option value="">All Priorities</option>
                    <option value="low">Low</option>
                    <option value="medium">Medium</option>
                    <option value="high">High</option>
                    <option value="urgent">Urgent</option>
                </select>
            </div>
        </div>
    </div>

    <!-- Shipments Table -->
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200">
            <h3 class="text-lg font-medium text-gray-900">Shipments List</h3>
        </div>
        
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tracking</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Customer</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Destination</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Priority</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Created</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($shipments as $shipment)
                    <tr id="shipment-row-{{ $shipment->id }}">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 h-10 w-10">
                                    <div class="h-10 w-10 rounded-lg bg-purple-100 flex items-center justify-center">
                                        <i class="fas fa-truck text-purple-600"></i>
                                    </div>
                                </div>
                                <div class="ml-4">
                                    <div class="text-sm font-medium text-gray-900">#{{ $shipment->id }}</div>
                                    <div class="text-sm text-gray-500">Tracking</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">{{ $shipment->customer_name ?? 'N/A' }}</div>
                            <div class="text-sm text-gray-500">{{ $shipment->customer_email ?? 'N/A' }}</div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="text-sm text-gray-900 max-w-xs truncate">
                                {{ $shipment->destination ?? 'N/A' }}
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @php
                                $statusColors = [
                                    'pending' => 'bg-yellow-100 text-yellow-800',
                                    'in_transit' => 'bg-blue-100 text-blue-800',
                                    'delivered' => 'bg-green-100 text-green-800',
                                    'failed' => 'bg-red-100 text-red-800'
                                ];
                                $statusColor = $statusColors[$shipment->status ?? 'pending'] ?? 'bg-gray-100 text-gray-800';
                            @endphp
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $statusColor }}">
                                {{ ucwords(str_replace('_', ' ', $shipment->status ?? 'pending')) }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @php
                                $priorityColors = [
                                    'low' => 'bg-gray-100 text-gray-800',
                                    'medium' => 'bg-blue-100 text-blue-800',
                                    'high' => 'bg-orange-100 text-orange-800',
                                    'urgent' => 'bg-red-100 text-red-800'
                                ];
                                $priorityColor = $priorityColors[$shipment->priority ?? 'medium'] ?? 'bg-gray-100 text-gray-800';
                            @endphp
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $priorityColor }}">
                                {{ ucfirst($shipment->priority ?? 'medium') }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ $shipment->created_at->format('M d, Y') }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <button onclick="openEditModal({{ $shipment->id }}, '{{ $shipment->customer_name ?? '' }}', '{{ $shipment->customer_email ?? '' }}', '{{ $shipment->destination ?? '' }}', '{{ $shipment->status ?? 'pending' }}', '{{ $shipment->priority ?? 'medium' }}')" 
                                    class="text-blue-600 hover:text-blue-900 mr-3">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button onclick="deleteShipment({{ $shipment->id }})" 
                                    class="text-red-600 hover:text-red-900">
                                <i class="fas fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="px-6 py-4 text-center text-gray-500">
                            No shipments found
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <!-- Pagination -->
        @if($shipments->hasPages())
        <div class="px-6 py-4 border-t border-gray-200">
            {{ $shipments->links() }}
        </div>
        @endif
    </div>
</div>

<!-- Create Shipment Modal -->
<div id="createModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
    <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
        <div class="mt-3">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-medium text-gray-900">Create New Shipment</h3>
                <button onclick="closeCreateModal()" class="text-gray-400 hover:text-gray-600">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            
            <form id="createShipmentForm">
                <div class="mb-4">
                    <label for="customer_name" class="block text-sm font-medium text-gray-700 mb-2">Customer Name</label>
                    <input type="text" id="customer_name" name="customer_name" required 
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500">
                </div>
                
                <div class="mb-4">
                    <label for="customer_email" class="block text-sm font-medium text-gray-700 mb-2">Customer Email</label>
                    <input type="email" id="customer_email" name="customer_email" required 
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500">
                </div>
                
                <div class="mb-4">
                    <label for="destination" class="block text-sm font-medium text-gray-700 mb-2">Destination</label>
                    <textarea id="destination" name="destination" rows="2" required 
                              class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500"></textarea>
                </div>
                
                <div class="mb-4">
                    <label for="status" class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                    <select id="status" name="status" required 
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500">
                        <option value="pending">Pending</option>
                        <option value="in_transit">In Transit</option>
                        <option value="delivered">Delivered</option>
                        <option value="failed">Failed</option>
                    </select>
                </div>
                
                <div class="mb-6">
                    <label for="priority" class="block text-sm font-medium text-gray-700 mb-2">Priority</label>
                    <select id="priority" name="priority" required 
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500">
                        <option value="low">Low</option>
                        <option value="medium" selected>Medium</option>
                        <option value="high">High</option>
                        <option value="urgent">Urgent</option>
                    </select>
                </div>
                
                <div class="flex justify-end space-x-3">
                    <button type="button" onclick="closeCreateModal()" 
                            class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50">
                        Cancel
                    </button>
                    <button type="submit" 
                            class="px-4 py-2 bg-purple-600 text-white rounded-lg hover:bg-purple-700">
                        Create Shipment
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Shipment Modal -->
<div id="editModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
    <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
        <div class="mt-3">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-medium text-gray-900">Edit Shipment</h3>
                <button onclick="closeEditModal()" class="text-gray-400 hover:text-gray-600">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            
            <form id="editShipmentForm">
                <input type="hidden" id="edit_shipment_id" name="shipment_id">
                
                <div class="mb-4">
                    <label for="edit_customer_name" class="block text-sm font-medium text-gray-700 mb-2">Customer Name</label>
                    <input type="text" id="edit_customer_name" name="customer_name" required 
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500">
                </div>
                
                <div class="mb-4">
                    <label for="edit_customer_email" class="block text-sm font-medium text-gray-700 mb-2">Customer Email</label>
                    <input type="email" id="edit_customer_email" name="customer_email" required 
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500">
                </div>
                
                <div class="mb-4">
                    <label for="edit_destination" class="block text-sm font-medium text-gray-700 mb-2">Destination</label>
                    <textarea id="edit_destination" name="destination" rows="2" required 
                              class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500"></textarea>
                </div>
                
                <div class="mb-4">
                    <label for="edit_status" class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                    <select id="edit_status" name="status" required 
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500">
                        <option value="pending">Pending</option>
                        <option value="in_transit">In Transit</option>
                        <option value="delivered">Delivered</option>
                        <option value="failed">Failed</option>
                    </select>
                </div>
                
                <div class="mb-6">
                    <label for="edit_priority" class="block text-sm font-medium text-gray-700 mb-2">Priority</label>
                    <select id="edit_priority" name="priority" required 
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500">
                        <option value="low">Low</option>
                        <option value="medium">Medium</option>
                        <option value="high">High</option>
                        <option value="urgent">Urgent</option>
                    </select>
                </div>
                
                <div class="flex justify-end space-x-3">
                    <button type="button" onclick="closeEditModal()" 
                            class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50">
                        Cancel
                    </button>
                    <button type="submit" 
                            class="px-4 py-2 bg-purple-600 text-white rounded-lg hover:bg-purple-700">
                        Update Shipment
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
// Modal functions
function openCreateModal() {
    document.getElementById('createModal').classList.remove('hidden');
}

function closeCreateModal() {
    document.getElementById('createModal').classList.add('hidden');
    document.getElementById('createShipmentForm').reset();
}

function openEditModal(id, customerName, customerEmail, destination, status, priority) {
    document.getElementById('edit_shipment_id').value = id;
    document.getElementById('edit_customer_name').value = customerName;
    document.getElementById('edit_customer_email').value = customerEmail;
    document.getElementById('edit_destination').value = destination;
    document.getElementById('edit_status').value = status;
    document.getElementById('edit_priority').value = priority;
    document.getElementById('editModal').classList.remove('hidden');
}

function closeEditModal() {
    document.getElementById('editModal').classList.add('hidden');
    document.getElementById('editShipmentForm').reset();
}

// Form submissions
document.getElementById('createShipmentForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const formData = new FormData(this);
    
    // For now, we'll just show a success message since we don't have the backend endpoint
    Swal.fire('Success!', 'Shipment created successfully', 'success');
    closeCreateModal();
    location.reload();
});

document.getElementById('editShipmentForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const formData = new FormData(this);
    const shipmentId = document.getElementById('edit_shipment_id').value;
    
    // For now, we'll just show a success message since we don't have the backend endpoint
    Swal.fire('Success!', 'Shipment updated successfully', 'success');
    closeEditModal();
    location.reload();
});

function deleteShipment(id) {
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
            // For now, we'll just show a success message since we don't have the backend endpoint
            Swal.fire('Deleted!', 'Shipment deleted successfully', 'success');
            document.getElementById(`shipment-row-${id}`).remove();
        }
    });
}

// Search and filter functionality
document.getElementById('search').addEventListener('input', function(e) {
    const searchTerm = e.target.value.toLowerCase();
    const rows = document.querySelectorAll('tbody tr');
    
    rows.forEach(row => {
        const tracking = row.querySelector('td:first-child').textContent.toLowerCase();
        const customer = row.querySelector('td:nth-child(2)').textContent.toLowerCase();
        const destination = row.querySelector('td:nth-child(3)').textContent.toLowerCase();
        
        if (tracking.includes(searchTerm) || customer.includes(searchTerm) || destination.includes(searchTerm)) {
            row.style.display = '';
        } else {
            row.style.display = 'none';
        }
    });
});

document.getElementById('status').addEventListener('change', function(e) {
    const selectedStatus = e.target.value.toLowerCase();
    const rows = document.querySelectorAll('tbody tr');
    
    rows.forEach(row => {
        const status = row.querySelector('td:nth-child(4)').textContent.toLowerCase();
        
        if (!selectedStatus || status.includes(selectedStatus)) {
            row.style.display = '';
        } else {
            row.style.display = 'none';
        }
    });
});

document.getElementById('priority').addEventListener('change', function(e) {
    const selectedPriority = e.target.value.toLowerCase();
    const rows = document.querySelectorAll('tbody tr');
    
    rows.forEach(row => {
        const priority = row.querySelector('td:nth-child(5)').textContent.toLowerCase();
        
        if (!selectedPriority || priority.includes(selectedPriority)) {
            row.style.display = '';
        } else {
            row.style.display = 'none';
        }
    });
});
</script>
@endpush