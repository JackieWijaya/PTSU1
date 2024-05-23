<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use App\Models\data_pribadi;
use App\Models\pengaturan_presensi;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        User::query()->create([
            'name'     => 'HRD',
            'no_hp'    => '081234567890',
            'password' => '081234567890',
            'role'     => 'HRD',
        ]);

        data_pribadi::query()->create([
            'nama_lengkap'        => 'HRD',
            'tanggal_lahir'       => '2012-12-12',
            'jenis_kelamin'       => 'Laki-laki',
            'tempat_lahir'        => '-',
            'alamat'              => '-',
            'pendidikan_terakhir' => '-',
            'no_hp'               => '081234567890',
            'email'               => '-',
            'agama'               => '-',
            'golongan_darah'      => '-',
            'status'              => 'Diterima',
        ]);

        pengaturan_presensi::query()->create([
            'lokasi'     => '-2.9685911021601874, 104.77246514075837',
            'radius'     => '30',
            'jam_masuk'  => '08:00:00',
            'jam_keluar' => '17:00:00',
        ]);
    }
}
