<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Brand;

class BrandSeeder extends Seeder
{
    public function run(): void
    {
        $brands = [
            [
                'brand_name' => 'Mad Casino',
                'brand_image' => 'https://example.com/mad-casino.png',  // Replace with actual URL
                'rating' => 5,
                'country_code' => 'US',  // Canada-focused from site
                'bonus' => '300% up to €3,000 on 3 deposits',
                'terms' => 'Wagering ×30, min deposit €20, withdrawal 1-48h',
                'link' => 'https://www.opnminded.com/mad-casino'
            ],
            [
                'brand_name' => 'Robocat',
                'brand_image' => 'https://example.com/robocat.png',
                'rating' => 4,
                'country_code' => 'CA',
                'bonus' => '100% up to €500 + 200 FS',
                'terms' => 'Wagering ×35, min deposit €10, withdrawal 24h',
                'link' => 'https://www.opnminded.com/robocat-casino'
            ],
            [
                'brand_name' => 'Spinsy Casino',
                'brand_image' => 'https://example.com/spinsy.png',
                'rating' => 4,
                'country_code' => 'DE',
                'bonus' => '100% up to €500 + 200 FS',
                'terms' => 'Wagering ×35 casino/×40 FS, min deposit €10, instant withdrawal',
                'link' => 'https://www.opnminded.com/spinsy-casino'
            ],
            [
                'brand_name' => 'Talismania Casino',
                'brand_image' => 'https://example.com/talismania.png',
                'rating' => 4,
                'country_code' => 'CA',
                'bonus' => '100% up to €500 + 200 FS + 1 crab bonus',
                'terms' => 'Wagering ×35 casino/×40 FS, min deposit €20, withdrawal 24-72h',
                'link' => 'https://www.opnminded.com/talismania-casino'
            ],
            [
                'brand_name' => 'Legendplay Casino',
                'brand_image' => 'https://example.com/legendplay.png',
                'rating' => 3,
                'country_code' => 'US',
                'bonus' => '100% up to €500 + 200 FS',
                'terms' => 'Wagering ×35 casino/×40 FS, min deposit €10, withdrawal 1-3 days',
                'link' => 'https://www.opnminded.com/legendplay-casino'
            ],
            [
                'brand_name' => 'Betalright Casino',
                'brand_image' => 'https://example.com/betalright.png',
                'rating' => 4,
                'country_code' => 'CA',
                'bonus' => '100% up to €500 + 200 FS + 1 crab bonus',
                'terms' => 'Wagering ×35 casino/×40 FS, min deposit €10, max withdrawal 72h',
                'link' => 'https://www.opnminded.com/betalright-casino'
            ],
            [
                'brand_name' => 'GrandZ Bet Casino',
                'brand_image' => 'https://example.com/grandzbet.png',
                'rating' => 3,
                'country_code' => 'US',
                'bonus' => 'Up to €800 + surprise',
                'terms' => 'Wagering ×40, min deposit €10, withdrawal ~72h',
                'link' => 'https://www.opnminded.com/grandzbet-casino'
            ],
            [
                'brand_name' => 'Gransino Casino',
                'brand_image' => 'https://example.com/gransino.png',
                'rating' => 4,
                'country_code' => 'DE',
                'bonus' => '100% up to €500 + 200 FS + 1 crab bonus',
                'terms' => 'Wagering ×35, min deposit €10, withdrawal 1-2 days',
                'link' => 'https://www.opnminded.com/gransino-casino'
            ],
            [
                'brand_name' => 'Brutal Casino',
                'brand_image' => 'https://example.com/brutal.png',
                'rating' => 5,
                'country_code' => 'CA',
                'bonus' => '100% up to €300 without wagering',
                'terms' => 'No wagering, min deposit €20, withdrawal <24h',
                'link' => 'https://www.opnminded.com/brutal-casino'
            ],
            [
                'brand_name' => 'Kingmaker Casino',
                'brand_image' => 'https://example.com/kingmaker.png',
                'rating' => 4,
                'country_code' => 'CA',
                'bonus' => '100% up to €500 + 50 chances to win €1 million',
                'terms' => 'Wagering ×35, min deposit €10, withdrawal up to 2 days',
                'link' => 'https://www.opnminded.com/kingmaker-casino'
            ],
        ];

        foreach ($brands as $data) {
            Brand::create($data);
        }
    }
}
