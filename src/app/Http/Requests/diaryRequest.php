<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class diaryRequest extends FormRequest
{
    /**
     * 日記登録機能の項目
     * 
     * @return array 各項目名リスト
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
     * @return array 各項目のバリデーション
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
            'dairyData.title'                     => ['required', 'max:200'],
            'dairyData.date'                      => ['required', 'date_format:Y-m-d'],
            'dairyData.start_time'                => ['required', 'date_format:H:i'],
            'dairyData.end_time'                  => ['required', 'date_format:H:i', 'after:dairyData.start_time'],
            'dairyData.field_id'                  => ['required', 'exists:field,id'],
            'dairyData.season'                    => ['required', $seasonValidate],
            'dairyData.weather'                   => ['required', $weatherValidate],
            'dairyData.lowest_temperature'        => ['regex:/[0-9]|[1-4][0-9]/'],
            'dairyData.highest_temperature'       => ['regex:/[0-9]|[1-4][0-9]/', $tempDiffValid],
            'dairyData.lowest_water_temperature'  => ['regex:/[0-9]|[1-4][0-9]/'],
            'dairyData.highest_water_temperature' => ['regex:/[0-9]|[1-4][0-9]/', $waterTempDiffValid],
            'dairyData.tide'                      => ['required', $tideValidate],
            'dairyData.competition_flg'           => ['boolean'],
            'dairyData.contents'                  => ['max:10000'],
            'dairyData.consideration'             => ['max:10000'],
        ];
    }

    /**
     * 釣果内容のためのバリデーション
     * 
     * @param Validator $validator
     * @return 
     */
    public function withValidator(Validator $validator)
    {
        //配列の中身が空だった場合はバリデーションを通過させる。
        $fishResultList = $this->input('fishResult');
        if (!empty($fishResultList)) {
            foreach ($fishResultList as $key => $fishResult) {
                $lengthMessage = $this->lengthValid($fishResult, $key);
                if (!empty($lengthMessage)) {
                    $validator->errors()->add('fishResult'. $key. 'length', $lengthMessage);
                }
                $weightMessage = $this->weightValid($fishResult, $key);
                if (!empty($weightMessage)) {
                    $validator->errors()->add('fishResult'. $key. 'weight', $weightMessage);
                }
                $lureMessage = $this->lureValid($fishResult, $key);
                if (!empty($lureMessage)) {
                    $validator->errors()->add('fishResult'. $key. 'lure', $lureMessage);
                }
                $catchTimeMessage = $this->catchTimeValid($fishResult, $key);
                if (!empty($catchTimeMessage)) {
                    $validator->errors()->add('fishResult'. $key. 'catchTime', $catchTimeMessage);
                }
            }
        }
    }

    /**
     * 釣果欄の 長さ のバリデーション
     * 
     * @param $fishResult 釣果データ
     * @param $key 行数
     * @return string|null エラーメッセージ
     */
    public function lengthValid($fishResult, $key)
    {
        if (empty($fishResult['length'])) {
            return '釣果欄の'. $key+1 .'行目の長さの値が空です';
        }
        // (少数点含む)数値で0-79.5
        if (preg_match('/^([1-7][0-9]{0,2}|0)(\.[0-9])?$/', $fishResult['length'])) {
            return '釣果欄の'. $key+1 .'行目の長さの値が間違っています';
        }

        return null;
    }

    /**
     * 釣果欄の 重さ のバリデーション
     * 
     * @param $fishResult 釣果データ
     * @param $key 行数
     * @return string エラーメッセージ
     */
    public function weightValid($fishResult, $key)
    {
        if (empty($fishResult['weight'])) {
            return '釣果欄の'. $key+1 .'行目の重さの値が空です';
        }
        // 数値で 100-10000
        if (preg_match('/[1-9][0-9][0-9]|[1-9][0-9][0-9][0-9]|10000/', $fishResult['weight'])) {
            return '釣果欄の'. $key+1 .'行目の重さの値が間違っています';
        }
    }

    /**
     * 釣果欄の ルアー のバリデーション
     * 
     * @param $fishResult 釣果データ
     * @param $key 行数
     * @return string エラーメッセージ
     */
    public function lureValid($fishResult, $key)
    {
        if (empty($fishResult['lure'])) {
            return '釣果欄の'. $key+1 .'行目のルアーの値が空です';
        }
        // 200文字以内
        if (mb_strlen($fishResult['lure']) > 200 ) {
            return '釣果欄の'. $key+1 .'行目のルアーが文字数オーバーです';
        }
    }

    /**
     * 釣果欄の 釣れた時間 のバリデーション
     * 
     * @param $fishResult 釣果データ
     * @param $key 行数
     * @return string エラーメッセージ
     */
    public function catchTimeValid($fishResult, $key)
    {
        if (empty($fishResult['catch_time'])) {
            return '釣果欄の'. $key+1 .'行目の釣れた時間の値が空です';
        }
        // 何時何分の表記であること
        if (preg_match('/|\d{2}\:\d{2}|/', $fishResult['catch_time'])) {
            return '釣果欄の'. $key+1 .'行目の釣れた時間の値が間違っています';
        }
    }

    /**
     * 各バリデーションのエラーメッセージ
     * 
     * @return array エラーメッセージリスト
     */
    public function messages()
    {
        return [
            'required'    => ':attributeは必須項目です',
            'max'         => ':attributeが文字数オーバーです',
            'date_format' => ':attributeは:formatの書き方で入力をお願いします',
            'boolean'     => ':attributeの値が間違ってます',
            'exists'      => ':attributeの値が間違っています',
            'regex'       => ':attributeの値が間違っています',
            'dairyData.end_time.after'         => ':attributeの時間が釣り開始時間よりも前になってます',
            'min:dairyData.lowest_temperature' => '最高気温の値が最低気温を下回ってます。',
        ];
    }

    /**
     * エラー内容を jsonResponse で返すための関数
     * 
     * @return HttpResponseException エラー情報など
     */
    public function failedValidation(Validator $validator)
    {
        $response = response()->json([
            'errors' => $validator->errors(),
        ], 422);

        throw new HttpResponseException($response);
    }
}
