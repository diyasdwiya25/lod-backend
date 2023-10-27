<?php

namespace App\Models;

use CodeIgniter\Model;

class ArtikelModel extends Model
{
    protected $table      = 'artikel';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;
    protected $allowedFields = ['title', 'slug', 'writer', 'content', 'category', 'published_at', 'created_at', 'updated_at', 'status'];

    public function get_all_join()
    {
        $db = \Config\Database::connect();
        $builder = $db->table('artikel');
        $builder->select('
          artikel.id, artikel.title, artikel.slug, writer.name AS writer, artikel.content, category.name AS category, published_at, artikel.status,
        ');
        $builder->join('writer', 'artikel.writer = writer.id');
        $builder->join('category', 'artikel.category = category.id');
        return $builder->get()->getResult();
    }

    public function find_join_slug($slug)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('artikel');
        $builder->select('
          artikel.id, artikel.title, artikel.slug, writer.name AS writer, artikel.content, category.name AS category, published_at, artikel.status,
        ');
        $builder->join('writer', 'artikel.writer = writer.id');
        $builder->join('category', 'artikel.category = category.id');
        $builder->where('artikel.slug', $slug);
        return $builder->get()->getRow();
    }
}