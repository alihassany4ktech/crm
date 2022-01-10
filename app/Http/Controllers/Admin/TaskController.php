<?php

namespace App\Http\Controllers\Admin;

use App\Exports\TaskExport;
use App\User;
use App\TaskCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Project;
use App\Task;
use Illuminate\Support\Facades\File;
use App\TaskFile;
use App\TaskLabel;
use App\TaskLabelList;
use App\TaskUser;
use Illuminate\Support\Facades\Response;
use Maatwebsite\Excel\Facades\Excel;

class TaskController extends Controller
{
    public function allTasks()
    {
        $tasks = Task::all();
        return view('dashboard.admin.task.all', compact('tasks'));
    }

    public function create()
    {
        $categories = TaskCategory::all();
        $employees = User::where('type', '=', 'Employee')->get();
        $projects = Project::all();
        $labelList = TaskLabelList::all();
        return view('dashboard.admin.task.create', compact('categories', 'employees', 'projects', 'labelList'));
    }

    public function showTask($id)
    {
        $task = Task::find($id);
        $labels = TaskLabelList::all();
        $assignees = User::doesntHave('assignee', 'and', function ($query) use ($id) {
            $query->where('task_id', $id);
        })->where('type', '=', 'Employee')->get();
        return view('dashboard.admin.task.show', compact('task', 'assignees', 'labels'));
    }



    public function taskAssigneesAdd(Request $request)
    {
        if ($request->ajax()) {
            $employeeList = $request->assignTo;

            for ($i = 0; $i < count($employeeList); $i++) {
                $assignee = new TaskUser();
                $assignee->user_id = $employeeList[$i];
                $assignee->task_id = $request->task_id;
                $assignee->save();
            }
            return response()->json(['success' => 'Assignee Add Succseefully!']);
        }
    }

    public function taskLabelAdd(Request $request)
    {
        if ($request->ajax()) {
            $labelList = $request->label;
            for ($i = 0; $i < count($labelList); $i++) {
                $member = new TaskLabel();
                $member->task_label_list_id = $labelList[$i];
                $member->task_id = $request->task_id;
                $member->save();
            }
            return response()->json(['success' => 'Label Add Succseefully!']);
        }
    }

    public function deleteTaskAssingnee($id)
    {
        $assignee = TaskUser::where('user_id', '=', $id)->first();
        $assignee->delete();
        $notification = array(
            'messege' => 'Task Assignee Deleted Successfully',
            'alert-type' => 'error'
        );
        return redirect()->back()->with($notification);
    }

    public function deleteTaskLabel($id)
    {
        $label = TaskLabel::where('task_label_list_id', '=', $id)->first();
        $label->delete();
        $notification = array(
            'messege' => 'Task Label Deleted Successfully',
            'alert-type' => 'error'
        );
        return redirect()->back()->with($notification);
    }

