@extends('layout')

@section('content')
    <div class="container mt-4">
    <span class="text-danger">{{ $score }}点</span>
    　　{{ $correctAnswerCount }} / {{ $examinationCount }}<br>
    @if($manten)
    全問正解おめでとう！
    @endif
        @foreach ($inCorrectAnswerLists as $key => $examinationQuestion)
            <div class="card mb-4">
                <div class="card-header">
                    問. {{ $examinationQuestion['subject'] }}
                </div>
                <div class="card-body">
                @if($examinationQuestion['correctAnswer'])
                    <p class="card-text">
                    正解。あなたが答えたのは<span class="text-primary">{{ $examinationQuestion['inCorrectAnswer'] }}</span>でした。
                    </p>
                @else
                <p class="card-text">
                        残念。<span class="text-danger">{{ $examinationQuestion['inCorrectAnswer'] }}</span>ではなく
                        <span class="text-danger">正解は{{ $examinationQuestion['answer'] }}でした。</span>
                    </p>
                @endif
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