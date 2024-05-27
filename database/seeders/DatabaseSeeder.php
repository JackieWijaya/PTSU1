<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use App\Models\jabatan;
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

        jabatan::query()->create([
            'nama_jabatan' => 'HRD',
        ]);

        data_pribadi::query()->create([
            'nama_lengkap'        => 'Jackie',
            'tanggal_lahir'       => '2002-06-19',
            'jenis_kelamin'       => 'Laki-Laki',
            'tempat_lahir'        => 'Palembang',
            'alamat'              => 'Jalan Abdul Rozak',
            'pendidikan_terakhir' => 'SMA',
            'no_hp'               => '081243485171',
            'email'               => 'jackie@gmail.com',
            'agama'               => 'Buddha',
            'golongan_darah'      => 'A',
        ]);

        data_pribadi::query()->create([
            'nama_lengkap'        => 'Budi',
            'tanggal_lahir'       => '2002-12-12',
            'jenis_kelamin'       => 'Laki-Laki',
            'tempat_lahir'        => 'Palembang',
            'alamat'              => 'Jalan Mawar No. 1',
            'pendidikan_terakhir' => 'SMA',
            'no_hp'               => '082345678901',
            'email'               => 'budi@gmail.com',
            'agama'               => 'Islam',
            'golongan_darah'      => 'B',
        ]);

        data_pribadi::query()->create([
            'nama_lengkap'        => 'Dewi',
            'tanggal_lahir'       => '2002-06-12',
            'jenis_kelamin'       => 'Perempuan',
            'tempat_lahir'        => 'Palembang',
            'alamat'              => 'Jalan Anggrek Lr. Damai No. 126',
            'pendidikan_terakhir' => 'S1',
            'no_hp'               => '083456789012',
            'email'               => 'dewi@gmail.com',
            'agama'               => 'Islam',
            'golongan_darah'      => 'O',
        ]);

        data_pribadi::query()->create([
            'nama_lengkap'        => 'Yanto',
            'tanggal_lahir'       => '2002-02-7',
            'jenis_kelamin'       => 'Laki-Laki',
            'tempat_lahir'        => 'Palembang',
            'alamat'              => 'Jalan Abdul Rozak No. 126',
            'pendidikan_terakhir' => 'S1',
            'no_hp'               => '084567890123',
            'email'               => 'yanto@gmail.com',
            'agama'               => 'Islam',
            'golongan_darah'      => 'A',
        ]);

        data_pribadi::query()->create([
            'nama_lengkap'        => 'Martin',
            'tanggal_lahir'       => '2002-03-13',
            'jenis_kelamin'       => 'Laki-Laki',
            'tempat_lahir'        => 'Palembang',
            'alamat'              => 'Jalan Anggrek Lr. Damai No. 16',
            'pendidikan_terakhir' => 'S1',
            'no_hp'               => '085678901234',
            'email'               => 'dewi@gmail.com',
            'agama'               => 'Islam',
            'golongan_darah'      => 'A',
        ]);

        pengaturan_presensi::query()->create([
            'lokasi'     => '-2.973488594813909, 104.76410656834805',
            'radius'     => '30',
            'jam_masuk'  => '08:00:00',
            'jam_keluar' => '17:00:00',
        ]);
    }
}
