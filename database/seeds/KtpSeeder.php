<?php

use Illuminate\Database\Seeder;

use Faker\Factory as Faker;


class KtpSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID');

    	for($i = 1; $i <= 50; $i++){

        $dt = $faker->dateTimeBetween($startDate = '-90 years', $endDate = '-17 years');
        $date = $dt->format("Y-m-d");

        $dt1 = $faker->dateTimeBetween($startDate = '-10 years', $endDate = 'now');
        $date1 = $dt1->format("Y-m-d"); 

    		DB::table('ktp')->insert([
    			'nik' => $faker->creditCardNumber,
    			'nama' => $faker->name,
    			'tmpt_lhr' => $faker->city,
                'tgl_lhir' => $date,
                'jenkel' =>  $faker->randomElement(['Laki-Laki' ,'Perempuan']),
                'goldarah' => $faker->randomElement(['A' ,'B','O','AB']),
                'alamat' => $faker->address,
                'rt' => $faker->randomDigitNotNull,
                'rw' => $faker->randomDigitNotNull,
                'kel' => $faker->city,
                'kec' => $faker->city,
                'agama' => $faker->randomElement(['Katholik' ,'Kristen','Islam','Hindu','Budha','Konghucu']),
                'status' => $faker->randomElement(['Kawin' ,'Belum Kawin']),
                'pekerjaan' => $faker->jobTitle,
                'kewarga' => $faker->randomElement(['WNI' ,'WNA']),
                'berlaku' => $date1,
    		]);

    	}
    }
}
