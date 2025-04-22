@extends('layouts.app')

@if(session('success'))
    <div class="alert alert-success mt-3">
        {{ session('success') }}
    </div>
@endif

@if($errors->any())
    <div class="alert alert-danger mt-3">
        {{ $errors->first('email') }}
    </div>
@endif

@section('content')
<div class="container py-5">

    {{-- Hero section --}}
    <div class="row align-items-center mb-5">
        <div class="col-md-6">
            <h1 class="display-5 fw-bold">Experts & Indicators</h1>
            <p class="lead">Découvrez le robot de trading qui booste vos résultats. Essayez-le gratuitement en mode démo, sans risque !</p>
            <div class="mt-4 d-flex gap-3">
                <a href="{{ route('catalogue') }}" class="btn btn-primary btn-lg">Voir le catalogue</a>
                @guest
                    <a href="{{ route('login') }}" class="btn btn-outline-secondary btn-lg">Se connecter</a>
                @else
                    <a href="{{ route('espace.client') }}" class="btn btn-outline-secondary btn-lg">Mon compte</a>
                @endguest
            </div>
        </div>
        <div class="col-md-6">
            <img src="{{ asset('images/experts.jpg') }}" alt="experts" class="img-fluid rounded shadow">
        </div>
    </div>

    {{-- Catégories principales --}}
    <h2 class="text-center mb-4">🔧 Nos Catégories</h2>
    <div class="row text-center mb-5">
        <div class="col-md-4 mb-3">
            <div class="card h-100 shadow-sm">
                <div class="card-body">
                    <i class="bi bi-robot display-4 text-primary mb-3"></i>
                    <h5 class="card-title">Experts</h5>
                    <p class="card-text">Gratuits, Payants, et plus.</p>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card h-100 shadow-sm">
                <div class="card-body">
                    <i class="bi bi-graph-up-arrow display-4 text-success mb-3"></i>
                    <h5 class="card-title">Indicateurs</h5>
                    <p class="card-text">Libre, Pas cher, en promotion.</p>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card h-100 shadow-sm">
                <div class="card-body">
                    <i class="bi bi-gear display-4 text-warning mb-3"></i>
                    <h5 class="card-title">Utilitaires</h5>
                    <p class="card-text">Signals, copy trading, plugins.</p>
                </div>
            </div>
        </div>
    </div>

    <h2 class="text-center mb-4 mt-10">Produits Populaires</h2>

    <div id="produitsPopulairesCarousel" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
            @foreach ($populaires->chunk(4) as $chunkIndex => $chunk)
                <div class="carousel-item {{ $chunkIndex == 0 ? 'active' : '' }}">
                    <div class="container">
                    <div class="row justify-content-center">
                        @foreach ($chunk as $produit)
                            <div class="col-md-3">
                                <div class="card h-100 mb-3 shadow-sm">
                                    <img src="{{ asset('images/produits/' . $produit->image) }}" class="card-img-top object-fit-cover" style="height: 200px;" alt="{{ $produit->nom }}">
                                    <div class="card-body text-center justify-content-end">
                                        <h5 class="card-title">{{ $produit->nom }}</h5>
                                        <p class="">{{ $produit->description}}</p>     
                                    </div>
                                    <div class="card-footer d-flex justify-content-between align-items-center gap-2">
                                        <p class="text-success fw-bold mb-0">{{ number_format($produit->prix, 0) }}$</p>
                                        <a href="{{ route('produits.show', $produit->id) }}" class="btn btn-outline-info btn-sm" style="height:32px;">Voir</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                </div>
            @endforeach

        </div>
    </div>

    {{-- Newsletter / contact --}}
    <div class="bg-light p-5 mt-5 rounded shadow-sm">
        <h3 class="mb-3">📬 Abonnez-vous à notre newsletter</h3>
        <p>Recevez les nouveautés et promotions directement dans votre boîte mail.</p>
        <form action="{{ route('newsletter.subscribe') }}" method="POST" class="row g-3 mt-3">
            @csrf
            <div class="col-md-8">
                <input type="email" name="email" class="form-control" placeholder="Votre adresse e-mail" required>
            </div>
            <div class="col-md-4">
                <button class="btn btn-success w-100">S’abonner</button>
            </div>
        </form>
    </div>

</div>
@endsection
