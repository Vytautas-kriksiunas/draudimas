<x-layouts.app>
    <div class="p-6">
        <h1 class="text-2xl font-bold mb-4">Redaguoti automobilį</h1>

        <form action="{{ route('cars.update', $car) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label class="block mb-1">Reg. numeris</label>
                <input type="text" name="reg_number" value="{{ $car->reg_number }}" class="border p-2 w-full rounded">
                @error('reg_number')
                <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-4">
                <label class="block mb-1">Markė</label>
                <input type="text" name="brand" value="{{ $car->brand }}" class="border p-2 w-full rounded">
                @error('brand')
                <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-4">
                <label class="block mb-1">Modelis</label>
                <input type="text" name="model" value="{{ $car->model }}" class="border p-2 w-full rounded">
                @error('model')
                <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-4">
                <label class="block mb-1">Savininkas</label>
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
            <button type="submit" class="bg-yellow-500 text-white px-4 py-2 rounded">Atnaujinti</button>
            <a href="{{ route('cars.index') }}" class="ml-2">Atgal</a>
        </form>
    </div>
</x-layouts.app>
