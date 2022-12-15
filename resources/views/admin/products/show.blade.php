@extends('admin.components.content')

@section('main_content')
    <section>
        @if (isset($product_created_confirm) && $product_created_confirm === 'y')
            <div class="alert alert-success text-center" role="alert">
                prodotto creato con successo!
            </div>
        @endif
        @if (isset($product_updated_confirm) && $product_updated_confirm === 'y')
            <div class="alert alert-success text-center" role="alert">
                prodotto modificato con successo!
            </div>
        @endif

        <div class="ms_product-details d-flex">
            <div class="ms_product-details-left">
                <div class="ms_product-details-left-img">
                    
                    @if ($product->cover)

                        {{-- immagine --}}
                        <img src="{{asset('storage/' . $product->cover)}}" alt="{{$product->name}}">
                    @else

                        {{-- immagine placeholder --}}
                        <img class="ms_placeholder-img" src="https://i.ibb.co/JvkF0TR/tostino-no-image.jpg" alt="{{$product->name}}">
                    @endif
                </div>

                {{-- disponibilità --}}
                <div class="{{$product->visible === 0 ? 'ms_not-available' : 'ms_available'}} text-center">{{$product->visible == 0 ? 'Prodotto non disponibile' : 'Prodotto disponibile'}}</div>
            </div>
            <div class="ms_product-details-info">
                {{-- nome --}}
                <h2>{{$product->name}}</h2>

                {{-- ingredienti --}}
                @if ($product->ingredients)
                    <div>
                        <h6>Ingredienti: </h6>
                        <p>{{$product->ingredients}}</p>
                    </div>
                @endif

                {{-- descrizione --}}
                @if ($product->description)
                    <div>
                        <h6>Descrizione: </h6>
                        <p>{{$product->description}}</p>
                    </div>
                @endif

                {{-- tempo di cottura --}}
                @if ($product->cooking_time)
                    <div>
                        <h6>Tempo di cottura:</h6> 
                        <div>{{$product->cooking_time}} minuti</div>
                    </div>
                @endif

                {{-- prezzo --}}
                <div>
                    <h6>Prezzo:</h6> 
                    <div>{{str_replace('.', ',', $product->price)}} €</div>
                </div>
                
                {{-- bottoni modifica ed elimina --}}
                <form action="{{route('admin.products.destroy', ['product' => $product->id])}}" method="POST">
                    @csrf
                    @method('DELETE')

                    <a href="{{route('admin.products.edit', ['product' => $product->id])}}" class="ms_btn ms_btn-secondary">Modifica prodotto</a>
                    
                    {{-- eliminazione prodotto con richiesta di conferma --}}
                    <a href="#myModal" class="ms_btn ms_btn-primary" data-toggle="modal">Elimina prodotto</a>

                    <div id="myModal" class="modal fade">
                        <div class="modal-dialog modal-confirm">
                            <div class="modal-content">
                                <div class="modal-header flex-column">
                                    <div class="icon-box d-flex justify-content-center align-items-center mb-3">
                                        <i class="fa-solid fa-exclamation"></i>
                                    </div>		
                                    <h4 class="modal-title mb-3">Sei sicurə?</h4>	
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                </div>
                                <div class="modal-body">
                                    <p class="pb-2">L'eliminazione del prodotto è <span class="ms_txt-danger">irreversibile</span></p>
                                </div>
                                <div class="modal-footer justify-content-center">
                                    <button type="button" class="ms_btn ms_btn-secondary" data-dismiss="modal">Annulla</button>
                                    <input class="ms_btn" type="submit" value="Conferma">
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection