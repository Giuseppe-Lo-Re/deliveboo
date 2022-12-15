@extends('admin.components.content')

@section('main_content')
    <section>
        <h1 class="text-center">Ordini</h1>
        <div class="text-center mb-4">
            <a class="ms_btn" href="{{route('admin.statistics')}}">Visualizza statistiche</a>
        </div>

        <div class="ms_paginator-links mb-4">
            {{ $user_orders->links() }}
        </div>
        
        @if (isset($user_orders) && count($user_orders) > 0)
            <div>
                @foreach ($user_orders as $order)
                    <div class="d-flex ms_order-row mb-4">
                        <div class="ms_user-orders-info">
                            <div>
                                <span>Numero ordine:</span>
                                {{$order->order_number}}
                            </div>
                            <div>
                                <span>Totale:</span>
                                {{$order->total_amount}} €
                            </div>
                            <div>
                                <span>Data:</span>
                                {{$order->new_date}}
                            </div>
                        </div>
                        <div>
                            {{-- eliminazione prodotto con richiesta di conferma --}}
                            <a href="{{'#myModal-' . $order->id}}" class="ms_btn ms_btn-primary mb-0" data-toggle="modal">Maggiori informazioni</a>

                            <div id="{{'myModal-' . $order->id}}" class="modal fade">
                                <div class="modal-dialog modal-confirm">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5>Informazioni Ordine</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                        </div>
                                        <div class="modal-body text-left">
                                            <div class="ms_more-info">
                                                <div class="ms_single-order-info mb-3">
                                                    <div>
                                                        <span>Numero ordine:</span>
                                                        {{$order->order_number}}
                                                    </div>
                                                    <div>
                                                        <span>Totale:</span>
                                                        {{$order->total_amount}} €
                                                    </div>
                                                    <div>
                                                        <span>Data:</span>
                                                        {{$order->new_date}}
                                                    </div>
                                                </div>
                                                
                                                <div class="ms_customer-info mb-3">
                                                    <h5>Informazioni cliente</h5>
                                                    <div>
                                                        <span>Nome:</span>
                                                        {{$order->customer_name}}
                                                    </div>
                                                    <div>
                                                        <span>Indirizzo:</span>
                                                        {{$order->customer_address}}
                                                    </div>
                                                    <div>
                                                        <span>Email:</span>
                                                        {{$order->customer_mail}}
                                                    </div>
                                                    <div>
                                                        <span>Numero di telefono:</span>
                                                        {{$order->customer_phone_number}}
                                                    </div>
                                                </div>

                                                <div class="ms_customer-products mb-3">
                                                    <h5>Prodotti ordinati</h5>
                                                    <ul>
                                                        @foreach ($order->products as $order_product)
                                                            <li>
                                                                <span>
                                                                    {{$order_product->name}}
                                                                </span> - pz:
                                                                <span>
                                                                    {{$order_product->pivot['quantity']}}
                                                                </span>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

                <div class="ms_paginator-links">
                    {{ $user_orders->links() }}
                </div>
            </div>
        @else
            <h2 class="text-center">Nessun ordine presente</h2>
        @endif
    </section> 
@endsection