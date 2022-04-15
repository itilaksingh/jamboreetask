<?php 
namespace App\Models;
use CodeIgniter\Model;

class TaskModel extends Model
{
    protected $table = 'task';
    protected $primaryKey = 'id';
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';    
    protected $allowedFields = ['title', 'description','completed','due_date', 'user_id'];
}