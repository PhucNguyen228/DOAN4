<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class DoanhThuAdminFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            // crate data for table doanh_thu_admin
            'id_tai_khoan' => $this->faker->numberBetween(1, 500),
            'tong_doanh_thu' => $this->faker->numberBetween(1000000, 100000000),
            'Thang_thu_nhap' => $this->faker->dateTimeBetween('-10 years', 'now'),
        ];
    }
}
