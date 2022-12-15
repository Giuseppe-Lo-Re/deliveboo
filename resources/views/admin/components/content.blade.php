@extends('layouts.app')

@section('body_content')
    @include('admin.components.header')

    <div class="d-flex">
        <aside>
            <nav class="d-flex flex-column">
                <ul>
                    <li>
                        <a href="{{route('admin.home')}}">
                            <i class="mr-1 fa-solid fa-house"></i>
                            <span class="ms_aside-link-txt">Home</span>
                        </a>
                    </li>

                    <li>
                        <a href="{{route('admin.users.edit', ['user' => $user->id])}}">
                            <i class="mr-1 fa-solid fa-user"></i>
                            <span class="ms_aside-link-txt">Modifica profilo</span>
                        </a>
                    </li>

                    <li>
                        <a href="{{route('admin.products.index')}}">
                            <i class="mr-1 fa-solid fa-utensils"></i>
                            <span class="ms_aside-link-txt">Il mio Menu</span>
                        </a>
                    </li>

                    <li>
                        <a href="{{route('admin.products.create')}}">
                            <i class="mr-1 fa-solid fa-plus"></i>
                            <span class="ms_aside-link-txt">Aggiungi prodotto</span>
                        </a>
                    </li>

                    <li>
                        <a href="{{route('admin.orders')}}">
                            <i class="mr-1 fa-solid fa-bag-shopping"></i>
                            <span class="ms_aside-link-txt">I miei ordini</span>
                        </a>
                    </li>

                    <li>
                        <a href="{{route('admin.statistics')}}">
                            <i class="mr-1 fa-solid fa-chart-line"></i>
                            <span class="ms_aside-link-txt">Statistiche ordini</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </aside>
        <main class="flex-grow-1">
            @yield('main_content')
        </main>
    </div>
@endsection
