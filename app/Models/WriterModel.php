<?php

namespace App\Models;

use CodeIgniter\Model;

class WriterModel extends Model
{
    protected $table      = 'writer';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;
    protected $allowedFields = ['name', 'slug', 'created_at', 'updated_at', 'status'];
}