<?php

namespace App\Models;

use CodeIgniter\Model;

class MahasiswaModel extends Model
{
    protected $table            = 'tb_mahasiswa';
    protected $primaryKey       = 'id_mahasiswa';
    protected $useAutoIncrement = true;
    protected $allowedFields       = ['id_mahasiswa', 'npm', 'nama', 'email', 'password', 'status_akun', 'alamat', 'dokumen', 'tgl_lahir', 'no_hp', 'prodi', 'semester'];

    public function getAllData()
    {
        return $this->findAll();
    }

    public function getDataById($id)
    {
        return $this->find($id);
    }

    // MahasiswaModel.php
    public function authenticate($username, $password)
    {
        $hashedPassword = sha1($password);

        $user = $this->where('npm', $username)
            ->where('password', $hashedPassword)
            ->where('status_akun', 'aktif')
            ->first();

        if ($user) {
            return $user;
        }

        return null;
    }

    public function getFilteredData($semester, $status)
    {
        $builder = $this->db->table('tb_mahasiswa');
        if (!empty($semester)) {
            $builder->where('semester', $semester);
        }
        if (!empty($status)) {
            $builder->where('dokumen', $status);
        }
        return $builder->get()->getResultArray();
    }

    public function getDataBySemester()
    {
        $query = $this->db->table($this->table);
        $query->select('semester, COUNT(*) as total_mahasiswa');
        $query->groupBy('semester');

        $result = $query->get()->getResultArray();

        return $result;
    }

    public function countDokumenStatus()
    {
        $builder = $this->db->table($this->table);

        $builder->select('
        SUM(CASE WHEN dokumen = "sudah" THEN 1 ELSE 0 END) AS sudah_dokumen,
        SUM(CASE WHEN dokumen = "belum" THEN 1 ELSE 0 END) AS belum_dokumen
    ');

        $result = $builder->get()->getResultArray();

        return $result;
    }

    public function countMahasiswaWithDokumenSudah()
    {
        return $this->where('dokumen', 'sudah')->countAllResults();
    }

    public function countMahasiswaWithDokumenBelum()
    {
        return $this->where('dokumen', 'belum')->countAllResults();
    }
}
