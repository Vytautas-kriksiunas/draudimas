
<x-layouts.app>
    <div class="p-6">
        <h1 class="text-2xl font-bold mb-4">{{ __('site.Clist') }}</h1>

        <a href="{{ route('cars.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded">
            {{ __('site.add_car') }}
</a>

        <table class="w-full mt-4 border">
            <thead>
                <tr class="bg-gray-100">
                    <th style="width:300px;"></th>
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
        <td class="p-2 border" >
            @if($car->photos->count() > 0)
                <img src="{{ asset('photos/carphotos/' . $car->photos->first()->filename) }}"
                     class="cursor-pointer transition"
                     style="height:auto;"
                     onclick="openLightbox('{{ asset('photos/carphotos/' . $car->photos->first()->filename) }}')">
            @endif
        </td>
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
    <div id="lightbox" class="fixed inset-0 bg-black bg-opacity-90 z-50 hidden flex items-center justify-center p-4 animate-fade-in">
        <button onclick="closeLightbox()" class="absolute top-5 right-5 text-white text-4xl font-bold hover:text-gray-300 focus:outline-none">&times;</button>

        <img id="lightbox-img" src="" class="max-w-full max-h-[85vh] object-contain rounded shadow-2xl">
    </div>

    <script>
        function openLightbox(imageSrc) {
            document.getElementById('lightbox-img').src = imageSrc;
            document.getElementById('lightbox').classList.remove('hidden');
            document.body.style.overflow = 'hidden'; // Užrakina fono skrolinimą
        }

        function closeLightbox() {
            document.getElementById('lightbox').classList.add('hidden');
            document.body.style.overflow = 'auto'; // Atstato fono skrolinimą
        }

        // PATAISYMAS 1: Uždarome langą paspaudus bet kur ant juodo fono
        document.getElementById('lightbox').addEventListener('click', function() {
            closeLightbox();
        });

        // PATAISYMAS 2: Uždarome langą paspaudus ESC mygtuką klaviatūroje
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' || e.keyCode === 27) {
                closeLightbox();
            }
        });
    </script>
    </x-layouts.app>
