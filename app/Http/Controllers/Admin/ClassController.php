<?php

namespace App\Http\Controllers\Admin;

use App\Models\Teacher;
use App\Models\Classes as Model;
use App\Models\Schedule;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ClassController extends ControllerAbstract
{
    protected $viewFolder = 'pages.admin.classes';
    protected $routePrefix = 'classes';

    public function __construct(Model $model)
    {
        $this->model = $model;
        $this->title = 'ttdt.menu.classes';
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
        if ($model->students()->exists()) {
            $message = __('ttdt.list.student') . ' ' . __('ttdt.exists');
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
            'name' => 'required|string|max:80',
            'tuition' => 'required|numeric|min:6',
            'schedule_id' => 'required',
            'teacher_id' => 'required'
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
        $model->tuition = $request->tuition;
        $model->schedule_id = $request->schedule_id;
        $model->teacher_id = $request->teacher_id;
        $model->code = "HS".time();
        $model->updated_at = now();

        if ($mode === 'create') {
            $model->created_at = now();
        }

        return $model->save();
    }

    public function searchTeacher(Request $request)
    {
        $model = Teacher::with(['classes', 'user'])
            ->whereDoesntHave('classes')
            ->whereHas('user', function ($q) use ($request) {
                $q->where('name', 'LIKE', "%$request->search%");
            })
            ->get();
        return \response()->json([
            'items' => $model
        ]);
    }

    public function searchSchedule(Request $request)
    {
        $model = Schedule::with(['classes'])
            ->whereDoesntHave('classes')
            ->where('name', 'LIKE', "%$request->search%")
            ->get();

        return \response()->json([
            'items' => $model
        ]);
    }
}
