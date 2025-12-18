<?php

namespace Database\Factories;

use App\Models\Contact;
use Illuminate\Database\Eloquent\Factories\Factory;

class ContactFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Contact::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $lastNames = ['山田', '佐藤', '鈴木', '田中', '高橋', '伊藤', '渡辺', '中村', '小林', '加藤'];
        $firstNames = ['太郎', '花子', '一郎', '次郎', '三郎', '美咲', 'さくら', '大輔', '健太', '優子'];
        $genders = [1, 2, 3]; // 1:男性、2:女性、3:その他
        $categories = \App\Models\Category::pluck('id')->toArray();

        $lastName = $this->faker->randomElement($lastNames);
        $firstName = $this->faker->randomElement($firstNames);
        $phone1 = $this->faker->numerify('0###');
        $phone2 = $this->faker->numerify('####');
        $phone3 = $this->faker->numerify('####');

        $prefectures = ['東京都', '大阪府', '愛知県', '福岡県', '神奈川県', '埼玉県', '千葉県', '兵庫県'];
        $cities = ['渋谷区', '新宿区', '港区', '中央区', '品川区', '目黒区', '世田谷区', '大田区'];
        $streets = ['1-2-3', '2-3-4', '3-4-5', '4-5-6', '5-6-7'];

        return [
            'category_id' => $this->faker->randomElement($categories),
            'first_name' => $firstName,
            'last_name' => $lastName,
            'gender' => $this->faker->randomElement($genders),
            'email' => $this->faker->unique()->safeEmail,
            'tel' => $phone1 . $phone2 . $phone3,
            'address' => $this->faker->randomElement($prefectures) . 
                        $this->faker->randomElement($cities) . 
                        $this->faker->randomElement($streets),
            'building' => $this->faker->optional(0.5)->randomElement([
                'マンション101', 'アパート202', 'ビル303', 'コーポ404', null
            ]),
            'detail' => $this->faker->realText(100),
            'created_at' => $this->faker->dateTimeBetween('-6 months', 'now'),
            'updated_at' => now(),
        ];
    }
}

