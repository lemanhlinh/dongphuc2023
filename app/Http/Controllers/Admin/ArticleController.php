<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;
use App\DataTables\ArticleDataTable;
use App\DataTables\Scopes\ArticleDataTableScope;
use App\Repositories\Contracts\ArticleCategoryInterface;
use App\Repositories\Contracts\ArticleInterface;
use App\Http\Requests\Article\CreateArticle;
use App\Http\Requests\Article\UpdateArticle;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class ArticleController extends Controller
{
    protected $articleCategoryRepository;
    protected $articleRepository;

    public function __construct(ArticleCategoryInterface $articleCategoryRepository, ArticleInterface $articleRepository)
    {
        $this->middleware('auth');
        $this->articleCategoryRepository = $articleCategoryRepository;
        $this->articleRepository = $articleRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param ArticleDataTable $dataTable
     * @return \Illuminate\Http\Response
     */
    public function index(ArticleDataTable $dataTable)
    {
        $data = request()->all();
        $categories = $this->articleCategoryRepository->getAll();
        if ($categories->count() === 0){
            Session::flash('danger', 'Chưa có danh mục nào');
            return redirect()->route('admin.article-category.index');
        }
        return $dataTable->addScope(new ArticleDataTableScope())->render('admin.article.index', compact('data','categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = $this->articleCategoryRepository->getAll();
        return view('admin.article.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CreateArticle $req
     * @return \Illuminate\Http\Response
     */
    public function store(CreateArticle $req)
    {
        DB::beginTransaction();
        try {
            $data = $req->validated();
            $data['alias'] = $data['alias']?\Str::slug($data['alias'], '-'):\Str::slug($data['title'], '-');
            if (!empty($data['image'])){
                $data['image'] = $this->articleRepository->saveFileUpload($data['image'],'article');
            }
            $model = $this->articleRepository->create($data);
            DB::commit();
            Session::flash('success', trans('message.create_article_success'));
            return redirect()->route('admin.article.edit', $model->id);
        } catch (\Exception $ex) {
            DB::rollBack();
            \Log::info([
                'message' => $ex->getMessage(),
                'line' => __LINE__,
                'method' => __METHOD__
            ]);
            Session::flash('danger', trans('message.create_article_error'));
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $article = $this->articleRepository->getOneById($id);
        $categories = $this->articleCategoryRepository->getAll();
        return view('admin.article.update', compact('article','categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateArticle  $req
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id, UpdateArticle $req)
    {
        DB::beginTransaction();
        try {
            $data = $req->validated();
            $article = $this->articleRepository->getOneById($id);
            if (!empty($data['image']) && $article->image != $data['image']){
                if (File::exists(public_path($article->image))) {
                    Storage::delete(str_replace('storage','public',$article->image));
                }
                $data['image'] = $this->articleRepository->saveFileUpload($data['image'],'article');
            }
            if (empty($data['alias'])){
                $data['alias'] = $data['alias']?\Str::slug($data['alias'], '-'):\Str::slug($data['title'], '-');
            }
            $article->update($data);
            DB::commit();
            Session::flash('success', trans('message.update_article_success'));
            return redirect()->route('admin.article.edit', $id);
        } catch (\Exception $exception) {
            \Log::info([
                'message' => $exception->getMessage(),
                'line' => __LINE__,
                'method' => __METHOD__
            ]);
            Session::flash('danger', trans('message.update_article_error'));
            return back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = $this->articleRepository->getOneById($id);
        Storage::delete(str_replace('storage','public',$data->image));
        $this->articleRepository->delete($id);

        return [
            'status' => true,
            'message' => trans('message.delete_article_success')
        ];
    }

    /**
     * @param $id
     * @return array
     */
    public function changeActive($id)
    {
        $article = Article::findOrFail($id);
        $article->update(['active' => !$article->active]);
        return [
            'status' => true,
            'message' => trans('message.change_active_article_success')
        ];
    }

    /**
     * @param $id
     * @return array
     */
    public function changeIsHome($id)
    {
        $article = Article::findOrFail($id);
        $article->update(['is_home' => !$article->is_home]);
        return [
            'status' => true,
            'message' => trans('message.change_active_article_success')
        ];
    }
}