    public function taskStore(Request $request)
    {
        $request->validate([
            'project' => 'required',
            'task_category' => 'required',
            'title' => 'required',
            'description' => 'required',
            'start_date' => 'required',
            'duedate' => 'required',
            'assignTo' => 'required',
            'label' => 'required',
        ]);
        $employeeList = $request->assignTo;
        $labelList = $request->label;
        $task = new Task();
        $task->project_id = $request->project;
        $task->task_category_id = $request->task_category;
        $task->title = $request->title;
        $task->start_date = $request->start_date;
        $task->due_date = $request->duedate;
        $task->isPrivate = $request->make_private == 'on' ? 1 : 0;
        $task->billable = $request->billable == 'on' ? 1 : 0;
        if ($request->set_time == 'on') {
            $task->set_time = 1;
            $task->hour = $request->hour;
            $task->mins = $request->mnt;
        } else {
            $task->set_time = 0;
        }
        $task->priority = $request->priority_status;
        $task->status = $request->status;
        $task->description = $request->description;
        $task->save();
        for ($i = 0; $i < count($employeeList); $i++) {
            $member = new TaskUser();
            $member->user_id = $employeeList[$i];
            $member->task_id = $task->id;
            $member->save();
        }
        for ($i = 0; $i < count($labelList); $i++) {
            $member = new TaskLabel();
            $member->task_label_list_id = $labelList[$i];
            $member->task_id = $task->id;
            $member->save();
        }
        if ($request->hasFile('files')) {
            foreach ($request->file('files') as $fileData) {
                $file = new TaskFile();
                // $file->user_id = $this->user->id;
                $file->task_id = $task->id;
                $name = $fileData->getClientOriginalName();
                $file->filename = $name;
                $destinationPath = 'task_files/';
                $fileData->move($destinationPath, $name);
                $file->save();
            }
        }

        $notification = array(
            'messege' => 'Task Save Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    public function taskUpdate(Request $request)
    {
        $request->validate([
            'project' => 'required',
            'task_category' => 'required',
            'title' => 'required',
            'description' => 'required',
            'start_date' => 'required',
            'duedate' => 'required'
        ]);


        $task = Task::find($request->task_id);
        $task->project_id = $request->project;
        $task->task_category_id = $request->task_category;
        $task->title = $request->title;
        $task->start_date = $request->start_date;
        $task->due_date = $request->duedate;
        $task->isPrivate = $request->make_private == 'on' ? 1 : 0;
        $task->billable = $request->billable == 'on' ? 1 : 0;
        if ($request->set_time == 'on') {
            $task->set_time = 1;
            $task->hour = $request->hour;
            $task->mins = $request->mnt;
        } else {
            $task->set_time = 0;
        }
        $task->priority = $request->priority_status;
        $task->status = $request->status;
        $task->description = $request->description;
        $task->update();
        $notification = array(
            'messege' => 'Task Updated Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    public function editTask($id)
    {
        $task = Task::find($id);
        $categories = TaskCategory::all();
        $employees = User::where('type', '=', 'Employee')->get();
        $projects = Project::all();
        $labelList = TaskLabelList::all();
        return view('dashboard.admin.task.edit', compact('task', 'categories', 'employees', 'projects', 'labelList'));
    }

    public function deleteTask($id)
    {
        $task = Task::find($id);
        $task->delete();
        $notification = array(
            'messege' => 'Task Deleted Successfully',
            'alert-type' => 'error'
        );
        return redirect()->back()->with($notification);
    }

    public function categoryStore(Request $request)
    {
        if ($request->ajax()) {
            $category = new TaskCategory();
            $category->category_name = $request->category_name;
            $category->save();
            return response()->json(['success' => 'Category Saved Succseefully!']);
        }
    }

    public function deleteCategory(Request $request)
    {
        if ($request->ajax()) {
            $category =  TaskCategory::find($request->category_id);
            $category->delete();
            return response()->json(['success' => 'Category Deleted Succseefully!']);
        }
    }

    public function addTaskFile($id)
    {
        return view('dashboard.admin.task.addfile', compact('id'));
    }



    public function taskFileStore(Request $request)
    {

        if ($request->hasFile('files')) {
            foreach ($request->file('files') as $fileData) {
                $file = new TaskFile();
                // $file->user_id = $this->user->id;
                $file->task_id = $request->task_id;
                $name = $fileData->getClientOriginalName();
                $file->filename = $name;
                $destinationPath = 'task_files/';
                $fileData->move($destinationPath, $name);
                $file->save();
            }
            $notification = array(
                'messege' => 'File Uploaded Successfully',
                'alert-type' => 'success'
            );
            return redirect()->back()->with($notification);
        } else {
            if ($request->filename == null) {
                $notification = array(
                    'messege' => 'Choose Atleast One File or Enter File Name',
                    'alert-type' => 'error'
                );
                return redirect()->back()->with($notification);
            } else {
                $file = new TaskFile();
                $file->filename = $request->filename ? $request->filename : null;
                $file->link = $request->link;
                $file->task_id = $request->task_id;
                $file->save();
                $notification = array(
                    'messege' => 'File Link Add Successfully',
                    'alert-type' => 'success'
                );
                return redirect()->back()->with($notification);
            }
        }
    }

    public function deleteFile(Request $request)
    {
        $file = TaskFile::find($request->file_id);
        if (File::exists(public_path('task_files/' . $file->filename))) {
            File::delete(public_path('task_files/' . $file->filename));
            /*
                Delete Multiple File like this way
                Storage::delete(['task_files/test.png', 'task_files/test2.png']);
            */
            $file->delete();
            return response()->json(['success' => 'File Deleted Successfully!']);
        } else {
            return response()->json(['success' => 'File does not exists.']);
        }
    }

    public function downloadFile(Request $request)
    {
        $file = TaskFile::findOrFail($request->file_id);
        if (File::exists(public_path('task_files/' . $file->filename))) {
            return Response::download(public_path('task_files/' . $file->filename));
        } else {
            return response()->json(['success' => 'File does not exists.']);
        }
    }

    public function exportInToExcel()
    {
        return Excel::download(new TaskExport, 'taskList.xlsx');
    }

    public function exportInToCSV()
    {
        return Excel::download(new TaskExport, 'taskList.csv');
    }
}
