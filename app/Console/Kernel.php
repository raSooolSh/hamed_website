<?php

namespace App\Console;

use App\Models\Coin;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')->everyMinute();
        $schedule->call(function () {
            $response = Http::withHeaders([
                'Accepts' => 'application/json',
                'X-CMC_PRO_API_KEY' => env('CURRENCY_PRICE_API')
            ])->get('https://pro-api.coinmarketcap.com/v1/cryptocurrency/listings/latest', [
                'start' => 1,
                'limit' => 20,
                'convert' => 'USD'
            ]);
            foreach ($response->json()['data'] as $coin) {
                $row = Coin::where('cmc_id', $coin['id'])->first();
                if ($row) {
                    $row->update([
                        'symbol' => $coin['symbol'],
                        'name' => $coin['name'],
                        'price' => $coin['quote']['USD']['price'],
                        'change_yesterday' => $coin['quote']['USD']['percent_change_24h'],
                        'change_last_week' => $coin['quote']['USD']['percent_change_7d'],
                        'updated_at' => $coin['last_updated']
                    ]);
                } else {
                    $coinData = Http::withHeaders([
                        'Accepts' => 'application/json',
                        'X-CMC_PRO_API_KEY' => env('CURRENCY_PRICE_API')
                    ])->get('https://pro-api.coinmarketcap.com/v2/cryptocurrency/info', [
                        'slug' => $coin['slug']
                    ])->json()['data'];

                    $logo = Http::get($coinData[array_key_first($coinData)]['logo'])->body();


                    Storage::disk('public')->append('logos/' . $coin['slug'] . '.png', $logo);
                    Coin::create([
                        'cmc_id' => $coin['id'],
                        'symbol' => $coin['symbol'],
                        'name' => $coin['name'],
                        'logo' => 'storage/logos/' . $coin['slug'] . '.png',
                        'price' => $coin['quote']['USD']['price'],
                        'change_yesterday' => $coin['quote']['USD']['percent_change_24h'],
                        'change_last_week' => $coin['quote']['USD']['percent_change_7d'],
                        'updated_at' => $coin['last_updated']
                    ]);
                }
            }
        })->everyfiveMinutes();
        $schedule->call(function () {
            $coins = Coin::ALL();
            foreach ($coins as $coin) {
                $url = 'https://s3.coinmarketcap.com/generated/sparklines/web/7d/2781/' . $coin->cmc_id . '.svg';
                $chart = Http::get($url)->body();
                preg_match('/(?=<svg)[\s\S]*/', $chart, $svg);
                $svg = $svg[0];
                $svg = preg_replace('/width="164px"/', 'width="185px"', $svg);
                $svg = preg_replace('/height="48px"/', 'height="80px"', $svg);
                if ($coin->change_last_week >= 0) {
                    $svg = preg_replace('/stroke:rgb\(237,194,64\)/', 'stroke:rgb(0,200,0)', $svg);
                } else {
                    $svg = preg_replace('/stroke:rgb\(237,194,64\)/', 'stroke:rgb(200,0,0)', $svg);
                }

                $coin->chart = $svg;
                $coin->save();
            }
        })->everySixHours();
    }


    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
