<?php

namespace App\Models;

use CodeIgniter\Model;

class OfficerModel extends Model
{
    protected $table            = 'officers';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $allowedFields    = ['name', 'designation', 'office', 'email', 'phone_office', 'mobile', 'photo_url', 'sort_order'];
    protected $useTimestamps    = true;
}
