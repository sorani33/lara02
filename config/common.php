<?php

return [
    # 問題数
    'examination_question' => [
        'count'    => [
            'label' => '問題数',
            'value' => 3,
        ],
    ],
    # 成績表のランキング表示数
    'examination_ranking_result' => [
        'count'    => [
            'label' => 'ランキングの表示数',
            'value' => 3,
        ],
    ],

    # タイムアタック時間の先頭からの文字数除去数
    'time_attack' => [
        'top'    => [
            'label' => 'タイムアタック時間の先頭からの文字数除去数',
            'value' => 6,
        ],
    ],

    # 解答分類
    'correct_answer' => [
        'correct'    => [
            'label' => '正解',
            'value' => 1,
        ],
        'unanswered'    => [
            'label' => '未回答',
            'value' => 2,
        ],
        'incorrect'    => [
            'label' => '不正解',
            'value' => 3,
        ],
    ],
    # ゲームモード
    'gamemode' => [
        'practice'    => [
            'label' => '練習問題',
            'value' => 1,
        ],
        'time_attack'    => [
            'label' => 'タイムアタック',
            'value' => 2,
        ],
    ],
    # ベストタイムフラグ
    'examination_result' => [
        'best_time_flag' => [
            'off'    => [
                'label' => 'ベストタイムでない',
                'value' => 0,
            ],
            'on'    => [
                'label' => 'ベストタイムである',
                'value' => 1,
            ],
        ],
    ],

    # 成績表のランキング表示数
    'genre_id' => [
        'total_score'    => [
            'label' => '総合スコア',
            'value' => 900,
        ],
        'month_score'    => [
            'label' => '月間スコア',
            'value' => 950,
        ],
    ],

    # お気に入り
    'favorite' => [
        'on'    => [
            'label' => 'お気に入りである',
            'value' => 1,
        ],
        'off'    => [
            'label' => 'お気に入りでない',
            'value' => 0,
        ],
    ],

    # クラスネーム
    'class_name' => [
        '1'    => [
            'label' => 'ラグナリオ',
            'short_label' => 'R',
        ],
        '2'    => [
            'label' => 'ウォルクス',
            'short_label' => 'W',
        ],
        '3'    => [
            'label' => 'アリスカーナ',
            'short_label' => 'A',
        ],
        '4'    => [
            'label' => 'フラーシア',
            'short_label' => 'F',
        ],
        '5'    => [
            'label' => '無所属',
            'short_label' => '無',
        ],
    ],

];