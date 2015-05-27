<?php

class QuestionController extends Controller {

    /*
     |--------------------------------------------------------------------------
     | Default Home Controller
     |--------------------------------------------------------------------------
     |
     | You may wish to use controllers instead of, or in addition to, Closure
     | based routes. That's great! Here is an example controller method to
     | get you started. To route to this controller, just add the route:
     |
     |	Route::get('/', 'HomeController@showWelcome');
     |
     */

    // public function saveAction($quiz) {
    public function saveAction() {
        //get checkbox value
        $quiz = Input::get('quiz');

        $questions = explode("=", $quiz);
        $top_value = 70;
        $posts = array();
        //"a:value|b:value|c:value|r:value"
        // a:100,b:0,c:0,r:a,s:100|undefined|undefined=a:0,b:30,c:70,r:b|c,s:undefined|30|undefined=a:20,b:50,c:30,r:a|b|c,s:20|undefined|undefined

        for ($i = 0; $i < count($questions); $i++) {

            $question = explode(",", $questions[$i]);
            $question_a = 0;
            $question_b = 0;
            $question_c = 0;

            // "a:value", "b:value", "c:value", "r:value", "s:value1|value2|value3"
            for ($j = 0; $j < count($question); $j++) {

                $answers = explode(":", $question[$j]);
                //echo var_dump($answers) . "<br />";
                $answer_key = $answers[0];
                $answer_val = $answers[1];
                //echo "<br />";
                $sum = 0;
                if ($answer_key == "r") {
                    // correct answer value
                    $question_r = $answer_val;

                } else if ($answer_key == "a") {
                    $question_a = $answer_val;
                } else if ($answer_key == "b") {
                    $question_b = $answer_val;

                } else if ($answer_key == "c") {
                    $question_c = $answer_val;

                } else if ($answer_key == "s") {
                    $selected_answers = explode("|", $answer_val);
                    //var_dump($selected_answers);
                    for ($k = 0; $k < count($selected_answers); $k++) {
                        $sum += $selected_answers[$k];
                    }
                }

                if ($j == count($question) - 1) {
                    if ($sum >= $top_value) {
                        // passed
                        $status = "Passed";
                    } else {
                        $status = "Failed";
                    }
                    // echo $status . "<br />";
                    // Experting the quiz result to file system
                    // START
                    $posts[] = array('status' => $status);
                    $fp = fopen('public/question/results.json', 'w');
                    fwrite($fp, json_encode($posts));
                    fclose($fp);
                    // END
                }
            }
        }

        $email = Input::get('email');

        try {
            $count = User::where('email',$email)->count();
            if ($count == 0){
                $user = new User;
                $user->email =$email;

                $user->save();
            }
            $userEmail = User::where('email', $email) -> firstOrFail();

            $credentials = array('email' => $userEmail -> email);

            Password::remind($credentials, function($message) {
                $message -> subject("The Question send successfully.");
            });
        } catch( Exception $e ) {
        }

        $responses = array('quiz' => $quiz, 'status' => $status, 'sum' => $answers, 'email' => $userEmail);

        return Response::json($responses);
        // return Redirect::route("mail/request");
    }

}
