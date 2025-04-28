<?php

namespace App\Models;

use CodeIgniter\Model;

class LaporanPembelajaran extends Model
{
    protected $table = "laporanpembelajaran";
    protected $primaryKey = "idlaporanPembelajaran";
    protected $allowedFields = ['idUser', 'idMateri', 'idSubMateri','progres', 'waktuMulai', 'waktuSelesai'];

    public function getProgres()
    {
        return $this->db->table('laporanpembelajaran')
            ->select('laporanpembelajaran.*, user.namaLengkap, user.kelas, materi.namaMateri')
            ->join('user', 'user.idUser = laporanpembelajaran.idUser')
            ->join('subMateri','subMateri.idSubMateri = laporanpembelajaran.idSubMateri')
            ->join('materi', 'materi.idMateri = laporanpembelajaran.idMateri')
            ->get()
            ->getResultArray();
    }

    public function getProgresByUser($idUser)
    {
        return $this->where('idUser', $idUser)->findAll();
    }

}