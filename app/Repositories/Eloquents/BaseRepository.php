<?php

namespace App\Repositories\Eloquents;

use App\Repositories\Contracts\BaseInterface;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

abstract class BaseRepository implements BaseInterface
{
    protected $model;

    /**
     * BaseRepository constructor.
     */
    public function __construct()
    {
        $this->model = app($this->getModelClass());
    }

    /**
     * @return string
     */
    public abstract function getModelClass(): string;

    /**
     * @param int $id
     * @param array $relationships
     * @return mixed
     */
    public function getOneById(int $id, array $relationships = [])
    {
        return $this->model->with($relationships)->findOrFail($id);
    }

    /**
     * @param string $slug
     * @param array $relationships
     * @return mixed
     */
    public function getOneBySlug(string $slug, array $relationships = [])
    {
        return $this->model->with($relationships)->where(['alias' => $slug])->first();
    }

    /**
     * @param array $ids
     * @return \Illuminate\Support\Collection
     */
    public function getByIds(array $ids): Collection
    {
        return $this->model->whereIn($this->model->getKeyName(), $ids)->get();
    }

    /**
     * @return Collection
     */
    public function getAll(): Collection
    {
        return $this->model->all();
    }

    /**
     * @param array $attributes
     * @return mixed
     */
    public function create(array $attributes)
    {
        return $this->model->create($attributes);
    }

    /**
     * @param int $id
     * @param array $attributes
     * @return mixed
     */
    public function update(int $id, array $attributes)
    {
        return $this->model->whereId($id)->update($attributes);
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function delete(int $id)
    {
        return $this->model->destroy($id);
    }

    /**
     * @param int $limit
     * @param array $columns
     * @param array $relationships
     * @return mixed
     */
    public function paginate(int $limit, array $columns = ['*'], array $where = [], array $relationships = [])
    {
        return $this->model->select($columns)->where($where)->orderBy('id', 'DESC')->latest()->with($relationships)->paginate($limit ?? config('data.limit', 20));
    }

    /**
     * @return Collection
     */
    public function getWithDepth() : Collection
    {
        return $this->model->withDepth()->defaultOrder()->get();
    }

    /**
     * @param array $where
     * @param array $columns
     * @param array $relationships
     * @param int $limit
     * @return mixed
     */
    public function getList(array $where = null, array $columns = ['*'], int $limit = null, array $relationships = [])
    {
        $query = $this->model->select($columns);

        if($where){
            foreach($where as $key => $value){
                if (gettype($value) === 'array'){
                    $query->where($key, $value[1], $value[0]);
                }else{
                    $query->where($key, $value);
                }

            }
        }
        if (!empty($limit)){
            $query->limit($limit);
        }

        if ($limit == 1){
            return $query->with($relationships)->first();
        }

        return $query->with($relationships)->orderBy('id', 'DESC')->get();
    }

    /**
     * @param string $file
     * @param string $nameModule
     * @return string
     */
    public function saveFileUpload(string $file, string $nameModule)
    {
        $cyear = date('Y');
        $cmonth = date('m');
        $cday = date('d');
        $img_folder = $nameModule.'/'.$cyear.'/'.$cmonth.'/'.$cday.'/';

        $fileNameWithoutExtension = urldecode(pathinfo($file, PATHINFO_FILENAME));
        $fileName = $fileNameWithoutExtension. '_'.time().'.webp';
        $fileName_small = $fileNameWithoutExtension. '_'.time().'-small.webp';

        if ($nameModule == 'slider'){
            $thumbnail = Image::make(public_path($file))->resize(1350, null,function ($constraint) {
                $constraint->aspectRatio();
            })->encode('webp', 75);
            $thumbnailPath = 'storage/'.$img_folder.$fileName;

            $thumbnail_small = Image::make(public_path($file))->resize(412, null,function ($constraint) {
                $constraint->aspectRatio();
            })->encode('webp', 75);
            $thumbnailPath_small = 'storage/'.$img_folder.$fileName_small;

            Storage::makeDirectory('public/'.$img_folder);
            $thumbnail->save($thumbnailPath);
            $thumbnail_small->save($thumbnailPath_small);

        }else{
            $thumbnail = Image::make(public_path($file))->resize(400, null,function ($constraint) {
                $constraint->aspectRatio();
            })->encode('webp', 75);
            $thumbnailPath = 'storage/'.$img_folder.$fileName;
            Storage::makeDirectory('public/'.$img_folder);
            $thumbnail->save($thumbnailPath);
        }


        return urldecode('/'.$thumbnailPath);
    }
}
