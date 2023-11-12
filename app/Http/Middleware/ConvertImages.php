<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
use App\Models\Product;

class ConvertImages
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);

        // Kiểm tra nếu response là ảnh và chưa phải là WebP
        if ($response->isSuccessful() && $response->headers->get('content-type') && !str_contains($response->headers->get('content-type'), 'webp')) {
            $content = $response->getContent();
            $path = public_path($request->getPathInfo());
            if (!file_exists($path)) {
                return $response;
            }
            $image = Image::make($content);

            // Kiểm tra model và thay đổi kích thước ảnh tương ứng
            $model = $this->getModelFromPath($request->getPathInfo());
            $this->resizeImage($image, $model);

            $response->headers->set('Content-Type', 'image/webp');
            $response->setContent($image);

            // Lưu ảnh WebP vào thư mục cache
            $path = public_path('cache/webp/' . md5($request->getPathInfo()) . '.webp');
            File::put($path, $image->stream()->getContents());
        }

        return $response;
    }

    protected function getModelFromPath($path)
    {
        // Xử lý logic để xác định model từ đường dẫn URL
        // Ví dụ: chia dựa trên các phần tử của đường dẫn URL
        $pathElements = explode('/', $path);

        // Lấy phần tử liên quan đến model, ví dụ, phần tử thứ 2
        $modelName = $pathElements[2];

        // Lấy ra model từ tên
        $model = app("App\\Models\\{$modelName}");

        return $model;
    }

    protected function resizeImage($image, $model)
    {
        // Xử lý logic để xác định kích thước ảnh dựa trên model
        // Ví dụ: lấy kích thước từ thuộc tính của model
        $size = $model->image_size ?? 'default';

        // Thực hiện resize dựa trên kích thước xác định
        switch ($size) {
            case 'small':
                $image->fit(100, 100);
                break;
            case 'medium':
                $image->fit(300, 300);
                break;
            // Thêm các case khác nếu cần
            default:
                // Kích thước mặc định
                $image->fit(200, 200);
                break;
        }
    }
}
