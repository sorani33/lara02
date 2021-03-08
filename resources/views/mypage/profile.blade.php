@extends('layout')

@section('content')
    
    <div class="container mt-4">
        <div class="card mb-4">
            <div class="card-header">
            ここはプロフィールの編集
            </div>
            <div class="card-body">
                <p class="card-text">

        <form method="POST" action="{{route('mypage.editname.save')}}">
        @csrf


        <!--Eメール-->
        <div class="form-group row">
            <label for="inputEmail" class="col-sm-2 col-form-label">名前</label>
            <div class="col-sm-10">
            <input type="text" class="form-control" name='user_name' value="{{ $user->name }}" placeholder="タイトル">
                <div class="invalid-feedback">入力してください</div>
            </div>
        </div>
        <!--/Eメール-->

        <!--クラス名-->
        <div class="form-group row mb-5">
            <label for="inputPassword" class="col-sm-2 col-form-label">クラス名</label>
            <div class="col-sm-10">
                <select class="form-control" name="class_name">
                    <option value="1">ラグナリオ</option>
                    <option value="2">アリスカーナ</option>
                    <option value="3">ウォルクス</option>
                    <option value="4">フラーシア</option>
                    <option value="5">未所属</option>
                    <option value="6">非公開</option>
                </select>
                <div class="invalid-feedback">入力してください</div>
                <small id="passwordHelpBlock" class="form-text text-muted">クラス名は、</small>
            </div>
        </div>

        <div class="mt-5">
            <button type="submit" class="btn btn-primary">
                保存する
            </button>
        </div>
        </form>


                </p>
            </div>
        </div>
    </div>
@endsection