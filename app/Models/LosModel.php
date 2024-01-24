<?php

namespace App\Models;

use CodeIgniter\Model;

class LosModel extends Model
{
    protected $table            = 'los';
    protected $primaryKey       = 'id';
    protected $allowedFields    = ['id','los','coordinate'];
    
    protected $useTimestamps = false;
}