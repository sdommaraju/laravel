<?php 

namespace App\Http\Transformers;

use League\Fractal\TransformerAbstract;
use App\Http\Models\Designation;


class DesignationTransformer extends TransformerAbstract {
    public function transform(Designation $designation) {
        return [
            'id' => $designation->designation_master_id,
            'name' => $designation->name
        ];
    }
}