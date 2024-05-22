@extends('layouts.app')

@section('content')
{{-- 商品一覧を表示 --}}
<div class="row">
    <div class="col-9">
        <div class="container mt-4">
            <div class="row w-100">
                @foreach($products as $product)
                <div class="col-3">
                    <a href="{{route('products.show', $product)}}">
                        <img src="{{ asset('img/dummy.png')}}" class="img-thumbnail">
                        {{-- {{ asset('img/dummy.png')}}はpublicディレクトリ内にある画像やCSSなどを読み取ったり、表示するための関数 --}}
                    </a>
                    <div class="row">
                        <div class="col-12">
                            <p class="samuraimart-product-label mt-2">
                                {{$product->name}}<br>
                                <label>￥{{$product->price}}</label>
                            </p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
