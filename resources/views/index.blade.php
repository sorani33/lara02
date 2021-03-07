@extends('layout')

@section('content')
    <div class="container mt-4">
        <form method="POST" action="/result">
        @csrf
        <input type="hidden" name="genre_id" value="{{ $genre_id }}">
        @foreach ($examinationQuestions as $key => $examinationQuestion)
            <div class="card mb-4">
                <div class="card-header">
                    問{{ $key+1 }}. {{ $examinationQuestion->subject }}
                </div>
                <div class="card-body">
                    <p class="card-text">

                        <label>
                            <input type="radio" name="no[{{ $examinationQuestion->no }}]" value="{{ $examinationQuestion->answer }}">{{ $examinationQuestion->answer }}
                        </label>
                        <label>
                            <input type="radio" name="no[{{ $examinationQuestion->no }}]" value="{{ $examinationQuestion->dummy_answer1 }}">{{ $examinationQuestion->dummy_answer1 }}
                        </label>
                        <label>
                            <input type="radio" name="no[{{ $examinationQuestion->no }}]" value="{{ $examinationQuestion->dummy_answer2 }}">{{ $examinationQuestion->dummy_answer2 }}
                        </label>
                        <label>
                            <input type="radio" name="no[{{ $examinationQuestion->no }}]" value="{{ $examinationQuestion->dummy_answer3 }}">{{ $examinationQuestion->dummy_answer3 }}
                        </label>
                    </p>
                </div>
                <div class="card-footer">
                    <span class="mr-2">
                        投稿日時 {{ $examinationQuestion->created_at->format('Y.m.d') }}
                    </span>
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