<?php

namespace App\Http\Controllers;

use App\Answer;
use Illuminate\Http\Request;

class ApiAnswersController extends Controller
{
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Answer $answer)
    {
        $answer->answer = $request->answer['answer'];
        $answer->save();
        return $answer;
    }
}
