@extends('admin.components.content')

@section('main_content')
    <section>
        <h1 class="text-center">Menu</h1>
        @if (isset($product_deleted_confirm))
            @if ($product_deleted_confirm === 'y')
            <div class="alert alert-success text-center" role="alert">
                prodotto eliminato con successo
            </div>
            @else
            <div class="alert alert-danger text-center" role="alert">
                Si è verificato un errore durante la cancellazione del prodotto
            </div>
            @endif
        @endif
        
        <div class="text-center mb-5">
            <a class="ms_btn" href="{{route('admin.products.create')}}">Aggiungi nuovo prodotto</a>
        </div>

        @if (isset($products) && count($products) > 0)
            <div class="ms_product-card-wrapper">
                @foreach ($products as $product)
                    {{-- card singola --}}
                    <div class="ms_product-card text-center">
                        <h5 class="card-title">{{$product->name}}</h5>
                        <div class="card-text mb-2">{{str_replace('.', ',', $product->price) . '€'}}</div>
                        <div class="{{$product->visible === 0 ? 'ms_not-available' : 'ms_available'}} text-center">{{$product->visible == 0 ? 'Prodotto non disponibile' : 'Prodotto disponibile'}}</div>
                        <form action="{{route('admin.products.destroy', ['product' => $product->id])}}" method="POST">
                            @csrf
                            @method('DELETE')

                            <a href="{{route('admin.products.show', ['product' => $product->id])}}" class="ms_btn ms_btn-tertiary">Mostra prodotto</a>
                            <a href="{{route('admin.products.edit', ['product' => $product->id])}}" class="ms_btn ms_btn-secondary">Modifica prodotto</a>
                            
                            {{-- eliminazione prodotto con richiesta di conferma --}}
                            <a href="#myModal" class="ms_btn" data-toggle="modal">Elimina prodotto</a>

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
                                            <p class="ms_modal-delete-txt">L'eliminazione del prodotto è <span class="ms_txt-danger">irreversibile</span></p>
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
                @endforeach
            </div>
        @else
            <h2 class="text-center">Che cosa aspetti<span class="ms_txt-warning">?</span> Aggiungi un nuovo prodotto al tuo Menu<span class="ms_txt-danger">!</span></h2>
        @endif
    </section>
@endsection