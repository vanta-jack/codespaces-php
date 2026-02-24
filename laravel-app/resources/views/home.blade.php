@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Welcome to Our Restaurant</div>

                <div class="card-body">
                    <p>Experience the finest dining with our exquisite menu and exceptional service.</p>
                    <a href="#menu" class="btn btn-primary">Explore Our Menu</a>

                    <div class="menu-grid mt-4">
                        <div class="menu-item">
                            <h3>Grilled Salmon</h3>
                            <p>Fresh salmon grilled to perfection, served with seasonal vegetables.</p>
                        </div>
                        <div class="menu-item">
                            <h3>Steak Frites</h3>
                            <p>Juicy steak served with crispy fries and a side of garlic butter.</p>
                        </div>
                        <div class="menu-item">
                            <h3>Vegetarian Pasta</h3>
                            <p>A delightful mix of fresh vegetables and pasta in a light tomato sauce.</p>
                        </div>
                    </div>

                    <a href="#team" class="btn btn-secondary mt-4">Meet Our Dev Team</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
