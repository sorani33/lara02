@extends('layout')

@section('content')
    <div class="container mt-4">
    <span class="text-danger">{{ $score }}点</span>
    　　{{ $correctAnswerCount }} / {{ $examinationCount }}<br>
    間違った問題は下記だよ
        @foreach ($inCorrectAnswerLists as $key => $examinationQuestion)
            <div class="card mb-4">
                <div class="card-header">
                    問{{ $key+1 }}. {{ $examinationQuestion['subject'] }}
                </div>
                <div class="card-body">
                    <p class="card-text">
                        <label>
                            <input type="radio" name="no[{{ $examinationQuestion['no'] }}]" value="{{ $examinationQuestion['answer'] }}" disabled="disabled">{{ $examinationQuestion['answer'] }}
                        </label>
                        <label>
                            <input type="radio" name="no[{{ $examinationQuestion['no'] }}]" value="{{ $examinationQuestion['dummy_answer1'] }}" disabled="disabled">{{ $examinationQuestion['dummy_answer1'] }}
                        </label>
                        <label>
                            <input type="radio" name="no[{{ $examinationQuestion['no'] }}]" value="{{ $examinationQuestion['dummy_answer2'] }}" disabled="disabled">{{ $examinationQuestion['dummy_answer2'] }}
                        </label>
                        <label>
                            <input type="radio" name="no[{{ $examinationQuestion['no'] }}]" value="{{ $examinationQuestion['dummy_answer3'] }}" disabled="disabled">{{ $examinationQuestion['dummy_answer3'] }}
                        </label>
                    </p>
                    <span class="text-danger">正解は{{ $examinationQuestion['answer'] }}でした</span>
                    
                </div>
                <div class="card-footer">
                    <span class="mr-2">
                        投稿日時 {{ $examinationQuestion['created_at'] }}
                    </span>
                </div>
            </div>
        @endforeach
        <div class="mt-5">
            <button onclick="location.href='{{ route('sample')}}/{{ $genre_id }}'" type="submit" class="btn btn-primary">
                もう一度チャレンジする
            </button>
            <button onclick="location.href='{{ route('top')}}'" type="submit" class="btn btn-primary">
                TOPに戻る   
            </button>
        </div>
    </div>
@endsection