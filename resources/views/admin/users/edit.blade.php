@extends('admin.components.content')

@section('main_content')
    <section>
        <h1 class="text-center">Modifica profilo</h1>
        <div class="ms_form-card-body">
            <form action="{{route('admin.users.update', ['user' =>  $user->id])}}" enctype="multipart/form-data" method="post">
                @csrf
                @method('PUT')

                {{-- START INPUTS --}}
                {{-- form business_name --}}
                <div class="ms_input-hover-wrapper">
                    <label for="business_name" class="ms_js-get-label">Nome attività *</label>
                    <input id="business_name" type="text" class="@error('business_name') is-invalid @enderror ms_js-get-input" name="business_name" value="{{ old('business_name', $user->business_name) }}" autocomplete="name" required>
                    @error('business_name')
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
                    @if ($user->cover)
                        <div>
                            Foto attualmente caricata
                        </div>
                        <img class="img-thumbnail w-25" src="{{asset('storage/' . $user->cover)}}" alt="{{$user->business_name}}">
                    @endif
                </div>

                {{-- form address --}}
                <div class="ms_input-hover-wrapper">
                    <label for="address" class="ms_js-get-label">Indirizzo *</label>
                    <input id="address" type="text" class="@error('address') is-invalid @enderror  ms_js-get-input" name="address" value="{{ old('address', $user->address) }}" autocomplete="address">
                    @error('address')
                        <span class="ms_txt-danger" role="alert">
                            {{ $message }}
                        </span>
                    @enderror
                </div>

                {{-- form vat --}}
                <div class="ms_input-hover-wrapper">
                    <label for="vat" class="ms_js-get-label">Partita IVA *</label>
                    <input id="vat" type="text" class="@error('vat') is-invalid @enderror ms_js-get-input" name="vat" value="{{ old('vat', $user->vat) }}" maxlength="11" required>
                    @error('vat')
                        <span class="ms_txt-danger" role="alert">
                            {{ $message }}
                        </span>
                    @enderror
                </div>

                <div class="text-center mb-4">
                    i campi contrassegnati da uno (<span class="ms_asterisk">*</span>) sono obbligatori
                </div>

                <div class="text-center mb-4">
                    <input type="submit" class="ms_btn" value="Modifica">
                </div>
            </form>
        </div>
    </section>
@endsection