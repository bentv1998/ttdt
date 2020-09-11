<?php

namespace App\Http\Controllers\Admin;

use App\Models\Classes;
use App\Models\ParentModel;
use App\Models\Student as Model;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class StudentController extends ControllerAbstract
{
    protected $viewFolder = 'pages.admin.students';
    protected $routePrefix = 'students';

    public function __construct(Model $model)
    {
        $this->model = $model;
        $this->title = 'ttdt.list.student';

        $genders = User::GENDER;
        $classes = Classes::pluck('name', 'id');

        $compact = compact('genders', 'classes');
        $this->indexData = $compact;
        $this->createData = $compact;
        $this->editData = $compact;
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
        $model = Model::with(['parent', 'classes'])->where('id', $model->id)->first();
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
        return parent::handleDestroy($model);
    }

    /**
     * @param string $mode
     * @param int $id
     * @return string[]
     */
    protected function getRules($mode = 'create', $id = null)
    {
        $rules = [
            'name' => 'required',
            'gender' => 'required',
        ];

        if ($mode === 'create') {
            $rules['parent_id'] = 'required|exists:parents,id';
        }
        return $rules;
    }

    /**
     * @param Model $model
     * @param Request $request
     * @param string $mode
     * @return bool
     */
    protected function save($model, $request, $mode = 'create')
    {
        $model->image = $request->img ?? null;
        $model->name = $request->name;
        $model->birth = $request->birth;
        $model->gender = $request->gender;
        $model->updated_at = Carbon::now();

        if ($mode === 'create') {
            $model->created_at = Carbon::now();
            $model->code = "HS" . time();
            $model->parent_id = $request->parent_id;
        }
        $saved = $model->save();

        $requestClassIds = $request->classIds;
        DB::table('class_students')->where('student_id', $model->id)->delete();
        if ($requestClassIds) {
            foreach ($requestClassIds as $classId) {
                DB::table('class_students')->insert([
                    ['class_id' => $model->id, 'student_id' => $classId, 'updated_at' => Carbon::now(), 'created_at' => Carbon::now(), 'status' => 1],
                ]);
            }
        }

        return $saved;
    }

    protected function searchParent(Request $request)
    {
        $model = ParentModel::where('email', 'LIKE', "%$request->search%")->get();

        return \response()->json([
            'items' => $model
        ]);
    }
}
