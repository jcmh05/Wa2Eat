<?php
namespace App\Models;

use CodeIgniter\Model;

class IngredientModel extends Model
{
    protected $table = 'ingredient';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true; # db takes care of it
    protected $returnType = 'object'; # 'object' or 'array'
    protected $useSoftDeletes = false; # true if you expect to recover data
# Fields that can be set during save, insert, or update methods
    protected $allowedFields = ['id', 'name', 'icon'];
    protected $useTimestamps = false; # no timestamps on inserts and updates
# Do not use validations rules (for the time being...)
    protected $validationRules = [];
    protected $validationMessages = [];
    protected $skipValidation = false;


    public function saveRecipe($id, $name, $icon)
    {
        $data = [
            'id' => $id,
            'name' => $name,
            'icon' => $icon,
        ];
        return $this->insert($data);
    }


}