<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AnswerController extends Controller
{
    public function store(Request $request)
    {
        if (Auth::check()) {

            $validated = Validator::make($request->all(), [
                'answer_text' => 'required|string'
            ]);

            if ($validated->fails()) {
                return redirect()->back()->with('message', 'Submit answer fail');
            }

            $question = Question::where('slug', $request->question_slug)->first();

            if ($question) {
                Answer::create([
                    'question_id' => $question->id,
                    'user_id' => Auth::user()->id,
                    'answer_text' => $request->answer_text
                ]);
                return redirect()->back()->with('message', 'Add new answer successfully');
            } else {
                return redirect()->back()->with('message', 'No post found');
            }
        } else {
            return redirect()->route('login')->with('message', 'Please login first to answer');
        }
    }

    public function destroy(Request $request)
    {
        if (Auth::check()) {
            $answer = Answer::where('id', $request->answer_id)
                ->where('user_id', Auth::user()->id)
                ->first();

            if ($answer) {
                $answer->delete();
                // Return to ajax
                return response()->json([
                    'status' => 200,
                    'message' => 'Delete this answer successfully'
                ]);
            } else {
                return response()->json([
                    'status' => 500,
                    'message' => 'Fail'
                ]);
            }
        } else {
            return response()->json([
                'status' => 401,
                'message' => 'Please login first to delete this answer'
            ]);
        }
    }
}
