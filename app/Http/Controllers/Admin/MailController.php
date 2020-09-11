<?php

namespace App\Http\Controllers\Admin;

use App\Events\ClickNotify;
use App\Http\Controllers\Controller;
use App\Models\Mail as Model;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class MailController extends ControllerAbstract
{
    protected $viewFolder = 'pages.admin.mails';
    protected $routePrefix = 'mails';

    public function __construct(Model $model)
    {
        $this->model = $model;
        $this->title = 'ttdt.menu.mails';
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
     * @return Response
     */
    public function edit(Model $model)
    {
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
        return response()->json(['success' => false, 'message' => 'Không thế xóa']);
    }

    /**
     * @param string $mode
     * @param int $id
     * @return string[]
     */
    protected function getRules($mode = 'create', $id = null)
    {
        return [
            'body' => 'required',
            'header' => 'required',
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
        $model->header = $request->header;
        $model->body = $request->body;

        if ($mode === 'create') {
            $request->validate([
                'key' => 'required|unique:mails'
            ]);
            $model->key = $request->key;
            $model->created_at = now();
        }
        $model->updated_at = now();

        event(new ClickNotify('asd@asd', $model->key, 'Hoang Bảo'));

        return $model->save();
    }
}
