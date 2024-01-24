<?php

namespace App\Models;

use CodeIgniter\Model;

class AdminAuthModel extends Model
{
    protected $table            = 'admin';
    protected $primaryKey       = 'id_admin';
    protected $allowedFields    = ['id_admin','username','password','level'];
    
    protected $useTimestamps = false;
}
