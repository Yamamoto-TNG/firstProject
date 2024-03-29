@extends('layouts.app')

@section('title', '自動販売機管理システム')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('商品情報一覧画面') }}</div>
                <div class="card-body">
                    <!-- 検索フォームのセクション -->
                    <div class="search mt-2">
                        <!-- 検索フォーム。GETメソッドで、商品一覧のルートにデータを送信 -->
                        <form action="{{ route('home') }}" method="GET" class="row g-3" onsubmit="return false;">
                            <!-- 商品名検索用の入力欄 -->
                            <div class="col-sm-5">
                                <input type="text" name="keyword" class="form-control js-search-keyword" placeholder="商品名"
                                    value="{{ request('keyword') }}">
                            </div>
                            <!-- メーカー名検索用の選択欄 -->
                            <div class="col-sm-5">
                                <select class="form-select js-search-company-id" aria-label="Default select example" id="drpCompanyId"
                                    name="company_id">
                                    <option value="">Open this select menu</option>
                                    @foreach ($companies as $company)
                                    <option value="{{ $company->id }}" @if((int)request('company_id')===$company->id)
                                        selected @endif>{{ $company->company_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <!-- 価格の下限上限 -->
                            <div class="col-sm-5">
                                <input type="number" name="lower_price" class="form-control js-search-lower-price" id="lowerPrice" placeholder="価格下限"
                                value="{{ request('lower_price') }}">
                            </div>
                            <div class="col-sm-5">
                                <input type="number" name="upper_price" class="form-control js-search-upper-price" id="upperPrice" placeholder="価格上限"
                                value="{{ request('upper_price') }}">
                            </div>
                            <!-- 在庫の下限上限 -->
                            <div class="col-sm-5">
                                <input type="number" name="lower_stock" class="form-control  js-search-lower-stock" id="lowerStock" placeholder="在庫数下限"
                                value="{{ request('lower_stock') }}">
                            </div>
                            <div class="col-sm-5">
                                <input type="number" name="upper_stock" class="form-control  js-search-upper-stock" id="upperStock" placeholder="在庫数上限"
                                value="{{ request('upper_stock') }}">
                            </div>
                            <!-- 絞り込みボタン -->
                            <div class="col-sm-2 d-grid">
                                <button class="btn btn-outline-secondary js-search-btn" type="button">絞り込み</button>
                            </div>
                        </form>
                    </div>
                    <table class="table js-search-tablesort">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>商品画像</th>
                                <th>商品名</th>
                                <th>価格</th>
                                <th>在庫数</th>
                                <th>メーカー名</th>
                                <th><a type="button" class="btn btn-info js-btn-new" href="{{ route('regist') }}">新規登録</a></th>
                            </tr>
                        </thead>
                        <tbody class="js-tbody">
                            @foreach ($products as $product)
                                <tr>
                                    <td>{{ $product->id }}</td>
                                    <td><img src="{{ asset($product->img_path) }}" alt="{{ $product->product_name }}"
                                            width="100" height="100" class="img-thumbnail"></td>
                                    <td>{{ $product->product_name }}</td>
                                    <td>{{ $product->price }}</td>
                                    <td>{{ $product->stock }}</td>
                                    <td>{{ $product->company->company_name }}</td>
                                    <td>
                                        <div class="d-flex">
                                            <a class="btn btn-outline-warning btn-sm"
                                                href="{{ route('detail', ['id'=>$product->id]) }}">詳細</a>
                                            <button type="button" class="ms-2 btn btn-outline-danger btn-sm js-delete-btn" data-product-id="{{ $product->id }}" data-product-name="{{ $product->product_name }}">削除</button>
                                        </div>
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