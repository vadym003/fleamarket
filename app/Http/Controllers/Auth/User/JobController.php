<?php

namespace App\Http\Controllers\Auth\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Job;
use App\Models\User;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class JobController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jobs = DB::table('jobs')
            ->join('users', 'users.id','=','jobs.user_id')
            // ->join('categories', 'categories.catid','=','jobs.category_id')
            ->where('jobs.isDeleted', '=', 0)
            ->orderby('jobs.created_at', 'desc')
            ->select('jobs.id', 'jobs.title', 'jobs.description', 'jobs.deadline', 'jobs.status', 'jobs.price', 'jobs.participants_num', 'jobs.created_at', 'users.name')
            ->get();
        return view('user.jobs', compact('jobs'));
    }

    public function post()
    {
        $categories = Category::all();
        return view('user.jobpost', compact('categories'));
    }

    public function store(Request $request)
    {
        $userid = Auth::id();
        $request->validate([
            'title' => 'required|min:5|max:255',
            'description' => 'required|min:10|max:1500',
            'category' => 'required',
            'price' => 'required',
            'participants_num' => 'required',
            'deadline' => 'required'
        ], [
            'title.required' => 'The title field is required.',
            'title.min' => 'The title must be at least :min characters.',
            'title.max' => 'The title may not be greater than :max characters.',
            'description.required' => 'The description field is required.',
            'description.min' => 'The description must be at least :min characters.',
            'description.max' => 'The description may not be greater than :max characters.',
            'category.required' => 'The category field is required.',
            'price.required' => 'The price field is required.',
            'participants_num.required' => 'The number of participants field is required.',
            'deadline.required' => 'The deadline field is required.'
        ]);
        Job::create([
            'user_id' => $userid,
            'title' => $request->title,
            'description' => $request->description,
            'category_id' => $request->category,
            'price' => $request->price,
            'participants_num' => $request->participants_num,
            'deadline' => $request->deadline,
            'status' => 'Open',
            'isDeleted' => 0
        ]);
        return redirect()->route('jobs.index')
        ->with('success','Job created successfully.');
    }

    public function edit(string $id)
    {
        $job = Job::find($id);
        $categories = Category::all();
        return view('user.jobedit', compact('job', 'categories'));
    }

    public function update(Request $request, string $id)
    {   
        $userid = Auth::id();
        $job = Job::find($id);
        $request->validate([
            'title' => 'required|min:5|max:255',
            'description' => 'required|min:10|max:1500',
            'category' => 'required',
            'price' => 'required',
            'participants_num' => 'required',
            'deadline' => 'required'
        ], [
            'title.required' => 'The title field is required.',
            'title.min' => 'The title must be at least :min characters.',
            'title.max' => 'The title may not be greater than :max characters.',
            'description.required' => 'The description field is required.',
            'description.min' => 'The description must be at least :min characters.',
            'description.max' => 'The description may not be greater than :max characters.',
            'category.required' => 'The category field is required.',
            'price.required' => 'The price field is required.',
            'participants_num.required' => 'The number of participants field is required.',
            'deadline.required' => 'The deadline field is required.'
        ]);

        $job->update([
            'user_id' => $userid,
            'title' => $request->title,
            'description' => $request->description,
            'category_id' => $request->category,
            'price' => $request->price,
            'participants_num' => $request->participants_num,
            'deadline' => $request->deadline,
            'status' => 'Open',
            'isDeleted' => 0
        ]);

        return redirect()->route('jobs.index')
            ->with('success', 'Job updated successfully.');
    }

    public function destroy(string $id)
    {
        $job = Job::find($id);
        $job->delete();

        return redirect()->route('jobs.index')
            ->with('success', 'Job deleted successfully');
    }
}
