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
                'brand_image' => 'https://www.opnminded.com/wp-content/uploads/2025/07/mad-casino-optimized.png',  // Replace with actual URL
                'rating' => 5,
                'country_code' => 'US',  // Canada-focused from site
                'bonus' => '300% up to €3000 on 3 deposits',
                'terms' => 'Wagering ×30, min deposit €20, withdrawal 1-48h',
                'link' => 'https://www.opnminded.com/mad-casino'
            ],
            [
                'brand_name' => 'Robocat',
                'brand_image' => 'https://www.opnminded.com/wp-content/uploads/2025/07/robocat-casino-optimized.png',
                'rating' => 5,
                'country_code' => 'CA',
                'bonus' => '100% up to €500 + 200 FS',
                'terms' => 'Wagering ×35, min deposit €10, withdrawal 24h',
                'link' => 'https://www.opnminded.com/robocat-casino'
            ],
            [
                'brand_name' => 'Spinsy Casino',
                'brand_image' => 'https://www.opnminded.com/wp-content/uploads/2025/07/spinsy-casino-optimized.png',
                'rating' => 4,
                'country_code' => 'DE',
                'bonus' => '100% up to €500 + 200 FS',
                'terms' => 'Wagering ×35 casino/×40 FS, min deposit €10, instant withdrawal',
                'link' => 'https://www.opnminded.com/spinsy-casino'
            ],
            [
                'brand_name' => 'Talismania Casino',
                'brand_image' => 'https://www.opnminded.com/wp-content/uploads/2025/07/talismania-casino-optimized.png',
                'rating' => 3,
                'country_code' => 'CA',
                'bonus' => '100% up to €500 + 200 FS + 1 crab bonus',
                'terms' => 'Wagering ×35 casino/×40 FS, min deposit €20, withdrawal 24-72h',
                'link' => 'https://www.opnminded.com/talismania-casino'
            ],
            [
                'brand_name' => 'Legendplay Casino',
                'brand_image' => 'https://www.opnminded.com/wp-content/uploads/2024/01/LegendPlay-Casinooo-optimized.png',
                'rating' => 3,
                'country_code' => 'US',
                'bonus' => '100% up to €500 + 200 FS',
                'terms' => 'Wagering ×35 casino/×40 FS, min deposit €10, withdrawal 1-3 days',
                'link' => 'https://www.opnminded.com/legendplay-casino'
            ],
            [
                'brand_name' => 'Betalright Casino',
                'brand_image' => 'https://upload.wikimedia.org/wikipedia/commons/6/65/No-Image-Placeholder.svg',
                'rating' => 4,
                'country_code' => 'CA',
                'bonus' => '100% up to €500 + 200 FS + 1 crab bonus',
                'terms' => 'Wagering ×35 casino/×40 FS, min deposit €10, max withdrawal 72h',
                'link' => 'https://www.opnminded.com/betalright-casino'
            ],
            [
                'brand_name' => 'GrandZ Bet Casino',
                'brand_image' => 'https://www.opnminded.com/wp-content/uploads/2025/07/grandzbet-casino-optimized.png',
                'rating' => 3,
                'country_code' => 'US',
                'bonus' => 'Up to €800 + surprise',
                'terms' => 'Wagering ×40, min deposit €10, withdrawal ~72h',
                'link' => 'https://www.opnminded.com/grandzbet-casino'
            ],
            [
                'brand_name' => 'Gransino Casino',
                'brand_image' => 'https://www.opnminded.com/content/cms-images/e7139b6fab43defa27dd2da166e9918d0d257791-600x240.webp',
                'rating' => 4,
                'country_code' => 'DE',
                'bonus' => '100% up to €500 + 200 FS + 1 crab bonus',
                'terms' => 'Wagering ×35, min deposit €10, withdrawal 1-2 days',
                'link' => 'https://www.opnminded.com/gransino-casino'
            ],
            [
                'brand_name' => 'Brutal Casino',
                'brand_image' => 'https://www.opnminded.com/wp-content/uploads/2025/07/grandzbet-casino-optimized.png',
                'rating' => 5,
                'country_code' => 'CA',
                'bonus' => '100% up to €300 without wagering',
                'terms' => 'No wagering, min deposit €20, withdrawal <24h',
                'link' => 'https://www.opnminded.com/brutal-casino'
            ],
            [
                'brand_name' => 'Kingmaker Casino',
                'brand_image' => 'https://www.opnminded.com/content/cms-images/0fdf91013606b4b7c03bb2f40ba8ebaecd75123e-600x240.webp',
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
