<?php

namespace App\Observers;

use App\Enums\AssetType;
use Illuminate\Database\Eloquent\Model;

class AssetObserver
{
    public function creating(Model $model)
    {
        if ($model->type_id != AssetType::Folder['value']) {
            $model->text = $model->text . '.' . $model->extension;
        }
    }
}
