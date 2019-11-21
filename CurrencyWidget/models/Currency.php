<?php
namespace app\widgets\CurrencyWidget\models;

use Yii;
use yii\base\Model;
use yii\base\Exception;

/**
 * ContactForm is the model behind the contact form.
 */
class Currency extends Model
{

    public $from_currency;

    public $to_currency;

    public $final;

    public $amount;

    const AED = 'AED';

    public $key = 'ed21c7ecd60749cb6897';

    public function rules()
    {
        return [

            [
                [
                    'from_currency',
                    'to_currency',
                    'amount'
                ],
                'required'
            ],

            [
                'amount',
                'number'
            ]
        ];
    }

    public static function getCountryOptions()
    {
        return [
            'AED' => 'United Arab Emirates Dirham',
            'AFN' => 'Afghanistan Afghani',
            'ARS' => 'Argentina Peso',
            'AUD' => 'Australia Dollar',
            'BDT' => 'Bangladesh Taka',
            'BHD' => 'Bahrain Dinar',
            'CAD' => 'Canada Dollar',
            'COP' => 'Colombia Peso',
            'DOP' => 'Dominican Republic Peso',
            'GBP' => 'United Kingdom Pound',
            'HKD' => 'Hong Kong Dollar',
            'INR' => 'India Rupee',
            'LKR' => 'Sri Lanka Rupee',
            'NZD' => 'New Zealand Dollar',
            'USD' => 'United States Dollar'
        ];
    }

    public function convertPrice()
    {
        $jsonurl = 'https://free.currconv.com/api/v7/convert?q=' . $this->from_currency . '_' . $this->to_currency . '&compact=ultra&apiKey=' . $this->key;

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $jsonurl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $output = curl_exec($ch);
        $total = 0;
        curl_close($ch);
        if (! empty($output)) {
            $result = json_decode($output);
            foreach ($result as $key => $data) {
                $value = $data;
            }

            $total = $value * $this->amount;
        }
        return $total;
    }
}
