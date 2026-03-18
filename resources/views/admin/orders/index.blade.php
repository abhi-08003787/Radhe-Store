@extends('layouts.app')

@section('title', 'Admin - Orders List')

@section('content')
<div class="bg-gray-50 min-h-screen py-12">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        
        <div class="mb-10 flex items-center justify-between">
            <div>
                <h1 class="serif text-4xl text-[#2b0505]">Order Management</h1>
                <p class="text-sm text-gray-500 mt-2">Monitor and manage all customer orders</p>
            </div>
            <div class="bg-white px-6 py-3 rounded-2xl shadow-sm border border-gray-100">
                <span class="text-[10px] font-bold tracking-widest uppercase text-gray-400 block mb-1">Total Orders</span>
                <span class="text-2xl font-bold text-[#D4AF37]">{{ $orders->total() }}</span>
            </div>
        </div>

        @if(session('success'))
            <div class="mb-8 bg-green-50 border border-green-200 text-green-700 px-6 py-4 rounded-2xl flex items-center gap-3 shadow-sm animate-pulse">
                <i class="bi bi-check-circle-fill"></i>
                <span class="text-sm font-medium">{{ session('success') }}</span>
            </div>
        @endif

        <div class="bg-white rounded-[2rem] shadow-xl shadow-black/[0.02] border border-gray-100 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead>
                        <tr class="bg-gray-50/50 border-b border-gray-100">
                            <th class="px-8 py-6 text-[10px] font-bold tracking-[0.2em] uppercase text-gray-400">Order ID</th>
                            <th class="px-8 py-6 text-[10px] font-bold tracking-[0.2em] uppercase text-gray-400">Customer</th>
                            <th class="px-8 py-6 text-[10px] font-bold tracking-[0.2em] uppercase text-gray-400 text-center">Amount</th>
                            <th class="px-8 py-6 text-[10px] font-bold tracking-[0.2em] uppercase text-gray-400 text-center">Status</th>
                            <th class="px-8 py-6 text-[10px] font-bold tracking-[0.2em] uppercase text-gray-400">Date</th>
                            <th class="px-8 py-6 text-[10px] font-bold tracking-[0.2em] uppercase text-gray-400 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">
                        @foreach($orders as $order)
                            @php
                                $address = json_decode($order->shipping_address, true);
                                $customerName = ($address['first_name'] ?? '') . ' ' . ($address['last_name'] ?? '');
                            @endphp
                            <tr class="hover:bg-gray-50/50 transition-colors group">
                                <td class="px-8 py-6">
                                    <span class="text-xs font-bold text-[#2b0505]">#ORD-{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}</span>
                                </td>
                                <td class="px-8 py-6">
                                    <div class="flex flex-col">
                                        <span class="text-sm font-bold text-[#2b0505]">{{ $customerName }}</span>
                                        <span class="text-[10px] text-gray-400 tracking-wider">{{ $address['email'] ?? 'No Email' }}</span>
                                    </div>
                                </td>
                                <td class="px-8 py-6 text-center">
                                    <span class="text-sm font-bold text-[#D4AF37]">₹{{ number_format($order->total_amount, 0) }}</span>
                                </td>
                                <td class="px-8 py-6">
                                    <div class="flex justify-center">
                                        @php
                                            $statusClasses = [
                                                'pending' => 'bg-amber-50 text-amber-600 border-amber-100',
                                                'processing' => 'bg-blue-50 text-blue-600 border-blue-100',
                                                'shipped' => 'bg-indigo-50 text-indigo-600 border-indigo-100',
                                                'delivered' => 'bg-green-50 text-green-600 border-green-100',
                                                'canceled' => 'bg-red-50 text-red-600 border-red-100',
                                            ];
                                            $currentClass = $statusClasses[$order->status] ?? 'bg-gray-50 text-gray-600 border-gray-100';
                                        @endphp
                                        <span class="px-3 py-1 rounded-full text-[9px] font-bold tracking-widest uppercase border {{ $currentClass }}">
                                            {{ $order->status }}
                                        </span>
                                    </div>
                                </td>
                                <td class="px-8 py-6">
                                    <span class="text-xs text-gray-500">{{ $order->created_at->format('M d, Y') }}</span>
                                </td>
                                <td class="px-8 py-6 text-right">
                                    <form action="{{ route('admin.orders.updateStatus', $order) }}" method="POST" class="inline-flex items-center gap-2">
                                        @csrf
                                        @method('PATCH')
                                        <select name="status" onchange="this.form.submit()" class="text-[10px] font-bold tracking-widest uppercase border-gray-200 rounded-lg focus:ring-[#D4AF37] focus:border-[#D4AF37] py-1 px-2 pr-8 bg-white transition-all hover:border-[#D4AF37]">
                                            @foreach(['pending', 'processing', 'shipped', 'delivered', 'canceled'] as $status)
                                                <option value="{{ $status }}" {{ $order->status == $status ? 'selected' : '' }}>
                                                    {{ ucfirst($status) }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            @if($orders->hasPages())
                <div class="px-8 py-6 bg-gray-50/50 border-t border-gray-100">
                    {{ $orders->links() }}
                </div>
            @endif
        </div>

        @if($orders->isEmpty())
            <div class="mt-12 text-center py-20 bg-white rounded-[2rem] border border-dashed border-gray-200">
                <div class="w-20 h-20 bg-gray-50 rounded-full flex items-center justify-center mx-auto mb-6">
                    <i class="bi bi-inbox text-3xl text-gray-300"></i>
                </div>
                <h3 class="serif text-2xl text-gray-400">No orders found</h3>
                <p class="text-sm text-gray-400 mt-2">When customers place orders, they will appear here.</p>
            </div>
        @endif

    </div>
</div>

<style>
    /* Pagination Styling */
    .pagination { @apply flex items-center gap-2; }
    .page-item { @apply rounded-xl overflow-hidden; }
    .page-link { @apply px-4 py-2 bg-white border border-gray-100 text-xs font-bold text-gray-500 hover:bg-[#D4AF37] hover:text-white transition-all; }
    .page-item.active .page-link { @apply bg-[#D4AF37] text-white border-[#D4AF37]; }
</style>
@endsection
