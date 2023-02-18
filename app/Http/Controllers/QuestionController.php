<?php

namespace App\Http\Controllers;

use App\Http\Requests\QuestionFormRequest;
use App\Models\Category;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class QuestionController extends Controller
{

    public function index()
    {
        $questions = Question::where('created_by', Auth::user()->id)->paginate(5);
        return view('question.user-question', compact('questions'));
    }

    public function show()
    {
    }

    public function create()
    {
        $category = Category::where('status', '0')->get();
        return view('question.create', compact('category'));
    }

    public function save(QuestionFormRequest $request)
    {
        $data = $request->validated();
        $question = new Question();
        $question->category_id = $data['category_id'];
        $question->title = $data['title'];
        $question->slug = Str::slug($data['slug']);
        $question->description = $data['description'];
        $question->created_by = Auth::user()->id;
        // dd($question);
        $question->save();
        return redirect(url('questions/my-questions'))->with('msg', 'Your question is added successfully...');
    }

    public function edit($question_id)
    {
        $question = Question::where('created_by', Auth::user()->id)->find($question_id);
        if ($question) {
            $category = Category::where('status', '0')->get();
            return view('question.edit', compact('question', 'category'));
        } else return redirect(url('home'))->with('msg', 'This question is unauthorized');
    }

    public function update(QuestionFormRequest $request, $question_id)
    {
        $data = $request->validated();
        $question = $question = Question::where('created_by', Auth::user()->id)->find($question_id);
        $question->category_id = $data['category_id'];
        $question->title = $data['title'];
        $question->slug = Str::slug($data['slug']);
        $question->description = $data['description'];
        $question->created_by = Auth::user()->id;
        // dd($question);
        $question->update();
        return redirect(url('questions/my-questions'))->with('msg', 'Your question is updated successfully...');
    }

    public function delete($question_id)
    {
        $question = $question = Question::where('created_by', Auth::user()->id)->find($question_id);
        if ($question) {
            $question->delete();
            return redirect(url('questions/my-questions'))->with('msg', 'Delete question successfully...');
        }
    }
}
