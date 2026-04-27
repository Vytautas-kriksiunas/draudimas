<x-layouts.app>
    <div class="p-6">
        <h1 class="text-2xl font-bold mb-4">{{ __('site.add_car') }}</h1>

        <form action="{{ route('cars.store') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label class="block mb-1">{{ __('site.reg_number') }}</label>
                <input type="text" name="reg_number" value="{{ old('reg_number') }}" class="border p-2 w-full rounded">
                @error('reg_number')
                <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-4">
                <label class="block mb-1">{{ __('site.brand') }}</label>
                <input type="text" name="brand" value="{{ old('brand') }}" class="border p-2 w-full rounded">
                @error('brand')
                <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-4">
                <label class="block mb-1">{{ __('site.model') }}</label>
                <input type="text" name="model" value="{{ old('model') }}" class="border p-2 w-full rounded">
                @error('model')
                <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-4">
                <label class="block mb-1">{{ __('site.owner') }}</label>
                <select name="owner_id" class="border p-2 w-full rounded">
                    @foreach($owners as $owner)
                        <option value="{{ $owner->id }}">{{ $owner->name }} {{ $owner->surname }}</option>
                    @endforeach
                </select>
                @error('owner_id')
                <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">{{ __('site.save') }}</button>
            <a href="{{ route('cars.index') }}" class="ml-2">{{ __('site.back') }}</a>
        </form>
    </div>
</x-layouts.app>
