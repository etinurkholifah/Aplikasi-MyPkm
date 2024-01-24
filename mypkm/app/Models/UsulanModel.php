<?php

namespace App\Models;

use CodeIgniter\Model;

class UsulanModel extends Model
{
    protected $table            = 'tb_usulan';
    protected $primaryKey       = 'id_usulan';
    protected $useAutoIncrement = true;
    protected $allowedFields       = ['id_usulan', 'id_mahasiswa', 'judul', 'val_kabag', 'val_kasubag', 'val_wadir', 'proposal', 'tahun_ajaran', 'id_belmawa'];

    public function getAllData()
    {
        return $this->findAll();
    }

    public function getDataById($id)
    {
        return $this->find($id);
    }

    public function getDataJoin()
    {
        $query = $this->db->table('tb_usulan');
        $query->select('tb_usulan.*, tb_mahasiswa.npm, tb_mahasiswa.nama');
        $query->join('tb_mahasiswa', 'tb_mahasiswa.id_mahasiswa = tb_usulan.id_mahasiswa', 'inner');

        $result = $query->get()->getResultArray();

        return $result;
    }

    public function getDataJoinMahasiswa()
    {
        $id_mahasiswa = session('user')['id_mahasiswa']; // Ambil ID mahasiswa dari sesi

        $query = $this->db->table('tb_usulan');
        $query->select('tb_usulan.*, tb_mahasiswa.npm, tb_mahasiswa.nama');
        $query->join('tb_mahasiswa', 'tb_mahasiswa.id_mahasiswa = tb_usulan.id_mahasiswa', 'inner');
        $query->where('tb_usulan.id_mahasiswa', $id_mahasiswa); // Filter berdasarkan ID mahasiswa dari sesi

        $result = $query->get()->getResultArray();

        return $result;
    }
}
