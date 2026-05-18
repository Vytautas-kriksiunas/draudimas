<x-layouts.app>
    <div class="p-6">
        <h1 class="text-2xl font-bold mb-4">{{ __('site.editC') }}</h1>

        <form enctype="multipart/form-data" action="{{ route('cars.update', $car) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label class="block mb-1">{{ __('site.reg_number') }}</label>
                <input type="text" name="reg_number" value="{{ $car->reg_number }}" class="border p-2 w-full rounded">
                @error('reg_number')
                <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label class="block mb-1">{{ __('site.brand') }}</label>
                <input type="text" name="brand" value="{{ $car->brand }}" class="border p-2 w-full rounded">
                @error('brand')
                <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label class="block mb-1">{{ __('site.model') }}</label>
                <input type="text" name="model" value="{{ $car->model }}" class="border p-2 w-full rounded">
                @error('model')
                <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label class="block mb-1">{{ __('site.owner') }}</label>
                <select name="owner_id" class="border p-2 w-full rounded">
                    @foreach($owners as $owner)
                        <option value="{{ $owner->id }}" {{ $car->owner_id == $owner->id ? 'selected' : '' }}>
                            {{ $owner->name }} {{ $owner->surname }}
                        </option>
                    @endforeach
                </select>
                @error('owner_id')
                <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label class="block mb-1">{{ __('site.photos') }}</label>
                <input type="file" name="photos[]" multiple class="border p-2 w-full rounded">
            </div>

            @if($car->photos->count() > 0)
                <div class="flex gap-2 flex-wrap mt-4 mb-4">
                    @foreach($car->photos as $photo)
                        <div class="text-center">
                            <img src="{{ asset('photos/carphotos/' . $photo->filename) }}" class="h-40 w-auto object-contain rounded">                            <a href="{{ route('photos.destroy', $photo->id) }}"
                               class="bg-red-500 text-white px-2 py-1 rounded text-sm block mt-1">
                                {{ __('site.delete') }}
                            </a>
                        </div>
                    @endforeach
                </div>
            @endif

            <hr class="mb-4">
            <button type="submit" class="bg-yellow-500 text-white px-4 py-2 rounded">{{ __('site.save') }}</button>
            <a href="{{ route('cars.index') }}" class="ml-2">{{ __('site.back') }}</a>
        </form>
    </div>
</x-layouts.app>
