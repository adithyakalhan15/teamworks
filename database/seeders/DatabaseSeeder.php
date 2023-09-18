<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Author;
use App\Models\Publication;
use \Hash;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        
        //sample user
        try {
            //code...
            $user = new User();
            $user->first_name = "Test";
            $user->last_name = "User";
            $user->email = "example@abc.com";
            $user->password = Hash::make("Abcd@1234");
            $user->bio = "This is a test user";
            $user->save();
            echo "User created successfully\n";
        } catch (\Throwable $th) {
            //throw $th;
            echo $th->getMessage();
        }
        
        

        //sample admin
        try {
            //code...
            $user = new User();
            $user->first_name = "Test";
            $user->last_name = "Admin";
            $user->email = "admin@abc.com";
            $user->password = Hash::make("Abcd@1234");
            $user->bio = "This is a test admin";
            $user->role = User::ROLE_ADMIN;
            $user->save();
            echo "Admin created successfully\n";
        } catch (\Throwable $th) {
            //throw $th;
            echo $th->getMessage();
        }

        //add publication
        try {
            $user = User::get()->first();

            $path = __DIR__ . DIRECTORY_SEPARATOR . "document_samples" . DIRECTORY_SEPARATOR;
            $samples = json_decode(file_get_contents($path . "sample_publications.json"), true);
            foreach ($samples as $sample) {
                $p = new Publication();
                $p->title = $sample["title"];
                $p->owner_id = $user->_id;
                $aus = [];
                foreach ($sample['authors'] as $aut) {
                    # code...
                    $author = new Author();
                    $author->first_name = $aut["first_name"];

                    if (isset($aut["middle_name"]))
                        $author->middle_name = $aut["middle_name"];

                    $author->last_name = $aut["last_name"];
                    $author->save();
                    $aus[] = $author->_id; //append author id to the publication
                }
                $p->author_id = $aus;

                $p->type = Publication::TYPE_ARTICLE;
                $p->content = file_get_contents($path . $sample["content"]);
                
                $p->resources = $sample["resources"];
                $p->download_resources = $sample["download_resources"];
                
                $p->visibility = Publication::VISIBILITY_PUBLIC;
                $p->save();
            }
        } catch (\Throwable $th) {
            //throw $th;
            echo $th->getMessage();
        }

    }
}
