<?php

namespace App\Models;

use CodeIgniter\Model;

class HomeSectionModel extends Model
{
    protected $table            = 'home_sections';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $allowedFields    = ['section_key', 'title', 'content', 'type', 'position', 'sort_order', 'is_active'];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    public function getBySectionKey(string $key)
    {
        return $this->where('section_key', $key)->first();
    }
}
