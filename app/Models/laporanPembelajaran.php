<?php

namespace App\Models;

use CodeIgniter\Model;

class LaporanPembelajaran extends Model
{
    protected $table = "laporanPembelajaran";
    protected $primaryKey = "idlaporanPembelajaran";
    protected $allowedFields = ['idUser', 'idMateri','progres', 'waktu'];

    public function getProgres()
    {
        return $this->db->table('laporanPembelajaran')
            ->select('laporanPembelajaran.*, user.namaLengkap, user.kelas, materi.namaMateri')
            ->join('user', 'user.idUser = laporanPembelajaran.idUser')
            ->join('materi', 'materi.idMateri = laporanPembelajaran.idMateri')
            ->get()
            ->getResultArray();
    }

    public function getProgresByUser($idUser)
    {
        return $this->where('idUser', $idUser)->findAll();
    }

    public function updateProgress($idUser, $idMateri, $proses)
    {
        return $this->insert([
            'idUser' => $idUser,
            'idMateri' => $idMateri,
            'proses' => $proses,
            'waktu' => date('Y-m-d H:i:s'),
        ]);
    }

}