<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Category as Model;
use function foo\func;

class CategoryController extends Controller
{
    protected $title;
    protected $model;
    protected $view = "pages.admin.categories.index";
    protected $routePrefix = 'categories';

    public function __construct(Model $model)
    {
        $this->model = $model;
        $this->title = 'ttdt.menu.categories';
    }

    public function index()
    {
        $routePrefix = $this->routePrefix;
        $title = __($this->title);
        $models = Category::with(['products' => function ($q){
                $q->orderByDesc('id')->take(4);
            }])
            ->paginate(10);

        return view($this->view, compact('routePrefix', 'title', 'models'));
    }

    public function show(Model $model)
    {
        $routePrefix = $this->routePrefix;
        $title = __($this->title) . ' ' . $model->name;
        $mode = 'show';
        $models = Model::with(['products'])->where('id', $model->id)->get();

        return view($this->view, compact('routePrefix', 'title', 'models', 'mode'));
    }

    public function create()
    {
        $mode = 'create';
        $routePrefix = $this->routePrefix;
        $title = __("ttdt.$mode") . " " . __($this->title);

        return response()->json(compact('mode', 'routePrefix', 'title'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required'
        ]);

        $model = new $this->model;
        $model->name = $request->name;
        $model->description = $request->description;
        $isSaved = $model->save();

        $this->flashToastr($isSaved);

        if ($isSaved) {
            return response()->redirectToRoute("$this->routePrefix.index");
        }
        else {
            return response()->redirectTo(url()->previous());
        }
    }

    public function edit(Model $model)
    {
        $mode = 'update';
        $routePrefix = $this->routePrefix;
        $title = __("ttdt.$mode") . " " . __($this->title);

        return response()->json(compact('mode', 'routePrefix', 'title', 'model'));
    }

    public function update(Request $request, Model $model)
    {
        $request->validate([
            'name' => 'required'
        ]);

        $model->name = $request->name;
        $model->description = $request->description;
        $isSaved = $model->save();

        $this->flashToastr($isSaved, 'update');

        if ($isSaved) {
            return response()->redirectToRoute("$this->routePrefix.index");
        }
        else {
            return response()->redirectTo(url()->previous());
        }
    }

    public function destroy(Model $model)
    {
        if ($model->products()->exists()) {
            return response()->json(['success' => false, 'message' => __('ttdt.list.product') . ' ' . __('ttdt.exists')]);
        }
        $deleted = $model->delete();
        $message = '';

        return response()->json(['success' => $deleted, 'message' => $message]);
    }

    protected function flashToastr(bool $isSaved, $mode = 'create')
    {
        if ($isSaved) {
            $message = "ttdt.message.success.{$mode}d";
            toastr()->success( __($this->title) . ' ' .  __($message));
        }
        else {
            toastr()->error(__($this->title) . ' ' .  __("ttdt.message.error.{$mode}d_fail"));
        }
    }
}
