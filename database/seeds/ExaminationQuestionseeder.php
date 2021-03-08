<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class ExaminationQuestionseeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('examination_questions')->insert([
            ['no' => '1','genre_id' => '1','subject' => '猫はどれですか','answer' => 'ねこ','dummy_answer1' => 'ぽち','dummy_answer2' => 'さる','dummy_answer3' => 'きじ','created_at' => Carbon::now(),'updated_at' => Carbon::now()],
            ['no' => '2','genre_id' => '1','subject' => '犬はどれですか','answer' => 'ぽち','dummy_answer1' => 'ねこ','dummy_answer2' => 'さる','dummy_answer3' => 'きじ','created_at' => Carbon::now(),'updated_at' => Carbon::now()],
            ['no' => '3','genre_id' => '1','subject' => 'あれはどれですか','answer' => 'あれ','dummy_answer1' => 'これ','dummy_answer2' => 'それ','dummy_answer3' => 'どれ','created_at' => Carbon::now(),'updated_at' => Carbon::now()],
            ['no' => '4','genre_id' => '1','subject' => '愛はどれですか','answer' => 'あい','dummy_answer1' => 'まい','dummy_answer2' => 'みー','dummy_answer3' => 'むー','created_at' => Carbon::now(),'updated_at' => Carbon::now()],
            ['no' => '5','genre_id' => '2','subject' => '"古代マケドニアにて、世界中に領土を広げようとした 術の天才と呼ばれる、特攻隊長のような人はだれですか"','answer' => 'アレクサンドロス大王','dummy_answer1' => 'カエサル','dummy_answer2' => 'ハンニバル','dummy_answer3' => 'ジャンヌ・ダルク','created_at' => Carbon::now(),'updated_at' => Carbon::now()],
            ['no' => '6','genre_id' => '2','subject' => 'マケドニアが滅びる原因にもなった、アレクサンドロス大王の死に際に残した言葉はなんですか','answer' => '後継者は最強のやつ','dummy_answer1' => '賽（さい）は投げられた','dummy_answer2' => '勇気のあるところに希望あり','dummy_answer3' => '羊が何匹いるかは狼には関係なし','created_at' => Carbon::now(),'updated_at' => Carbon::now()],
            ['no' => '7','genre_id' => '2','subject' => '滅びたマケドニアに変わって勢力を伸ばした国はどこですか','answer' => '共和政ローマ','dummy_answer1' => '帝政ローマ','dummy_answer2' => 'ビザンツ帝国','dummy_answer3' => 'フランク王国','created_at' => Carbon::now(),'updated_at' => Carbon::now()],
            ['no' => '8','genre_id' => '2','subject' => '象に乗って、ローマを逆サイドから攻めたのは、だれですか','answer' => 'ハンニバル','dummy_answer1' => 'カエサル','dummy_answer2' => 'アレクサンドロス大王','dummy_answer3' => 'ジャンヌ・ダルク','created_at' => Carbon::now(),'updated_at' => Carbon::now()],
            ['no' => '9','genre_id' => '2','subject' => '帝政ローマの礎を築いた、ハゲてて、女遊びのする借金王だったのは、だれですか','answer' => 'カエサル','dummy_answer1' => 'アレクサンドロス大王','dummy_answer2' => 'ハンニバル','dummy_answer3' => 'ジャンヌ・ダルク','created_at' => Carbon::now(),'updated_at' => Carbon::now()],
            ['no' => '10','genre_id' => '2','subject' => '帝政ローマが二分されたうちの東側の国は、その後何という国になりますか','answer' => 'ビザンツ帝国','dummy_answer1' => '共和政ローマ','dummy_answer2' => '帝政ローマ','dummy_answer3' => 'フランク王国','created_at' => Carbon::now(),'updated_at' => Carbon::now()],
            ['no' => '11','genre_id' => '2','subject' => '帝政ローマが二分されたうちの西側の国は、その後すぐに滅んでしまいますが、その時に攻めてきたゲルマン人によって作られた国は、なんですか','answer' => 'フランク王国','dummy_answer1' => 'ビザンツ帝国','dummy_answer2' => '共和政ローマ','dummy_answer3' => '帝政ローマ','created_at' => Carbon::now(),'updated_at' => Carbon::now()],
            ['no' => '12','genre_id' => '2','subject' => 'フランク王国も更に東西に分かれますが、それぞれなんという国になりますか','answer' => '西...イギリスとフランス 東…神聖ローマとイタリア','dummy_answer1' => 'あっち','dummy_answer2' => 'こっち','dummy_answer3' => 'どっち','created_at' => Carbon::now(),'updated_at' => Carbon::now()],
            ['no' => '13','genre_id' => '2','subject' => 'イギリスとフランスとの戦いで、フランスを勝利に導いた女性の軍人はだれですか','answer' => 'ジャンヌ・ダルク','dummy_answer1' => 'アレクサンドロス大王','dummy_answer2' => 'カエサル','dummy_answer3' => 'ハンニバル','created_at' => Carbon::now(),'updated_at' => Carbon::now()],
            ['no' => '14','genre_id' => '2','subject' => 'ローマでベースとなった言語と宗教はなんですか','answer' => 'ラテン語とキリスト教','dummy_answer1' => 'あれ','dummy_answer2' => 'これ','dummy_answer3' => 'それ','created_at' => Carbon::now(),'updated_at' => Carbon::now()],
        ]);
    }
}
