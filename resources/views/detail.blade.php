@extends('layouts.app')

@section('title', '商品情報詳細画面')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('商品情報詳細画面') }}</div>

                <div class="card-body">
                    <div class="row mb-3">
                        <label for="formFile" class="col-sm-2 col-form-label">商品画像</label>
                        <div class="col-sm-10">
                            <p class="form-control-plaintext"><img  src="{{ $product->img_path }}" class="img-thumbnail"></p>
                        </div>
                    </div>
                        <div class="row mb-3">
                            <label for="txtProductName" class="col-sm-2 col-form-label">商品名</label>
                            <div class="col-sm-10">
                                <p class="form-control-plaintext">{{ $product->product_name }}</p>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="drpCompanyId" class="col-sm-2 col-form-label">メーカー</label>
                            <div class="col-sm-10">
                                <p class="form-control-plaintext">{{ $product->company->company_name }}</p>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="numPrice" class="col-sm-2 col-form-label">価格</label>
                            <div class="col-sm-10">
                                <p class="form-control-plaintext">¥{{ $product->price }}</p>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="numStock" class="col-sm-2 col-form-label">在庫数</label>
                            <div class="col-sm-10">
                                <p class="form-control-plaintext">{{ $product->stock }}</p>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="areaComment" class="col-sm-2 col-form-label">コメント</label>
                            <div class="col-sm-10">
                                <p class="form-control-plaintext">{{ $product->comment }}</p>
                            </div>
                        </div>
                        <a href="{{ route('edit', ['id'=>$product->id]) }}" class="btn btn-primary">編集</a>
                        <a href="{{ url('/home') }}" class="btn btn-primary">戻る</a>
                    </form>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection