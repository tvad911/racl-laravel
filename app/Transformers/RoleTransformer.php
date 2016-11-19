<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Models\Acl\Role;

/**
 * Class RoleTransformer
 * @package namespace App\Transformers\Backend;
 */
class RoleTransformer extends TransformerAbstract
{

    /**
     * Transform the \Role entity
     * @param \Role $model
     *
     * @return array
     */
    public function transform(Role $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
