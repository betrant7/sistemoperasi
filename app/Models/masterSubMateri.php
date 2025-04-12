<?php

namespace App\Models;

use CodeIgniter\Model;

class MasterSubMateri extends Model
{
    protected $table = "subMateri";
    protected $primaryKey = "idSubMateri";
    protected $allowedFields = ['idMateri', 'judulMateri', 'dataMateri'];

    public function getSubMateri()
    {
        return $this->findAll();
    }
    public function getSubMateriById($idSubMateri)
    {
        return $this->where('idSubMateri', $idSubMateri)->first();
    }
    public function deleteSubMateri($idSubMateri)
    {
        return $this->delete($idSubMateri);
    }
}