<?php

namespace App\Models;

use CodeIgniter\Model;

class CharactersModel extends Model
{
    protected $table            = 'characters';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['name', 'thumbnail', 'description'];

    protected bool $allowEmptyInserts = false;

    // Dates
    protected $useTimestamps = true; 
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at'; 
}
