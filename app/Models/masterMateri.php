<?php

namespace App\Models;

use CodeIgniter\Model;

class MasterMateri extends Model
{
    protected $table = "materi";
    protected $primaryKey = "idMateri";
    protected $allowedFields = ['idUser', 'namaMateri', 'status'];

    public function getMateri()
    {
        return $this->select('materi.*, submateri.idSubMateri,submateri.dataMateri,submateri.judulMateri')
            ->join('submateri', 'submateri.idMateri = materi.idMateri', 'left')
            ->findAll();
    }  

    public function getById($namaMateri)
    {
        return $this->where('idMateri', $namaMateri);
    }

    public function getMateriGrouped()
    {
        $result = $this->db->table('materi')
            ->select('materi.*, 
                    GROUP_CONCAT(submateri.idSubMateri ORDER BY submateri.idSubMateri SEPARATOR "|") as idSubMateri,
                    GROUP_CONCAT(submateri.judulMateri ORDER BY submateri.idSubMateri SEPARATOR "|") as judulMateri')
            ->join('submateri', 'submateri.idMateri = materi.idMateri', 'left')
            ->groupBy('materi.idMateri')
            ->get()
            ->getResultArray();

        // Ubah string `judulMateri` dan `idSubMateri` menjadi array agar bisa di-loop di view
        foreach ($result as &$item) {
            $item['idSubMateri'] = explode('|', $item['idSubMateri']);
            $item['judulMateri'] = explode('|', $item['judulMateri']);
        }

        return $result;
    }

    public function getTotalSubMateri($materiId)
    {
        return $this->db->table('submateri')
                        ->where('idMateri', $materiId)
                        ->countAllResults();
    }
}