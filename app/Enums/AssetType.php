<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

final class AssetType extends Enum
{
    const Folder = [
        'value' => 2,
        'extensions' => []
    ];
    const Zip = [
        'value' => 3,
        'extensions' => ["zip", "rar"]
    ];
    const Pdf = [
        'value' => 4,
        'extensions' => ["pdf"]
    ];
    const Word = [
        'value' => 5,
        'extensions' => ["doc", "docx"]
    ];
    const Ppt = [
        'value' => 6,
        'extensions' => ["ppt", "pptx"]
    ];
    const Excel = [
        'value' => 7,
        'extensions' => ["xls", "xlsx"]
    ];
    const Video = [
        'value' => 8,
        'extensions' => ["avi", "flv", "mkv", "mov", "mp4", "mpeg", "wmv"]
    ];
    const Image = [
        'value' => 9,
        'extensions' => ["jpg", "jpeg", "png", "gif"]
    ];
    const Txt = [
        'value' => 10,
        'extensions' => ["txt", "keynote", "key", "csv"]
    ];
}
