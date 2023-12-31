<?php

namespace App\Console\Commands;

use App\Models\Article;
use App\Models\Partner;
use App\Models\Product;
use App\Models\Sliders;
use App\Models\Student;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

class ConvertImagesToWebP extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'images:convert-webp';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Convert all images to WebP format';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $images = Product::select('id','image')->where('updated_at','>','2023-09-04 00:00:00')->get();

        foreach ($images as $image) {
            if ($image->image){
                $path = public_path($image->image);
                $urlPath = pathinfo($image->image, PATHINFO_DIRNAME);
                $webpPath = public_path($urlPath.'/'.pathinfo($image->image, PATHINFO_FILENAME) . '.webp');
//                $webpPath2 = public_path($urlPath.'/'.pathinfo($image->image, PATHINFO_FILENAME) . '-small.webp');

                if (File::exists($path)) {
                    //for slider
//                    $thumbnail = Image::make($path)->resize(1920, null,function ($constraint) {
//                        $constraint->aspectRatio();
//                    })->encode('webp', 75);
//
//                    $thumbnail_small = Image::make($path)->resize(600, null,function ($constraint) {
//                        $constraint->aspectRatio();
//                    })->encode('webp', 75);
//                    $thumbnail->save($webpPath);
//                    $thumbnail_small->save($webpPath2);

                    $thumbnail = Image::make($path)->resize(400, null,function ($constraint) {
                        $constraint->aspectRatio();
                    })->encode('webp', 75);
                    $thumbnail->save($webpPath);

                    $this->info('Converted: ' . $image->image);
                } else {
                    $this->warn('Image not found: ' . $image->image);
                }
            }

        }
    }
}
