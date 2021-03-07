@extends('layout')

@section('content')
    ここはマイページ
    <div class="container mt-4">
        <div class="card mb-4">
            <div class="card-header">
                個人成績
            </div>
            <div class="card-body">
                <p class="card-text">
                    <span class="text-danger">総合スコア {{ $totalScore }}点</span>
                </p>
                <p class="card-text">
                    <span class="text-danger">月間スコア {{ $totalScore }}点</span>
                </p>
                <p class="card-text">
                    <span class="text-danger">偏差値　50.2（ベタ書き）</span>
                </p>
            </div>
            <div class="card-footer">
                <span class="mr-2">
                </span>
            </div>
            </div>

        @foreach ($examinationResultDatas as $key => $examinationQuestion)
            <div class="card mb-4">

                <div class="card-header">
                    解答日時 {{ $examinationQuestion['created_at'] }}

                </div>
                <div class="card-body">
                    <p class="card-text">
                    点数 {{ $examinationQuestion['mark'] }}
                    </p>
                    <p class="card-text">
                    投稿日時 {{ $examinationQuestion['created_at'] }}
                    </p>
                    <p class="card-text">
                    投稿日時 {{ $examinationQuestion['created_at'] }}
                    </p>
                    
                </div>
                <div class="card-footer">
                    <span class="mr-2">
                    </span>
                </div>
            </div>
        @endforeach
        <div class="mt-5">
        </div>
    </div>
@endsection