@extends('admin.layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="space-y-6">
    <!-- Page Header -->
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-bold text-gray-900">Dashboard</h1>
            <p class="text-gray-600">Welcome to your admin dashboard</p>
        </div>
        <div class="flex space-x-3">
            <button class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg flex items-center">
                <i class="fas fa-plus mr-2"></i>
                Add New
            </button>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <!-- Total Users -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-blue-100 text-blue-600">
                    <i class="fas fa-users text-xl"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">Total Users</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $stats['total_users'] }}</p>
                </div>
            </div>
            <div class="mt-4">
                <span class="text-green-600 text-sm font-medium">
                    <i class="fas fa-arrow-up mr-1"></i>
                    12%
                </span>
                <span class="text-gray-600 text-sm ml-2">from last month</span>
            </div>
        </div>

        <!-- Total Products -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-green-100 text-green-600">
                    <i class="fas fa-box text-xl"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">Total Products</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $stats['total_products'] }}</p>
                </div>
            </div>
            <div class="mt-4">
                <span class="text-green-600 text-sm font-medium">
                    <i class="fas fa-arrow-up mr-1"></i>
                    8%
                </span>
                <span class="text-gray-600 text-sm ml-2">from last month</span>
            </div>
        </div>

        <!-- Total Shipments -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-purple-100 text-purple-600">
                    <i class="fas fa-shipping-fast text-xl"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">Total Shipments</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $stats['total_shipments'] }}</p>
                </div>
            </div>
            <div class="mt-4">
                <span class="text-red-600 text-sm font-medium">
                    <i class="fas fa-arrow-down mr-1"></i>
                    3%
                </span>
                <span class="text-gray-600 text-sm ml-2">from last month</span>
            </div>
        </div>

        <!-- Revenue -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-yellow-100 text-yellow-600">
                    <i class="fas fa-dollar-sign text-xl"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">Total Revenue</p>
                    <p class="text-2xl font-bold text-gray-900">$24,500</p>
                </div>
            </div>
            <div class="mt-4">
                <span class="text-green-600 text-sm font-medium">
                    <i class="fas fa-arrow-up mr-1"></i>
                    15%
                </span>
                <span class="text-gray-600 text-sm ml-2">from last month</span>
            </div>
        </div>
    </div>

    <!-- Recent Activity -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Recent Users -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200">
            <div class="px-6 py-4 border-b border-gray-200">
                <h3 class="text-lg font-medium text-gray-900">Recent Users</h3>
            </div>
            <div class="p-6">
                @if($stats['recent_users']->count() > 0)
                    <div class="space-y-4">
                        @foreach($stats['recent_users'] as $user)
                        <div class="flex items-center space-x-3">
                            <div class="flex-shrink-0">
                                <img class="h-8 w-8 rounded-full" src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=6366f1&color=fff" alt="{{ $user->name }}">
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-sm font-medium text-gray-900 truncate">{{ $user->name }}</p>
                                <p class="text-sm text-gray-500">{{ $user->email }}</p>
                            </div>
                            <div class="flex-shrink-0">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                    Active
                                </span>
                            </div>
                        </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-gray-500 text-center py-4">No recent users</p>
                @endif
            </div>
        </div>

        <!-- Recent Products -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200">
            <div class="px-6 py-4 border-b border-gray-200">
                <h3 class="text-lg font-medium text-gray-900">Recent Products</h3>
            </div>
            <div class="p-6">
                @if($stats['recent_products']->count() > 0)
                    <div class="space-y-4">
                        @foreach($stats['recent_products'] as $product)
                        <div class="flex items-center space-x-3">
                            <div class="flex-shrink-0">
                                <div class="h-8 w-8 rounded-lg bg-gray-200 flex items-center justify-center">
                                    <i class="fas fa-box text-gray-500"></i>
                                </div>
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-sm font-medium text-gray-900 truncate">{{ $product->name }}</p>
                                <p class="text-sm text-gray-500">{{ $product->category }}</p>
                            </div>
                            <div class="flex-shrink-0">
                                <span class="text-sm font-medium text-gray-900">${{ number_format($product->price, 2) }}</span>
                            </div>
                        </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-gray-500 text-center py-4">No recent products</p>
                @endif
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
        <h3 class="text-lg font-medium text-gray-900 mb-4">Quick Actions</h3>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <a href="{{ route('admin.users') }}" class="flex items-center p-4 border border-gray-200 rounded-lg hover:bg-gray-50 transition-colors">
                <div class="p-2 rounded-lg bg-blue-100 text-blue-600 mr-3">
                    <i class="fas fa-user-plus"></i>
                </div>
                <div>
                    <p class="font-medium text-gray-900">Add New User</p>
                    <p class="text-sm text-gray-500">Create a new user account</p>
                </div>
            </a>
            
            <a href="{{ route('admin.products') }}" class="flex items-center p-4 border border-gray-200 rounded-lg hover:bg-gray-50 transition-colors">
                <div class="p-2 rounded-lg bg-green-100 text-green-600 mr-3">
                    <i class="fas fa-plus"></i>
                </div>
                <div>
                    <p class="font-medium text-gray-900">Add New Product</p>
                    <p class="text-sm text-gray-500">Create a new product listing</p>
                </div>
            </a>
            
            <a href="{{ route('admin.shipments') }}" class="flex items-center p-4 border border-gray-200 rounded-lg hover:bg-gray-50 transition-colors">
                <div class="p-2 rounded-lg bg-purple-100 text-purple-600 mr-3">
                    <i class="fas fa-truck"></i>
                </div>
                <div>
                    <p class="font-medium text-gray-900">Track Shipments</p>
                    <p class="text-sm text-gray-500">Monitor delivery status</p>
                </div>
            </a>
        </div>
    </div>
</div>
@endsection