@extends('layout')

@section('content')
    ここは称号一覧
    <div class="container mt-4">
        <div class="card mb-4">
            <div class="card-header">
                個人成績　（さん）
            </div>
            <div class="card-body">
                <p class="card-text">
                    <span class="text-danger">【称号】 創立メンバー</span>
                </p>
                <div class="row">
                @foreach($examinationQuestionsDatatitles as $examinationQuestionsDatatitle)
                    <div class="col-sm-2"><button type="button" class="btn btn-outline-primary">{{ $examinationQuestionsDatatitle->name }}</button></div>
                @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection