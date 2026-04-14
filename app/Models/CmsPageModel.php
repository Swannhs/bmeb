<?php

namespace App\Models;

use CodeIgniter\Model;

class CmsPageModel extends Model
{
    protected $table            = 'cms_pages';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $allowedFields    = [
        'route_key', 'route_path', 'query_string', 'section', 
        'slug', 'title', 'html_content', 'source_path', 
        'source_type', 'status'
    ];
    protected $useTimestamps    = true;

    public function getByRouteKey(string $key)
    {
        return $this->where('route_key', $key)->first();
    }
}
