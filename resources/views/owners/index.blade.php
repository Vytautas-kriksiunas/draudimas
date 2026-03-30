<x-layouts.app>
    <div class="p-6">
        <h1 class="text-2xl font-bold mb-4">Savininkų sąrašas</h1>

        <a href="{{ route('owners.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded">
Pridėti naują savininką
</a>

        <table class="w-full mt-4 border">
            <thead>
                <tr class="bg-gray-100">
                    <th class="p-2 border">Vardas</th>
                    <th class="p-2 border">Pavardė</th>
                    <th class="p-2 border">Telefonas</th>
                    <th class="p-2 border">El. paštas</th>
                    <th class="p-2 border">Adresas</th>
                    <th class="p-2 border">Veiksmai</th>
                </tr>
            </thead>
            <tbody>
@foreach($owners as $owner)
    <tr>
        <td class="p-2 border">{{ $owner->name }}</td>
        <td class="p-2 border">{{ $owner->surname }}</td>
        <td class="p-2 border">{{ $owner->phone }}</td>
        <td class="p-2 border">{{ $owner->email }}</td>
        <td class="p-2 border">{{ $owner->address }}</td>
        <td class="p-2 border">
            <a href="{{ route('owners.edit', $owner) }}" class="bg-yellow-500 text-white px-2 py-1 rounded">Redaguoti</a>
            <form action="{{ route('owners.destroy', $owner) }}" method="POST" style="display:inline">
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
