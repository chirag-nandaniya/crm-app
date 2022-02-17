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
                    <!-- Name -->
                    <div>
                        <x-label for="name" :value="__('Name')" />
                        {{ $customer->name }}
                    </div>

                    <!-- Phone Number -->
                    <div class="mt-4">
                        <x-label for="phone_number" :value="__('Phone Number')" />
                        {{ $customer->phone_number }}
                    </div>

                    <!-- Email Address -->
                    <div class="mt-4">
                        <x-label for="email" :value="__('Email')" />
                        {{ $customer->email }}
                    </div>

                    <!-- Desired Budget -->
                    <div class="mt-4">
                        <x-label for="budget" :value="__('Desired Budget')" />
                        {{ $customer->budget }}
                    </div>

                    <!-- Message -->
                    <div class="mt-4">
                        <x-label for="message" :value="__('Message')" />
                        {{ $customer->message }}
                    </div>
                    
                    <div class="flex items-center justify-end mt-4">
                        <x-button class="ml-4">
                            <a href="{{ route('customers.index') }}">{{ __('Back') }}</a>
                        </x-button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
