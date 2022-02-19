<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Customers') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="grid grid-cols-5 gap-4">
                        <div><b>Name</b></div>
                        <div><b>Phone Number</b></div>
                        <div><b>Email</b></div>
                        <div align='right'><b>Budget</b></div>  
                        <div><b>Actions</b></div>
                    
                        @forelse ($customers as $customer)
                        <div><a style="color:blue;" href="{{ route('customers.show', ['customer' => $customer->id]) }}" >{{ $customer->name }}</a></div>
                        <div>{{ $customer->phone_number }}</div>
                        <div>{{ $customer->email }}</div>
                        <div align='right'>USD {{ number_format($customer->budget,2) }}</div>  
                        <div>
                            <a style="color:blue;" href="">{{ __('Create Wordpress Account') }}</a>
                        </div>
                        @empty
                        <p>{{ __('No customers yet!') }}</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>