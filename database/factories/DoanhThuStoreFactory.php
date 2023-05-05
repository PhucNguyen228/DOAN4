<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class DoanhThuStoreFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            // crate data for table doanh_thu_stores
            'ma_don_hang' => $this->faker->numberBetween($min = 100000, $max = 900000),
            'tong_tien' => $this->faker->numberBetween($min = 100000, $max = 900000),
            'tien_giam_gia' => $this->faker->numberBetween($min = 100000, $max = 900000),
            'tien_tra' => $this->faker->numberBetween($min = 100000, $max = 900000),
            'id_customer' => $this->faker->numberBetween($min = 1, $max = 1000),
            'id_store' => 20,
            'tinh_trang' => $this->faker->numberBetween($min = 0, $max = 1),
            'ngay_hoa_don' => $this->faker->dateTimeBetween($startDate = '-10 years', $endDate = 'now', $timezone = null),
        ];
    }
}
