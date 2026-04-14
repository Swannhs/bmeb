<?php

namespace App\Models;

use CodeIgniter\Model;

class CmsPageModel extends Model
{
    protected $table            = 'cms_pages';
    protected $primaryKey       = 'id';
    protected $returnType       = 'array';
    protected $useAutoIncrement = true;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'route_key',
        'route_path',
        'query_string',
        'section',
        'slug',
        'title',
        'html_content',
        'source_path',
        'source_type',
        'status',
    ];
    protected $useTimestamps = true;
}
