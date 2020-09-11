<?php

namespace App\Http\Controllers\Admin;

use App\Events\ClickNotify;
use App\Http\Controllers\Controller;
use App\Mail\SendMail;
use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

abstract class ControllerAbstract extends Controller
{
    protected $model;

    protected $viewFolder;
    protected $routePrefix;
    protected $title;

    protected $indexData = [];
    protected $createData = [];
    protected $editData = [];

    public function index()
    {
        $routePrefix = $this->routePrefix;
        $title = __('ttdt.menu.list') . " " . __($this->title);

        return view("$this->viewFolder.list", array_merge(
            compact('routePrefix', 'title'),
            $this->indexData
        ));
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function datatable(Request $request)
    {
        $query = $request->post('query', []);
        $pagination = $request->post('pagination', []);
        $sort = $request->post('sort', []);

        return response()->json($this->model::fetchDatatable($query, $pagination, $sort));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $mode = 'create';
        $routePrefix = $this->routePrefix;
        $title = __('ttdt.create') . " " . __($this->title);

        return response()->view("$this->viewFolder.edit", array_merge(
            compact('mode', 'routePrefix', 'title'),
            $this->createData
        ));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate($this->getRules());

        $model = new $this->model;
        $isSaved = $this->save($model, $request);

        $this->flashToastr($isSaved);

        if ($isSaved) {
            return response()->redirectToRoute("$this->routePrefix.index");
        }
        else {
            return response()->redirectTo(url()->previous());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param Model $model
     * @return RedirectResponse
     */
    public function handleShow(Model $model)
    {
        return response()->redirectToRoute("$this->routePrefix.edit", $model);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param $model
     * @return Response
     */
    protected function handleEdit(Model $model)
    {
        $mode = 'update';
        $routePrefix = $this->routePrefix;
        $title = __('ttdt.edit') . " " . __($this->title);

        return response()->view("$this->viewFolder.edit", array_merge(
            compact('model', 'mode', 'routePrefix', 'title'),
            $this->editData
        ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Model $model
     * @return RedirectResponse
     */
    public function handleUpdate(Request $request, Model $model)
    {
        $mode = 'update';
        $request->validate($this->getRules($mode, $model->id));
        $isSaved = $this->save($model, $request, $mode);

        $this->flashToastr($isSaved, $mode);

        if ($isSaved) {
            return response()->redirectToRoute("$this->routePrefix.index");
        }
        else {
            return response()->redirectTo(url()->previous());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Model $model
     * @return JsonResponse
     * @throws Exception
     */
    public function handleDestroy(Model $model)
    {
        $deleted = $model->delete();
        $message = '';

        return response()->json(['success' => $deleted, 'message' => $message]);
    }

    /**
     * @param bool $isSaved
     * @param string $mode
     */
    protected function flashToastr(bool $isSaved, $mode = 'create')
    {
        if ($isSaved) {
            toastr()->success( __($this->title) . ' ' .  __("ttdt.message.success.{$mode}d"));
        }
        else {
            toastr()->error(__($this->title) . ' ' .  __("ttdt.message.error.{$mode}d_fail"));
        }
    }

    /**
     * @param string $mode
     * @param int $id
     * @return string[]
     */
    abstract protected function getRules($mode = 'create', $id = null);

    /**
     * @param Model $model
     * @param Request $request
     * @param string $mode
     * @return bool
     */
    abstract protected function save(Model $model, Request $request, $mode = 'create');
}
