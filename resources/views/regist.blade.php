@extends('layouts.app')

@section('title', '自動販売機管理システム')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('商品情報登録画面') }}</div>

                <div class="card-body">
                    <form action="{{ route('submit') }}" method="post">
                        @csrf
                        <div class="row mb-3">
                            <label for="txtProductName" class="col-sm-2 col-form-label">商品名<span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="txtProductName" name="product_name"
                                    value="{{ old('product_name') }}">
                                @if($errors->has('product_name'))
                                <p>{{ $errors->first('product_name') }}</p>
                                @endif
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="drpCompanyId" class="col-sm-2 col-form-label">メーカー<span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-10">
                                <select class="form-select" aria-label="Default select example" id="drpCompanyId"
                                    name="company_id">
                                    <option value="">Open this select menu</option>
                                    <option value="1" @if(old('company_id') === '1') selected @endif>One</option>
                                    <option value="2" @if(old('company_id') === '2') selected @endif>Two</option>
                                    <option value="3" @if(old('company_id') === '3') selected @endif>Three</option>
                                </select>
                                @if($errors->has('company_id'))
                                <p>{{ $errors->first('company_id') }}</p>
                                @endif
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="numPrice" class="col-sm-2 col-form-label">価格<span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-10">
                                <input type="number" class="form-control" id="numPrice" name="price"
                                    value="{{ old('price') }}">
                                @if($errors->has('price'))
                                <p>{{ $errors->first('price') }}</p>
                                @endif
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="numStock" class="col-sm-2 col-form-label">在庫数<span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-10">
                                <input type="number" class="form-control" id="numStock" name="stock"
                                    value="{{ old('stock') }}">
                                @if($errors->has('stock'))
                                <p>{{ $errors->first('stock') }}</p>
                                @endif
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="areaComment" class="col-sm-2 col-form-label">コメント</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" id="areaComment"
                                    name="comment">{{ old('comment') }}</textarea>
                                @if($errors->has('comment'))
                                <p>{{ $errors->first('comment') }}</p>
                                @endif
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="formFile" class="col-sm-2 col-form-label">商品画像</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="file" id="formImgPath" name="img_path"
                                    value="{{ old('img_path') }}">
                                @if($errors->has('img_path'))
                                <p>{{ $errors->first('img_path') }}</p>
                                @endif
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">新規登録</button>
                        <a href="{{ url('/home') }}" class="btn btn-primary">戻る</a>
                    </form>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection