<?php

namespace App\Controllers;

#use CodeIgniter\Controller;

use App\Models\UserModel;
use CodeIgniter\HTTP\Request;
use App\Models\Users;

class Upload extends BaseController
{

    public function index()
    {
        return view('form');
    }

    public function doingUpload()
    {
        $success = false;
        $message = "Gagal simpan data";
        $data    = null;

        $data = [
            'id_belmawa' => $this->request->getVar('id_belmawa'),
        ];

        $user = new Users;
        $res  = $user->insert($data);
        if( $res )
        {
            $success = true;
            $id   = $user->getInsertID();
            $message = "Berhasil simpan data";

            if( $this->request->getFile('file') )
            {
                $file = $this->request->getFile('file');
                $name  = $file->getName();
                $temp  = $file->getTempName();
                $ext   = $file->getClientExtension();
                $newName = $file->getRandomName();

                if ($file->isValid() && ! $file->hasMoved()) {

                    if( in_array($ext, ['pdf']) )
                    {
                        $path = FCPATH. 'file/'. $newName;
                        $file->move( FCPATH. 'file', $newName);
    
                        $edit = new Users;
                        $user = $edit->update($id, ['file'=> str_replace( FCPATH , "", $path) ]);
    
                        $message = "Berhasil simpan data dan upload fille";
                    }else{
                        $message = "Gagal upload file. File yang boleh diupload adalah tipe pdf";
                    }
                    

                    $data = $edit->find($id);
                }

            }
        }
        

        return $this->response->setJSON(['success' => $success, 'data' => $data, "message" => $message]);
    }


}