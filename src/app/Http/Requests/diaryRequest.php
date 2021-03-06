<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class diaryRequest extends FormRequest
{
    /**
     * 日記登録機能の項目
     */
    public function attributes()
    {
        return [
            'dairyData.title' => 'タイトル',
            'dairyData.date' => '釣行日',
            'dairyData.start_time' => '釣り開始時間',
            'dairyData.end_time' => '釣り終了時間',
            'dairyData.field_id' => '釣り場',
            'dairyData.season' => '季節',
            'dairyData.weather' => '天気',
            'dairyData.lowest_temperature' => '最低気温',
            'dairyData.highest_temperature' => '最高気温',
            'dairyData.lowest_water_temperature' => '最低水温',
            'dairyData.highest_water_temperature' => '最高水温',
            'dairyData.tide' => '潮',
            'dairyData.competition_flg' => '試合フラグ',
            'dairyData.contents' => '釣りの内容',
            'dairyData.consideration' => '考察',
        ];
    }

    /**
     * 日記の登録機能用バリデーションルール
     *
     * @return array
     */
    public function rules()
    {
        $seasonValidate = function($attribute, $value, $fail) {
            $seasonList = config('item.season');
            $result = in_array($value, $seasonList);
            if (!$result) {
                $fail('季節の値に誤りがありました。');
            }
        };

        $weatherValidate = function($attribute, $value, $fail) {
            $weatherList = config('item.weather');
            $result = in_array($value, $weatherList);
            if (!$result) {
                $fail('天気の値に誤りがありました。');
            }
        };

        $tideValidate = function($attribute, $value, $fail) {
            $tideList = config('item.tide');
            $result = in_array($value, $tideList);
            if (!$result) {
                $fail('潮の値に誤りがありました。');
            }
        };

        $tempDiffValid = function($attribute, $value, $fail) {
            $data = $this->all();
            
            if ($value < $data['dairyData']['lowest_temperature']) {
                $fail('最高気温の値が最低気温を下回ってます。');
            }
        };

        $waterTempDiffValid = function($attribute, $value, $fail) {
            $data = $this->all();
            
            if ($value < $data['dairyData']['lowest_temperature']) {
                $fail('最高気温の値が最低気温を下回ってます。');
            }
        };

        return [
            'dairyData.title' => ['required', 'max:200'],
            'dairyData.date' => ['required', 'date_format:Y-m-d'],
            'dairyData.start_time' => ['required', 'date_format:H:i'],
            'dairyData.end_time' => ['required', 'date_format:H:i', 'after:dairyData.start_time'],
            'dairyData.field_id' => ['required','exists:field,id'],
            'dairyData.season' => ['required', $seasonValidate],
            'dairyData.weather' => ['required', $weatherValidate],
            'dairyData.lowest_temperature' => ['regex:/[0-9]|[1-4][0-9]/'],
            'dairyData.highest_temperature' => ['regex:/[0-9]|[1-4][0-9]/', $tempDiffValid],
            'dairyData.lowest_water_temperature' => ['regex:/[0-9]|[1-4][0-9]/'],
            'dairyData.highest_water_temperature' => ['regex:/[0-9]|[1-4][0-9]/', $waterTempDiffValid],
            'dairyData.tide' => ['required', $tideValidate],
            'dairyData.competition_flg' => ['boolean'],
            'dairyData.contents' => ['max:10000'],
            'dairyData.consideration' => ['max:10000']
        ];
    }

    public function messages()
    {
        return [
            'required' => ':attributeは必須項目です',
            'max' => ':attributeが文字数オーバーです',
            'date_format' => ':attributeは:formatの書き方で入力をお願いします',
            'boolean' => ':attributeの値が間違ってます',
            'exists' => ':attributeの値が間違っています',
            'regex' => ':attributeの値が間違っています',
            'dairyData.end_time.after' => ':attributeの時間が釣り開始時間よりも前になってます',
            'min:dairyData.lowest_temperature' => '最高気温の値が最低気温を下回ってます。',
        ];
    }
}
