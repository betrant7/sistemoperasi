<?php

namespace App\Models;

use CodeIgniter\Model;

class MasterVM extends Model
{
    protected $table      = 'listvm';
    protected $primaryKey = 'idVM';
    protected $allowedFields = ['idUser', 'idVmProxmox', 'status', 'jenisVM', 'node'];

    // Ambil VM berdasarkan id_user
    public function getVMByUserId($userId)
    {
        return $this->where('idUser', $userId)->first();
    }

    public function getVMByUserIdAndJenisVM($userId, $jenisVM)
    {
        return $this->where('idUser', $userId)->where('jenisVM', $jenisVM)->first();
    }

    // Menyimpan data VM ke dalam database
    public function createVM($data)
    {
        return $this->save($data);
    }

    // Mengupdate status VM
    public function updateVMStatus($id_vm, $status)
    {
        return $this->update($id_vm, ['status' => $status]);
    }

    // Menghapus data VM
    public function deleteVM($id_vm)
    {
        return $this->delete($id_vm);
    }

    public function getActiveVMsByUserId($userId)
    {
        return $this->where('idUser', $userId)
                    ->where('status', 'aktif')
                    ->first();
    }

    // Update status VM berdasarkan idVmProxmox
    public function updateVMStatusByProxmoxID($idVmProxmox, $status)
    {
        return $this->where('idVmProxmox', $idVmProxmox)
                    ->set(['status' => $status])
                    ->update();
    }
}
