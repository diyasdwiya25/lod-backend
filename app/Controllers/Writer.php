<?php

namespace App\Controllers;
use CodeIgniter\API\ResponseTrait;
use App\Models\WriterModel;

class Writer extends BaseController
{
    /*model*/
    protected $WriterModel;
    /*db*/
    protected $db;
	use ResponseTrait;
    
    public function __construct()
    {
        $this->mdl = new \App\Models\WriterModel();
        $this->validation = \Config\Services::validation();
    }

    public function show()
    {
        $data = $this->mdl->findAll();
        $response = [
            'status'   => 200,
            'error'    => null,
            'messages' => [
                'success' => 'Berhasil Menampilkan list writer'
            ],
            'data' => $data,
        ];
         
        return $this->respond($response);
    }

	// get single show
    public function find($id)
    {
        $data = $this->mdl->where('id', $id)->first();
        if($data){
            $response = [
                'status'   => 200,
                'error'    => null,
                'messages' => [
                    'success' => 'Berhasil Menampilkan writer'
                ],
                'data' => $data,
            ];
        }else{
            return $this->fail('data tidak ditemukan');
        }

        return $this->respond($response);
    }

	// create a data
    public function create()
    {
        $data = [
			'name' => $this->request->getJsonVar('name'),
            'slug' => $this->request->getJsonVar('slug'),
            'status' => $this->request->getJsonVar('status'),
        ];
		$validate = $this->validation->run($data, 'create_writer');
		$errors = $this->validation->getErrors();

        if($errors){
            return $this->fail($errors);
        }

        $insert = $this->mdl->insert($data);
        $response = [
            'status'   => 200,
            'error'    => null,
            'messages' => [
                'success' => 'Data berhasil ditambah'
            ]
        ];
         
        return $this->respond($response);
    }

	// update a data
	public function update($id = null)
    {
        $data = [
            'id' => $id,
			'name' => $this->request->getJsonVar('name'),
            'slug' => $this->request->getJsonVar('slug'),
            'status' => $this->request->getJsonVar('status'),
        ];
        $validate = $this->validation->run($data, 'update_writer');
        $errors = $this->validation->getErrors();

        if($errors){
            return $this->fail($errors);
        }

        if(!$this->mdl->where('id', $id)->first())
        {
            return $this->fail('id tidak ditemukan');
        }

		$update = $this->mdl->update($id, $data);
        $response = [
            'status'   => 200,
            'error'    => null,
            'messages' => [
                'success' => 'Data berhasil diubah'
            ],
            'data' => $data,
        ];
         
        return $this->respond($response);
    }

	// delete a data
    public function delete($id = null)
    {
        if(!$this->mdl->where('id', $id)->first())
        {
            return $this->fail('id tidak ditemukan');
        }

        if($this->mdl->delete($id)){
            $response = [
                'status'   => 200,
                'error'    => null,
                'messages' => [
                    'success' => 'Data berhasil dihapus'
                ],
            ];
            return $this->respond($response);
        }
    }
}