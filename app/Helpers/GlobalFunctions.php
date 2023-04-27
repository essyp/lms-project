<?php

use Illuminate\Support\Str;
use App\Models\Grade;

function getLetterGPA($grade) {
    $data = Grade::where('min_score', '<=', $grade)->where('max_score', '>=', $grade)->first();
    // get the correct letter_grade where $grade is within score_min and score_max
   return $data->letter_grade;
}

function getGPA($grade) {
    $data = Grade::where('min_score', '<=', $grade)->where('max_score', '>=', $grade)->first();
     // get the correct letter_grade where $grade is within score_min and score_max
   return $data->gpa_grade;
}

function getComment($grade) {
    $data = Grade::where('min_score', '<=', $grade)->where('max_score', '>=', $grade)->first();
    // get the correct letter_grade where $grade is within score_min and score_max
   return $data->comment_grade;
}