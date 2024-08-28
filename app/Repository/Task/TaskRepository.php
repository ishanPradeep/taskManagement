<?php

namespace App\Repository\Task;

use App\Helpers\Helper;
use App\Http\Resources\Task\TaskCollection;
use App\Http\Resources\Task\TaskResource;
use App\Models\Task;
use App\Repository\Task\Interface\TaskRepositoryInterface;
use Illuminate\Http\Response;

class TaskRepository implements TaskRepositoryInterface
{

    public function all($request)
    {

        if($request->input('all', '') == 1) {
            $task_list = Task::all();
        } else if($request->input('title')){
            $task_list = Task::where('name', 'LIKE', "%{$request->title}%")
                ->orderBy('created_at', 'desc')->paginate(10);
        }else if($request->input('sortBy')){
            $task_list = Task::orderBy('created_at', 'desc')->paginate(10);
        }else {
            $task_list = Task::orderBy('created_at', 'desc')->paginate(10);
    }

        if (count($task_list) > 0) {
            return new TaskCollection($task_list);
        } else {
            return Helper::error(Response::$statusTexts[Response::HTTP_NO_CONTENT], Response::HTTP_NO_CONTENT);
        }
    }

    public function store($request)
    {
        $task = new Task();
        $task->name = $request->name;
        $task->status = $request->status;
        $task->user_id = $request->user_id;
        if ($task->save()) {
            return new TaskResource($task);
        } else {
            return Helper::error(Response::$statusTexts[Response::HTTP_NO_CONTENT], Response::HTTP_NO_CONTENT);
        }
    }

    public function update($request)
    {
        $task = Task::find($request->id);
        $task->name = $request->name;
        $task->status = $request->status;
        if ($task->update()) {
            return new TaskResource($task);
        } else {
            return Helper::error(Response::$statusTexts[Response::HTTP_NO_CONTENT], Response::HTTP_NO_CONTENT);
        }
    }

    public function delete($id)
    {
        $task = Task::find($id);
        if ($task->delete()) {
            return Helper::success(Response::$statusTexts[Response::HTTP_NO_CONTENT], Response::HTTP_NO_CONTENT);
        } else {
            return Helper::error(Response::$statusTexts[Response::HTTP_NO_CONTENT], Response::HTTP_NO_CONTENT);
        }
    }

    public function statusChange($request)
    {
        $task = Task::find($request->id);
        $task->status = $request->status;

        if ($task->update()) {
            return new TaskResource($task);
        } else {
            return Helper::error(Response::$statusTexts[Response::HTTP_NO_CONTENT], Response::HTTP_NO_CONTENT);
        }
    }

    public function calculationPercentage()
    {
        $task_list = Task::get();
        $completed_list = Task::where('status','completed')->get();
        $completed_tot = count($completed_list);
        $total = count($task_list);

        $percent = $completed_tot / $total * 100;

        if ($percent) {
            return response()->json($percent, 201);
        } else {
            return Helper::error(Response::$statusTexts[Response::HTTP_NO_CONTENT], Response::HTTP_NO_CONTENT);
        }
    }
}
