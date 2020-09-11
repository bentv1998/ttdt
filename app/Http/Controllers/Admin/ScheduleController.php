<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Schedule as Model;
use App\Models\Teacher;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ScheduleController extends ControllerAbstract
{
    protected $viewFolder = 'pages.admin.schedules';
    protected $routePrefix = 'schedules';

    public function __construct(Model $model)
    {
        $this->model = $model;
        $this->title = 'ttdt.menu.schedules';
        $dates = Model::DAY_OF_WEEK;

        $this->indexData = compact('dates');
        $this->createData = compact('dates');
        $this->editData = compact('dates');
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
        $deleted = false;
        if ($model->classes()->exists()) {
            $message = __('ttdt.list.class') . ' ' . __('ttdt.exists');
        }
        else {
            $deleted = $model->delete();
            $message = '';
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
            'time' => 'required|date_format:H:i',
            'day' => 'required',
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
        $model->time = $request->time;
        $model->day = json_encode($request->day);

        if ($mode === 'create') {
            $model->created_at = now();
        }
        $model->updated_at = now();

        return $model->save();
    }
}
