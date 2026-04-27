
<x-layouts.app>
    <div class="p-6">
        <h1 class="text-2xl font-bold mb-4">{{ __('site.Clist') }}</h1>

        <a href="{{ route('cars.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded">
            {{ __('site.add_car') }}
</a>

        <table class="w-full mt-4 border">
            <thead>
                <tr class="bg-gray-100">
                    <th class="p-2 border">{{ __('site.reg_number') }}</th>
                    <th class="p-2 border">{{ __('site.brand') }}</th>
                    <th class="p-2 border">{{ __('site.model') }}</th>
                    <th class="p-2 border">{{ __('site.owner') }}</th>
                    <th class="p-2 border">{{ __('site.actions') }}</th>
                </tr>
            </thead>
            <tbody>
@foreach($cars as $car)
    <tr>
        <td class="p-2 border">{{ $car->reg_number }}</td>
        <td class="p-2 border">{{ $car->brand }}</td>
        <td class="p-2 border">{{ $car->model }}</td>
        <td class="p-2 border">{{ $car->owner->name }} {{ $car->owner->surname }}</td>
        <td class="p-2 border">
            <a href="{{ route('cars.edit', $car) }}" class="bg-yellow-500 text-white px-2 py-1 rounded">Redaguoti</a>
            <form action="{{ route('cars.destroy', $car) }}" method="POST" style="display:inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="bg-red-500 text-white px-2 py-1 rounded">Ištrinti</button>
            </form>
        </td>
    </tr>
    @endforeach
    </tbody>
    </table>
    </div>
    </x-layouts.app>
