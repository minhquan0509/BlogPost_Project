<?php

namespace App\Http\Controllers;

use App\Http\Requests\QuestionFormRequest;
use App\Models\Answer;
use App\Models\Category;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class QuestionController extends Controller
{

    public function index()
    {
        $questions = Question::where('created_by', Auth::user()->id)->paginate(5);
        return view('question.user-question', compact('questions'));
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

    public function viewAllQuestion()
    {
        $questions = Question::all();
        return view('question.index', compact('questions'));
    }

    public function viewCategoryQuestion(string $category_slug)
    {
        $category = Category::where('slug', $category_slug)
            ->where('status', 0)
            ->first();
        if ($category) {
            $questions = Question::where('category_id', $category->id)->paginate(4);
            $category = $category->name;
            return view('question.view-questions-with-category', compact('category', 'questions'));
        } else return redirect('/');
    }

    public function viewQuestion(string $category_slug, string $question_slug)
    {
        $category = Category::where('slug', $category_slug)->where('status', 0)->first();
        if ($category) {
            $question = Question::where('category_id', $category->id)
                ->where('slug', $question_slug)
                ->first();
            //Tìm tất cả các questions mà có cùng category mà được đăng gần nhất
            // $latest_posts = Post::where('category_id', $category->id)
            //     ->where('status', 0)
            //     ->orderBy('created_at', 'DESC')
            //     ->take(15)
            //     ->get();
            // Đưa ra tất cả các questions trong hệ thống mà có lượng likes cao nhất
            $highest_answers = Answer::groupBy('question_id')
                ->select('question_id', DB::raw('count(*) as total_answers'))
                ->having('total_answers', '>', '0')
                ->orderBy('total_answers', 'DESC')
                ->take(15)
                ->get();
            // Nhét cái đống thông tin này vào phía view để thực hiện render giao diện
            return view('question.view-detail-question', compact('question', 'highest_answers'));
        } else return redirect('/');
    }
}
