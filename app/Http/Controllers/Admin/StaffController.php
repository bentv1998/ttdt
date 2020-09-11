<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Staff as Model;
use App\Services\UserService;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class StaffController extends ControllerAbstract
{
    protected $viewFolder = 'pages.admin.staffs';
    protected $routePrefix = 'staffs';

    public function __construct(Model $model)
    {
        $this->model = $model;
        $this->title = 'ttdt.list.staff';

        $genders = User::GENDER;

        $compact = compact('genders');
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
        UserService::destroy($model->user_id);
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
            'email' => 'required',
            'gender' => 'required',
        ];

        if ($mode === 'update') {
            $rules['phone'] = "required|numeric|unique:staffs,phone,$id";
        }
        else {
            $rules['phone'] = "required|numeric|unique:staffs,phone";
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
        $user = UserService::save($request, $mode, $model);

        $model->phone = $request->phone;
        $model->birth = $request->birth;
        $model->gender = $request->gender;
        $model->updated_at = Carbon::now();

        if ($mode === 'create') {
            $model->created_at = Carbon::now();
            $model->code = "PH" . time();
            $model->user_id = $user->id;
        }

        return $model->save();
    }
}
