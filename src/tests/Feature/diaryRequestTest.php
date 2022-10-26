<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Http\Requests\diaryRequest;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class diaryRequestTest extends TestCase
{
    /**
     * 日記作成・編集機能のバリデーションのテストコード
     * 
     * @dataProvider validationProvider
     * @return void
     */
    public function diaryRequestTest($expected, $data)
    {
        $rules = (new diaryRequest())->rules();
        $validator = validator($data, $rules);

        // $this->assertEquals($expected, $validator->passes());
    }

    /**
     * diaryRequestTestのデータセット
     * @return array 日記のデータ
     */
    public function validationProvider()
    {
        $this->createApplication();

        //テスト用データ。上から順に天気、季節、潮、フィールド一覧
        $weather = config('item.weather.sunny');
        $season  = config('item.season.preSpawning');
        $tide = config('item.tide.springTide');
        $fieldId = DB::table('field')->whereNull('deleted_at')
                                     ->orderBy('id', 'desc')
                                     ->limit(1)
                                     ->value('email');
        
        return [
            'success' => [
                true,
                [
                    'dairyData' => [
                        'title' => 'ユニットテスト',
                        'date' => '2022-04-01',
                        'start_time' => '07:00',
                        'end_time' => '17:00',
                        'field_id' => $fieldId,
                        'season' => $season,
                        'weather' => $weather,
                        'lowest_temperature' => '7',
                        'highest_temperature' => '18',
                        'lowest_water_temperature' => '8.0',
                        'highest_water_temperature' => '12.5',
                        'tide' => $tide,
                        'competition_flg' => true,
                    ],
                    'contetns' => '詳細',
                    'consideration' => '考察',
                    'fishResult' => [
                        0 => [
                            'length' => '50.5',
                            'weight' => '2100',
                            'lure' => 'クランクベイト',
                            'catch_time' => '13:45'
                        ]
                    ]
                ],
            ]
        ];
    }
}
