@extends('admin.components.content')

@section('main_content')
    <section>
        <h1 class="text-center">Modifica prodotto</h1>
        <div class="ms_form-card-body">
            <form action="{{route('admin.products.update', ['product' =>  $product->id])}}" enctype="multipart/form-data" method="post">
                @csrf
                @method('PUT')

                {{-- START INPUTS --}}
                {{-- form name --}}
                <div class="ms_input-hover-wrapper">
                    <label for="name" class="ms_js-get-label">Nome *</label>
                    <input id="name" type="text" class="@error('name') is-invalid @enderror ms_js-get-input" name="name" value="{{ old('name', $product->name) }}" autocomplete="name">
                    @error('name')
                        <span class="ms_txt-danger" role="alert">
                            {{ $message }}
                        </span>
                    @enderror
                </div>

                {{-- form cover --}}
                <div>
                    <label for="cover" class="ms_visible-label">Foto</label>
                    <input id="cover" type="file" class="@error('cover') is-invalid @enderror" name="cover"> 
                    @error('cover')
                        <span class="ms_txt-danger" role="alert">
                            {{ $message }}
                        </span>
                    @enderror
                    @if ($product->cover)
                        <div>
                            Foto attualmente caricata
                        </div>
                        <img class="img-thumbnail w-25" src="{{asset('storage/' . $product->cover)}}" alt="{{$product->name}}">
                    @endif
                </div>

                {{-- form description --}}
                <div class="ms_input-hover-wrapper">
                    <label for="description" class="ms_js-get-label">Descrizione</label>
                    <textarea id="description" class="@error('description') is-invalid @enderror  ms_js-get-input" rows="3" name="description">{{ old('description', $product->description) }}</textarea>
                    @error('description')
                        <span class="ms_txt-danger" role="alert">
                            {{ $message }}
                        </span>
                    @enderror
                </div>

               {{-- form ingredients --}}
               <div class="ms_input-hover-wrapper">
                    <label for="ingredients" class="ms_js-get-label">Ingredienti</label>
                    <textarea class="@error('ingredients') is-invalid @enderror  ms_js-get-input" id="ingredients" rows="2" name="ingredients">{{ old('ingredients', $product->ingredients) }}</textarea>
                    @error('ingredients')
                        <span class="ms_txt-danger" role="alert">
                            {{ $message }}
                        </span>
                    @enderror
                </div>

                {{-- form cooking_time --}}
                <div class="ms_input-hover-wrapper">
                    <label for="cooking_time" class="ms_js-get-label">Tempo di cottura (minuti)</label>
                    <input id="cooking_time" type="number" class="@error('cooking_time') is-invalid @enderror ms_js-get-input" name="cooking_time" value="{{ old('cooking_time', $product->cooking_time) }}" min="0" max="99">
                    @error('cooking_time')
                        <span class="ms_txt-danger" role="alert">
                            {{ $message }}
                        </span>
                    @enderror
                </div>

                {{-- form price --}}
                <div class="ms_input-hover-wrapper">
                    <label for="price" class="ms_js-get-label">Prezzo * (€)</label>
                    <input id="price" type="number" class="@error('price') is-invalid @enderror ms_js-get-input" name="price" value="{{ old('price', $product->price) }}" min="0.00" max="999.99" step="0.01" required>
                    @error('price')
                        <span class="ms_txt-danger" role="alert">
                            {{ $message }}
                        </span>
                    @enderror
                </div>
                
                {{-- form visible --}}
                @if (old('visible'))
                    <div class="custom-control custom-switch mt-3 mb-3">
                        <input class="custom-control-input" type="checkbox" id="visible" name="visible" {{ old('visible') ? 'checked' : '' }}>
                        <label class="custom-control-label form-check-label" for="visible">Disponibilità</label>
                    </div>
                @else
                    <div class="custom-control custom-switch mt-3 mb-3">
                        <input class="custom-control-input" type="checkbox" id="visible" name="visible" {{ $product->visible ? "checked" : "" }}>
                        <label class="custom-control-label form-check-label" for="visible">Disponibilità</label>
                    </div>
                @endif
                {{-- END INPUTS --}}

                <div class="text-center mb-4">
                    i campi contrassegnati da uno (<span class="ms_asterisk">*</span>) sono obbligatori
                </div>

                <div class="text-center mb-4">
                    <input type="submit" class="ms_btn" value="Aggiorna">
                </div>
            </form>
        </div>
    </section>
@endsection