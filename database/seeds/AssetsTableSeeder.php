<?php

use App\Enums\AssetType;
use App\LibraryFile;
use App\User;
use Illuminate\Database\Seeder;

class AssetsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->generateRandomTreeStructure();
    }

    private function generateRandomTreeStructure()
    {
        User::all()->each(function ($user) {

            $folders = LibraryFile::where([
                'is_deletable' => true,
                'type_id' => AssetType::Folder['value']
            ])->get();

            $start = rand(50, 100);
            $end = rand($start, (100 + $start));

            foreach (range($start, $end) as $index) {
                $parent = $folders->isEmpty() ? $user->personalFolder : $folders->random();
                factory(LibraryFile::class)->states('deletable', $type = strtolower(AssetType::getRandomKey()))->create([
                    'user_id' => $user->id,
                    'parent_id' => $parent->id,
                    'text' => uniqid($type == 'folder' ? 'folder_' : 'file_'),
                    'level' => $parent->level + 1
                ]);
            }

        });
    }

}
