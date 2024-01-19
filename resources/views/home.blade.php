@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('商品一覧') }}</div>

                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>商品画像</th>
                                <th>商品名</th>
                                <th>価格</th>
                                <th>在庫数</th>
                                <th>メーカー名</th>
                                <th>
                                    <a type="button" class="btn btn-info" href="">新規登録</a>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $product)
                            <tr>
                                <td>{{ $product->id }}</td>
                                <td><img src="{{ $product->img_path }}" alt=""></td>
                                <td>{{ $product->product_name }}</td>
                                <td>{{ $product->price }}</td>
                                <td>{{ $product->stock }}</td>
                                <td>{{ $product->company_id }}</td>
                                <td>
                                    <a type="button" class="btn btn-outline-warning" href="">詳細</a>
                                    <button type="button" class="btn btn-outline-danger">削除</button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

