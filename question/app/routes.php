<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', array(
        "as" => "home/index", function(){
              $string1 = file_get_contents("public/question/question.json");
        $json_quiz = json_decode($string1);
        $title = $json_quiz->result->title;
        $questions = $json_quiz->result->questions;
        $i = 0;
        foreach ($questions as $question) {
            
            $answers = $question->answer;
            $datas[$i]["key"] = $i;
            $datas[$i]["title"] = $question->title;
            $datas[$i]["correct"] = $question->correct;
            $datas[$i]["a_a"] = $answers[0]->a;
            $datas[$i]["a_b"] = $answers[0]->b;
            $datas[$i]["a_c"] = $answers[0]->c;
            $i ++; 
        }
        return View::make("home/index")      
            ->with('total_questions', $i)                  
            ->with("questions", $datas);        
}));

Route::get("login", array(
        "as" => "home/index", function(){
        $string1 = file_get_contents("public/question/question.json");
        $json_quiz = json_decode($string1);
        $title = $json_quiz->result->title;
        $questions = $json_quiz->result->questions;
        $i = 0;
        foreach ($questions as $question) {
            
            $answers = $question->answer;
            $datas[$i]["key"] = $i;
            $datas[$i]["title"] = $question->title;
            $datas[$i]["correct"] = $question->correct;
            $datas[$i]["a_a"] = $answers[0]->a;
            $datas[$i]["a_b"] = $answers[0]->b;
            $datas[$i]["a_c"] = $answers[0]->c;
            $i ++; 
        }
        
        return View::make("home/index")
            ->with('total_questions', $i)                  
            ->with("questions", $datas);        
}));

//Add new addImage modal
Route::get ("modals/addImage", array(
    "as" => "modals/addImage", function(){

        return View::make('modals.addImage');
                                
}));

Route::post( '/addImageFile', array(
    'as' => 'addImageFile',
    'uses' => 'ImageUploadController@construct'
));

Route::post( 'question/verify', array(
    'uses' => 'QuestionController@saveAction'
));

Route::get( 'question/verify/{quiz}/', array(
"as" => "admin/sprintEdit", function($quiz) {
   
    App::make('QuestionController')->saveAction($quiz);
    //'uses' => 'QuestionController@saveAction'
}));

//Route to QuestionController request method
Route::post("mail/request", array(
    "uses" => "MailController@requestAction"
));
