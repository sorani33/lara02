@extends('layout')

@section('content')
    <div class="container mt-4">
        <form method="POST" action="/result">
        @csrf
        <input type="hidden" name="genre_id" value="{{ $genre_id }}">
        @foreach ($examinationQuestions as $key => $examinationQuestion)
            <div class="card mb-4">
                <div class="card-header">
                    問{{ $key }}. {{ $examinationQuestion['subject'] }}
                </div>
                <div class="card-body">
                    <p class="card-text">
                    @foreach ($examinationQuestion['question'] as $examinationQuestionData)
                        <label>
                            <input type="radio" name="no[{{ $key }}]" value="{{ $examinationQuestionData }}">{{ $examinationQuestionData }}
                        </label>
                    @endforeach
                    <input type="radio" name="no[{{ $key }}]" value=""checked="checked" style="display:none;" />
                    </p>
                </div>
            </div>
        @endforeach
        <div class="mt-5">
            <button type="submit" class="btn btn-primary">
                解答する
            </button>
        </div>
        </form>
    </div>
@endsection