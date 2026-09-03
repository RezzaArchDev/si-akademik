<?php

class Dosen
{
    public function getAll()
    {
        return [
            [
                'nidn' => '001',
                'nama' => 'Bu Qonita',
                'prodi' => 'Teknik Informatika'
            ],
            [
                'nidn' => '002',
                'nama' => 'Pak Radit',
                'prodi' => 'Sistem Informasi'
            ]
        ];
    }

    public function getByNidn($nidn)
    {
        $dosenList = $this->getAll();

        foreach ($dosenList as $dosen) {
            if ($dosen['nidn'] === $nidn) {
                return $dosen;
            }
        }

        return null;
    }
}