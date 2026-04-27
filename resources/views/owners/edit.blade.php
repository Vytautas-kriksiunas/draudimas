<x-layouts.app>
    <div class="p-6">
        <h1 class="text-2xl font-bold mb-4">{{ __('site.editO') }}</h1>

        <form action="{{ route('owners.update', $owner) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label class="block mb-1">{{ __('site.name') }}</label>
                <input type="text" name="name" value="{{ $owner->name }}" class="border p-2 w-full rounded">
                @error('name')
                <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-4">
                <label class="block mb-1">{{ __('site.surname') }}</label>
                <input type="text" name="surname" value="{{ $owner->surname }}" class="border p-2 w-full rounded">
                @error('surname')
                <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-4">
                <label class="block mb-1">{{ __('site.phone') }}</label>
                <input type="text" name="phone" value="{{ $owner->phone }}" class="border p-2 w-full rounded">
                @error('phone')
                <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-4">
                <label class="block mb-1">{{ __('site.email') }}</label>
                <input type="email" name="email" value="{{ $owner->email }}" class="border p-2 w-full rounded">
                @error('email')
                <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-4">
                <label class="block mb-1">{{ __('site.address') }}</label>
                <input type="text" name="address" value="{{ $owner->address }}" class="border p-2 w-full rounded">
                @error('address')
                <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>
            <button type="submit" class="bg-yellow-500 text-white px-4 py-2 rounded">{{ __('site.save') }}</button>
            <a href="{{ route('owners.index') }}" class="ml-2">{{ __('site.back') }}</a>
        </form>
    </div>
</x-layouts.app>
