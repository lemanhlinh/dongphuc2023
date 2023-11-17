<?php

namespace App\Console\Commands;

use App\Models\Product;
use App\Models\Sliders;
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
        $images = Sliders::select('id','image')->get();

        foreach ($images as $image) {
            $path = public_path($image->image);
            $webpPath = public_path(pathinfo($image->image, PATHINFO_FILENAME) . '.webp');

            if (File::exists($path)) {
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
