<?php

namespace App\Controllers;
use CodeIgniter\API\ResponseTrait;
use App\Models\ArtikelModel;

class Artikel extends BaseController
{
    /*model*/
    protected $ArtikelModel;
    /*db*/
    protected $db;
	use ResponseTrait;
    
    public function __construct()
    {
        $this->mdl = new \App\Models\ArtikelModel();
        $this->validation = \Config\Services::validation();
    }

    public function show()
    {
        $data = $this->mdl->get_all_join();
        $response = [
            'status'   => 200,
            'error'    => null,
            'messages' => [
                'success' => 'Berhasil Menampilkan list artikel'
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
                    'success' => 'Berhasil Menampilkan artikel'
                ],
                'data' => $data,
            ];
        }else{
            return $this->fail('data tidak ditemukan');
        }

        return $this->respond($response);
    }

    public function findSlug($slug)
    {
        $data = $this->mdl->find_join_slug($slug);
        if($data){
            $response = [
                'status'   => 200,
                'error'    => null,
                'messages' => [
                    'success' => 'Berhasil Menampilkan artikel'
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
			'title' => $this->request->getJsonVar('title'),
            'slug' => $this->request->getJsonVar('slug'),
            'writer' => $this->request->getJsonVar('writer'),
            'content' => $this->request->getJsonVar('content'),
            'category' => $this->request->getJsonVar('category'),
            'published_at' => $this->request->getJsonVar('published_at'),
            'status' => $this->request->getJsonVar('status'),
        ];
		$validate = $this->validation->run($data, 'create_artikel');
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
			'title' => $this->request->getJsonVar('title'),
            'slug' => $this->request->getJsonVar('slug'),
            'writer' => $this->request->getJsonVar('writer'),
            'content' => $this->request->getJsonVar('content'),
            'category' => $this->request->getJsonVar('category'),
            'published_at' => $this->request->getJsonVar('published_at'),
            'status' => $this->request->getJsonVar('status'),
        ];
        $validate = $this->validation->run($data, 'update_artikel');
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