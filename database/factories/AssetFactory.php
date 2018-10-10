<?php

use App\Enums\AssetIcon;
use App\Enums\UserType;
use App\LibraryFile;
use App\User;
use Faker\Generator as Faker;
use App\Enums\AssetType;

$factory->define(LibraryFile::class, function (Faker $faker) {
    return [
        'parent_id' => null,
        'text' => $faker->words(rand(1, 3)),
        'url' => null,
        'level' => 0,
        'icon' => 'icon',
        'type_id' => rand(2, 10),
        'extension' => 'xxxx',
        'mime_type' => 'xxx',
        'folder_flag' => 0,
        'is_deletable' => true
    ];
});

// making a deletetable asset
$factory->state(LibraryFile::class, 'deletable', [
    'is_deletable' => true
]);

// making a non-deletetable asset
$factory->state(LibraryFile::class, 'non-deletable', [
    'is_deletable' => false
]);

foreach (AssetType::getKeys() as $key => $type) {
    $factory->state(LibraryFile::class, strtolower($type), [
        'type_id' => AssetType::getValue($type)['value'],
        'icon' => AssetIcon::getValue($type),
        'extension' => $extension =
                                    collect(AssetType::getValue($type)['extensions'])->isNotEmpty()
                                    ? collect(AssetType::getValue($type)['extensions'])->random()
                                    : null,
        'mime_type' => !is_null($extension) ? config('mime.' . $extension) : null
    ]);
}
