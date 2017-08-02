<?php

use Illuminate\Database\Seeder;

use  Quarx\Modules\Blogcategories\Models\Blogcategory;
use Yab\Quarx\Models\Images;
use Illuminate\Support\Facades\Storage;
use Yab\Quarx\Services\FileService;
use Yab\Quarx\Services\CryptoService;

class BlogImageSeeder extends Seeder
{
    public function getImg($url) {
        $headers[] = 'Accept: image/gif, image/x-bitmap, image/jpeg, image/pjpeg';
        $headers[] = 'Connection: Keep-Alive';
        $headers[] = 'Content-type: application/x-www-form-urlencoded;charset=UTF-8';
        $useragent = 'php';
        $process = curl_init($url);
        curl_setopt($process, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($process, CURLOPT_HEADER, 0);
        curl_setopt($process, CURLOPT_USERAGENT, $useragent);
        curl_setopt($process, CURLOPT_TIMEOUT, 30);
        curl_setopt($process, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($process, CURLOPT_FOLLOWLOCATION, 1);
        $return = curl_exec($process);
        curl_close($process);
        return $return;
    }

    public function deleteFiles($directory) {
        $files = Storage::files($directory);
        Storage::delete($files);
    }

    public function encryptFilename($name)
    {
        $enc = md5(uniqid($name, true)) . '.' . "jpg";
        return $enc;
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Images::truncate();

        $this->deleteFiles('public/images');

        $faker = \Faker\Factory::create();

        factory(Images::class, 5)->create()->each(
            function($image) use($faker) {

                $imgUrl = $faker->imageUrl($width = 600, $height = 400);
                $imageName= basename($imgUrl);
                $imageNameEnc=$this->encryptFilename($imageName);
                $contents = $this->getImg($imgUrl);
                Storage::disk('public')->put('images/'.$imageNameEnc, $contents);

                $image->location = 'images/'.$imageNameEnc;
                $image->original_name = $imgUrl;
                $image->save();
            }
        );
    }
}
