<x-layouts.app>
    <div class="p-6">
        <h1 class="text-2xl font-bold mb-4">{{ __('site.Olist') }}</h1>

        <a href="{{ route('owners.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded">
            {{__('site.add_owner')}}</a>

        <table class="w-full mt-4 border">
            <thead>
                <tr class="bg-gray-100">
                    <th class="p-2 border">{{__('site.name')}}</th>
                    <th class="p-2 border">{{__('site.surname')}}</th>
                    <th class="p-2 border">{{__('site.phone')}}</th>
                    <th class="p-2 border">{{__('site.email')}}</th>
                    <th class="p-2 border">{{__('site.address')}}</th>
                    <th class="p-2 border">{{__('site.actions')}}</th>
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
            <a href="{{ route('owners.edit', $owner) }}" class="bg-yellow-500 text-white px-2 py-1 rounded">{{ __('site.update') }}</a>
            <form action="{{ route('owners.destroy', $owner) }}" method="POST" style="display:inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="bg-red-500 text-white px-2 py-1 rounded" >{{ __('site.delete') }}</button>
            </form>
        </td>
    </tr>
    @endforeach
    </tbody>
    </table>
    </div>
    </x-layouts.app>
