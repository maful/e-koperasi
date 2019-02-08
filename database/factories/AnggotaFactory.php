<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Member::class, function (Faker $faker) {
    return [
        'nik' => $faker->unique()->numberBetween(1111111111111111, 9999999999999999),
        'nama' => $faker->firstName,
        'email' => $faker->unique()->safeEmail,
        'no_hp' => $faker->e164PhoneNumber,
        'jenkel' => 'L',
        'agama' => 'Islam',
        'pekerjaan' => $faker->jobTitle,
        'alamat' => $faker->address,
        'tempat_lahir' => $faker->city,
        'tanggal_lahir' => $faker->date(),
    ];
});
