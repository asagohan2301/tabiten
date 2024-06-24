<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AreaCountryCitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('areas')->insert([
            ['area_name' => '東アジア', 'order' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['area_name' => '東南・南アジア', 'order' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['area_name' => 'ヨーロッパ', 'order' => 3, 'created_at' => now(), 'updated_at' => now()],
            ['area_name' => '北アメリカ', 'order' => 4, 'created_at' => now(), 'updated_at' => now()],
            ['area_name' => '太平洋・オセアニア', 'order' => 5, 'created_at' => now(), 'updated_at' => now()],
            ['area_name' => '中央・南アメリカ', 'order' => 6, 'created_at' => now(), 'updated_at' => now()],
            ['area_name' => '中央・西アジア', 'order' => 7, 'created_at' => now(), 'updated_at' => now()],
            ['area_name' => 'アフリカ', 'order' => 8, 'created_at' => now(), 'updated_at' => now()],
        ]);

        DB::table('countries')->insert([
            // 東アジア
            ['country_name' => '日本', 'reading' => 'にほん', 'area_id' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['country_name' => '韓国', 'reading' => 'かんこく', 'area_id' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['country_name' => '中国', 'reading' => 'ちゅうごく', 'area_id' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['country_name' => '台湾', 'reading' => 'たいわん', 'area_id' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['country_name' => '香港', 'reading' => 'ほんこん', 'area_id' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['country_name' => 'モンゴル', 'reading' => 'もんごる', 'area_id' => 1, 'created_at' => now(), 'updated_at' => now()],

            // 東南・南アジア
            ['country_name' => 'インド', 'reading' => 'いんど', 'area_id' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['country_name' => 'インドネシア', 'reading' => 'いんどねしあ', 'area_id' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['country_name' => 'マレーシア', 'reading' => 'まれーしあ', 'area_id' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['country_name' => 'フィリピン', 'reading' => 'ふぃりぴん', 'area_id' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['country_name' => 'シンガポール', 'reading' => 'しんがぽーる', 'area_id' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['country_name' => 'タイ', 'reading' => 'たい', 'area_id' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['country_name' => 'ベトナム', 'reading' => 'べとなむ', 'area_id' => 2, 'created_at' => now(), 'updated_at' => now()],

            // ヨーロッパ
            ['country_name' => 'イギリス', 'reading' => 'いぎりす', 'area_id' => 3, 'created_at' => now(), 'updated_at' => now()],
            ['country_name' => 'フランス', 'reading' => 'ふらんす', 'area_id' => 3, 'created_at' => now(), 'updated_at' => now()],
            ['country_name' => 'ドイツ', 'reading' => 'どいつ', 'area_id' => 3, 'created_at' => now(), 'updated_at' => now()],
            ['country_name' => 'イタリア', 'reading' => 'いたりあ', 'area_id' => 3, 'created_at' => now(), 'updated_at' => now()],
            ['country_name' => 'スペイン', 'reading' => 'すぺいん', 'area_id' => 3, 'created_at' => now(), 'updated_at' => now()],
            ['country_name' => 'ロシア', 'reading' => 'ろしあ', 'area_id' => 3, 'created_at' => now(), 'updated_at' => now()],
            ['country_name' => 'オランダ', 'reading' => 'おらんだ', 'area_id' => 3, 'created_at' => now(), 'updated_at' => now()],
            ['country_name' => 'スイス', 'reading' => 'すいす', 'area_id' => 3, 'created_at' => now(), 'updated_at' => now()],

            // 北アメリカ
            ['country_name' => 'アメリカ', 'reading' => 'あめりか', 'area_id' => 4, 'created_at' => now(), 'updated_at' => now()],
            ['country_name' => 'カナダ', 'reading' => 'かなだ', 'area_id' => 4, 'created_at' => now(), 'updated_at' => now()],

            // 太平洋・オセアニア
            ['country_name' => 'オーストラリア', 'reading' => 'おーすとらりあ', 'area_id' => 5, 'created_at' => now(), 'updated_at' => now()],
            ['country_name' => 'ニュージーランド', 'reading' => 'にゅーじーらんど', 'area_id' => 5, 'created_at' => now(), 'updated_at' => now()],

            // 中央・南アメリカ
            ['country_name' => 'ブラジル', 'reading' => 'ぶらじる', 'area_id' => 6, 'created_at' => now(), 'updated_at' => now()],
            ['country_name' => 'アルゼンチン', 'reading' => 'あるぜんちん', 'area_id' => 6, 'created_at' => now(), 'updated_at' => now()],

            // 中央・西アジア
            ['country_name' => 'トルコ', 'reading' => 'とるこ', 'area_id' => 7, 'created_at' => now(), 'updated_at' => now()],
            ['country_name' => 'イラン', 'reading' => 'いらん', 'area_id' => 7, 'created_at' => now(), 'updated_at' => now()],

            // アフリカ
            ['country_name' => 'エジプト', 'reading' => 'えじぷと', 'area_id' => 8, 'created_at' => now(), 'updated_at' => now()],
            ['country_name' => '南アフリカ', 'reading' => 'みなみあふりか', 'area_id' => 8, 'created_at' => now(), 'updated_at' => now()],
        ]);

        DB::table('cities')->insert([
            // 日本
            ['city_name' => '東京', 'reading' => 'とうきょう', 'country_id' => 1, 'latitude' => null, 'longitude' => null, 'created_at' => now(), 'updated_at' => now()],
            ['city_name' => '大阪', 'reading' => 'おおさか', 'country_id' => 1, 'latitude' => null, 'longitude' => null, 'created_at' => now(), 'updated_at' => now()],
            ['city_name' => '札幌', 'reading' => 'さっぽろ', 'country_id' => 1, 'latitude' => null, 'longitude' => null, 'created_at' => now(), 'updated_at' => now()],

            // 韓国
            ['city_name' => 'ソウル', 'reading' => 'そうる', 'country_id' => 2, 'latitude' => null, 'longitude' => null, 'created_at' => now(), 'updated_at' => now()],

            // 中国
            ['city_name' => '北京', 'reading' => 'ぺきん', 'country_id' => 3, 'latitude' => null, 'longitude' => null, 'created_at' => now(), 'updated_at' => now()],
            ['city_name' => '上海', 'reading' => 'しゃんはい', 'country_id' => 3, 'latitude' => null, 'longitude' => null, 'created_at' => now(), 'updated_at' => now()],

            // 台湾
            ['city_name' => '台北', 'reading' => 'たいぺい', 'country_id' => 4, 'latitude' => null, 'longitude' => null, 'created_at' => now(), 'updated_at' => now()],

            // 香港
            ['city_name' => '香港', 'reading' => 'ほんこん', 'country_id' => 5, 'latitude' => null, 'longitude' => null, 'created_at' => now(), 'updated_at' => now()],

            // モンゴル
            ['city_name' => 'ウランバートル', 'reading' => 'うらんばーとる', 'country_id' => 6, 'latitude' => null, 'longitude' => null, 'created_at' => now(), 'updated_at' => now()],

            // インド
            ['city_name' => 'デリー', 'reading' => 'でりー', 'country_id' => 7, 'latitude' => null, 'longitude' => null, 'created_at' => now(), 'updated_at' => now()],

            // インドネシア
            ['city_name' => 'ジャカルタ', 'reading' => 'じゃかるた', 'country_id' => 8, 'latitude' => null, 'longitude' => null, 'created_at' => now(), 'updated_at' => now()],

            // マレーシア
            ['city_name' => 'クアラルンプール', 'reading' => 'くあらるんぷーる', 'country_id' => 9, 'latitude' => null, 'longitude' => null, 'created_at' => now(), 'updated_at' => now()],

            // フィリピン
            ['city_name' => 'マニラ', 'reading' => 'まにら', 'country_id' => 10, 'latitude' => null, 'longitude' => null, 'created_at' => now(), 'updated_at' => now()],

            // シンガポール
            ['city_name' => 'シンガポール', 'reading' => 'しんがぽーる', 'country_id' => 11, 'latitude' => null, 'longitude' => null, 'created_at' => now(), 'updated_at' => now()],

            // タイ
            ['city_name' => 'バンコク', 'reading' => 'ばんこく', 'country_id' => 12, 'latitude' => null, 'longitude' => null, 'created_at' => now(), 'updated_at' => now()],

            // ベトナム
            ['city_name' => 'ハノイ', 'reading' => 'はのい', 'country_id' => 13, 'latitude' => null, 'longitude' => null, 'created_at' => now(), 'updated_at' => now()],

            // イギリス
            ['city_name' => 'ロンドン', 'reading' => 'ろんどん', 'country_id' => 14, 'latitude' => null, 'longitude' => null, 'created_at' => now(), 'updated_at' => now()],

            // フランス
            ['city_name' => 'パリ', 'reading' => 'ぱり', 'country_id' => 15, 'latitude' => null, 'longitude' => null, 'created_at' => now(), 'updated_at' => now()],

            // ドイツ
            ['city_name' => 'ベルリン', 'reading' => 'べるりん', 'country_id' => 16, 'latitude' => null, 'longitude' => null, 'created_at' => now(), 'updated_at' => now()],

            // イタリア
            ['city_name' => 'ローマ', 'reading' => 'ろーま', 'country_id' => 17, 'latitude' => null, 'longitude' => null, 'created_at' => now(), 'updated_at' => now()],

            // スペイン
            ['city_name' => 'マドリード', 'reading' => 'まどりーど', 'country_id' => 18, 'latitude' => null, 'longitude' => null, 'created_at' => now(), 'updated_at' => now()],

            // ロシア
            ['city_name' => 'モスクワ', 'reading' => 'もすくわ', 'country_id' => 19, 'latitude' => null, 'longitude' => null, 'created_at' => now(), 'updated_at' => now()],

            // オランダ
            ['city_name' => 'アムステルダム', 'reading' => 'あむすてるだむ', 'country_id' => 20, 'latitude' => null, 'longitude' => null, 'created_at' => now(), 'updated_at' => now()],

            // スイス
            ['city_name' => 'チューリッヒ', 'reading' => 'ちゅーりっひ', 'country_id' => 21, 'latitude' => null, 'longitude' => null, 'created_at' => now(), 'updated_at' => now()],

            // アメリカ
            ['city_name' => 'ニューヨーク', 'reading' => 'にゅーよーく', 'country_id' => 22, 'latitude' => null, 'longitude' => null, 'created_at' => now(), 'updated_at' => now()],
            ['city_name' => 'ロサンゼルス', 'reading' => 'ろさんぜるす', 'country_id' => 22, 'latitude' => null, 'longitude' => null, 'created_at' => now(), 'updated_at' => now()],

            // カナダ
            ['city_name' => 'トロント', 'reading' => 'とろんと', 'country_id' => 23, 'latitude' => null, 'longitude' => null, 'created_at' => now(), 'updated_at' => now()],

            // オーストラリア
            ['city_name' => 'シドニー', 'reading' => 'しどにー', 'country_id' => 24, 'latitude' => null, 'longitude' => null, 'created_at' => now(), 'updated_at' => now()],

            // ニュージーランド
            ['city_name' => 'オークランド', 'reading' => 'おーくらんど', 'country_id' => 25, 'latitude' => null, 'longitude' => null, 'created_at' => now(), 'updated_at' => now()],

            // ブラジル
            ['city_name' => 'サンパウロ', 'reading' => 'さんぱうろ', 'country_id' => 26, 'latitude' => null, 'longitude' => null, 'created_at' => now(), 'updated_at' => now()],

            // アルゼンチン
            ['city_name' => 'ブエノスアイレス', 'reading' => 'ぶえのすあいれす', 'country_id' => 27, 'latitude' => null, 'longitude' => null, 'created_at' => now(), 'updated_at' => now()],

            // トルコ
            ['city_name' => 'イスタンブール', 'reading' => 'いすたんぶーる', 'country_id' => 28, 'latitude' => null, 'longitude' => null, 'created_at' => now(), 'updated_at' => now()],

            // イラン
            ['city_name' => 'テヘラン', 'reading' => 'てへらん', 'country_id' => 29, 'latitude' => null, 'longitude' => null, 'created_at' => now(), 'updated_at' => now()],

            // エジプト
            ['city_name' => 'カイロ', 'reading' => 'かいろ', 'country_id' => 30, 'latitude' => null, 'longitude' => null, 'created_at' => now(), 'updated_at' => now()],

            // 南アフリカ
            ['city_name' => 'ケープタウン', 'reading' => 'けーぷたうん', 'country_id' => 31, 'latitude' => null, 'longitude' => null, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
