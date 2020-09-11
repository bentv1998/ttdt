<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use App\Models\Product as Model;
use App\Services\UploadService;
use Carbon\Carbon;
use App\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Http\Request;

class ProductController extends ControllerAbstract
{
    protected $viewFolder = 'pages.admin.products';
    protected $routePrefix = 'products';

    public function __construct(Model $model)
    {
        $this->model = $model;
        $this->title = 'ttdt.list.product';
    }

    public function index()
    {
        return \response()->redirectToRoute('categories.index');
    }

    /**
     * @param Request $request
     * @return RedirectResponse|Response
     */
    public function create()
    {
        $categoryId = \request()->category_id ?? null;
        $category = Category::find($categoryId);
        if (!$category) {
            toastr()->error(__('ttdt.fail'));
            return \response()->redirectToRoute('categories.index');
        }
        $mode = 'create';
        $routePrefix = $this->routePrefix;
        $title = __('ttdt.create') . " " . __($this->title);

        return response()->view("$this->viewFolder.edit", array_merge(
            compact('mode', 'routePrefix', 'title', 'category'),
            $this->createData
        ));
    }

    /**
     * Display the specified resource.
     *
     * @param Model $model
     * @return RedirectResponse
     */
    public function show(Model $model)
    {
        return parent::handleShow($model);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Model $model
     * @return RedirectResponse|Response
     */
    public function edit(Model $model)
    {
        $categoryId = $model->category_id;
        $category = Category::find($categoryId);
        if (!$category) {
            toastr()->error(__('ttdt.fail'));
            return \response()->redirectToRoute('categories.index');
        }
        $this->editData = compact('category');
        return parent::handleEdit($model);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Model $model
     * @return RedirectResponse
     */
    public function update(Request $request, Model $model)
    {
        return parent::handleUpdate($request, $model);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Model $model
     * @return JsonResponse
     * @throws \Exception
     */
    public function destroy(Model $model)
    {
        $deleted = $model->delete();
        $message = '';

        if ($deleted && $model->img) {
            unlink(public_path($model->img));
        }
        return response()->json(['success' => $deleted, 'message' => $message]);
    }

    /**
     * @param string $mode
     * @param int $id
     * @return string[]
     */
    protected function getRules($mode = 'create', $id = null)
    {
        return [
            'name' => 'required',
            'price' => 'required|numeric|min:0',
            'discount' => 'numeric|min:0',
            'sku' => 'numeric|min:0',
            'category_id' => 'required|exists:categories,id',
        ];
    }

    /**
     * @param Model $model
     * @param Request $request
     * @param string $mode
     * @return bool
     */
    protected function save($model, $request, $mode = 'create')
    {
        $model->name = $request->name;
        $model->sku = $request->sku;
        $model->price = $request->price;
        $model->discount = $request->discount;
        if ($request->file) {
            $model->img = UploadService::decodeBase64($request->img, $request->file, 'media/products');;
        }
        $model->description = $request->description;
        $model->updated_at = Carbon::now();

        if ($mode === 'create') {
            $model->created_at = Carbon::now();
            $model->code = "SP" . time();
            $model->category_id = $request->category_id;
        }

        return $model->save();
    }
}
