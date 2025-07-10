<?php

namespace App\Models;

use CodeIgniter\Model;

class masterUser extends Model
{
    protected $table = "user";
    protected $primaryKey = "idUser";
    protected $allowedFields = ['username', 'password', 'role', 'namaLengkap', 'email', 'kelas', 'nim', 'status'];

    public function saveUser($data)
    {
        return $this->insert($data);
    }
    public function getData($parameter)
    {
        $builder = $this->table($this->table);
        $builder->where('username', $parameter);
        $query = $builder->get();
        return $query->getRowArray();
    }

    public function isDataComplete($idUser)
    {
        $user = $this->where('idUser', $idUser)->first();
        if (!$user) return false;

        return !empty($user['nim']) && !empty($user['namaLengkap']) && !empty($user['username']) && !empty($user['password']) && !empty($user['kelas']);
    }

    public function getUser()
    {
        return $this->where('role', 'Mahasiswa')->findAll();
    }
}