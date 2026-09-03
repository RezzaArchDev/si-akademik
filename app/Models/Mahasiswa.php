<?php

class Mahasiswa
{
    public function getAll()
    {
        return [
            [
                'nim' => '23001',
                'nama' => 'Andi',
                'prodi' => 'Teknik Informatika'
            ],
            [
                'nim' => '23002',
                'nama' => 'Budi',
                'prodi' => 'Teknik Informatika'
            ],
            [
                'nim' => '23003',
                'nama' => 'Citra',
                'prodi' => 'Sistem Informasi'
            ],
            [
                'nim' => '23004',
                'nama' => 'Sumarno',
                'prodi' => 'Sistem Informasi'
            ],
            [
                'nim' => '23005',
                'nama' => 'Suseno',
                'prodi' => 'Teknik Informatika'
            ],
            [
                'nim' => '23006',
                'nama' => 'Tamsir',
                'prodi' => 'Sistem Informasi'
            ]
        ];
    }

    public function getByNim($nim)
    {
        $mahasiswaList = $this->getAll();

        foreach ($mahasiswaList as $mahasiswa) {
            if ($mahasiswa['nim'] === $nim) {
                return $mahasiswa;
            }
        }

        return null;
    }
}