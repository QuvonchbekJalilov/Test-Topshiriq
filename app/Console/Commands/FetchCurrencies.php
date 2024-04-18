<?php

namespace App\Console\Commands;

use App\Models\Currency;
use GuzzleHttp\Client;
use Illuminate\Console\Command;

class FetchCurrencies extends Command
{
    protected $signature = 'fetch:currencies';

    protected $description = 'Fetch currencies from the Open Exchange Rates API';

    public function handle()
    {
        $client = new Client();
        $response = $client->get('https://openexchangerates.org/api/currencies.json', [
            'query' => [
                'prettyprint' => false,
                'show_alternative' => false,
                'show_inactive' => false,
                'app_id' => 1,
            ],
        ]);

        $currencies = json_decode($response->getBody(), true);

        foreach ($currencies as $code => $name) {
            $country = $this->getCountryNameByCurrencyCode($code);

            Currency::create([
                'country' => $country,
                'currency_code' => $code,
                'currency_name' => $name,
            ]);
        }

        $this->info('Currencies fetched and saved successfully.');
    }

    private function getCountryNameByCurrencyCode($currencyCode)
    {
        
        $countryMap = [
            'USD' => 'United States',
            'EUR' => 'Eurozone',
            'JPY' => 'Japan',
            'GBP' => 'United Kingdom',
            'AUD' => 'Australia',
            'CAD' => 'Canada',
            'CHF' => 'Switzerland',
            'CNY' => 'China',
            'SEK' => 'Sweden',
            'NZD' => 'New Zealand',
            'KRW' => 'South Korea',
            'SGD' => 'Singapore',
            'NOK' => 'Norway',
            'MXN' => 'Mexico',
            'INR' => 'India',
            'RUB' => 'Russia',
            'ZAR' => 'South Africa',
            'TRY' => 'Turkey',
            'BRL' => 'Brazil',
            'HKD' => 'Hong Kong',
            'IDR' => 'Indonesia',
            'ISK' => 'Iceland',
            'PHP' => 'Philippines',
            'DKK' => 'Denmark',
            'PLN' => 'Poland',
            'THB' => 'Thailand',
            'HUF' => 'Hungary',
            'CZK' => 'Czech Republic',
            'ILS' => 'Israel',
            'CLP' => 'Chile',
            'AED' => 'United Arab Emirates',
            'CO' => 'Colombia',
            'SAR' => 'Saudi Arabia',
            'MYR' => 'Malaysia',
            'RON' => 'Romania',
            'NPR' => 'Nepal',
            'PKR' => 'Pakistan',
            'KWD' => 'Kuwait',
            'DZD' => 'Algeria',
            'EGP' => 'Egypt',
            'QAR' => 'Qatar',
            'KZT' => 'Kazakhstan',
            'MAD' => 'Morocco',
            'BDT' => 'Bangladesh',
            'OMR' => 'Oman',
            'COP' => 'Colombia',
            'TWD' => 'Taiwan',
        ];

        return $countryMap[$currencyCode] ?? 'Unknown';
    }
}
