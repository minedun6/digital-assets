<?php

namespace App\Observers;

use App\Enums\AssetType;
use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;

class AssetObserver
{
    public function creating(Model $model)
    {
        $model->uuid = Uuid::uuid4()->toString();
        if ($model->type_id != AssetType::Folder['value']) {
            $model->text = $model->text . '.' . $model->extension;
        }
    }
}
