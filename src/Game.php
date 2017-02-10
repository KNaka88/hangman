<?php

class Game
{
    private $questions;
    private $correctAnswer;
    private $userAnswers;
    private $remainingAlphabet;
    private $wrongAnswers;

    function __construct()
    {
        $this->questions = array("beatles", "monkees", "bob dylan", "the rolling stones", "the ramones");

        $this->correctAnswer = array();

        $this->userAnswers = array();

        $this->remainingAlphabet = array("a","b","c","d","e","f","g","h","i","j","k","l","m","n","o","p","q","r","s","t","u","v","w","x","y","z");

        $this->wrongAnswers = 0;
    }

    function getQuestions()
    {
        return $this->questions;
    }
    function setQuestions($questions)
    {
        $this->questions = $questions;
    }

    function getCorrectAnswer()
    {
        return $this->correctAnswer;
    }
    function setCorrectAnswer($correctAnswer)
    {
        $this->correctAnswer = $correctAnswer;
    }

    function getWrongAnswers()
    {
        return $this->wrongAnswers;
    }
    function setWrongAnswers($wrongAnswers)
    {
        $this->wrongAnswers = $wrongAnswers;
    }



    function getUserAnswers()
    {
        return $this->userAnswers;
    }
    function setUserAnswers($userAnswers)
    {
        $this->userAnswers = $userAnswers;
    }

    function getRemainingAlphabet()
    {
        return $this->remainingAlphabet;
    }
    function setRemainingAlphabet($remainingAlphabet)
    {
        $this->remainingAlphabet = $remainingAlphabet;
    }

    function save()
    {
        $_SESSION['game'] = $this;
    }

    static function resetData()
    {
        $_SESSION['game'] = new Game();
        $_SESSION['game']->setAnswer();
    }

    function setAnswer()
    {
        $answer = $this->questions[array_rand($this->questions, 1)];
        echo "Before: ". $answer;
        $answer = preg_replace("/\s/","",$answer);
        $answer = str_split($answer);
        $this->correctAnswer = $answer;

        //set userAnswers with _ _ _ _...till the question's lentgh

        for($i=0; $i<count($answer); $i++){
            array_push($this->userAnswers,'_');
        }
        var_dump($this->userAnswers);
    }

    function checkAnswers($input)
    {
        //if answer was wrong, add +1 to wrongAnswers counter
        if(array_search(strtolower($input), $this->correctAnswer) === false )
        {
            if (!array_search(strtolower($input), $this->remainingAlphabet) === false ){
                $this->wrongAnswers += 1;
            }
        } else {
            $correctKeys = array_keys($this->correctAnswer, strtolower($input));

            foreach($correctKeys as $correctKey){
                array_splice($this->userAnswers, $correctKey, 1, $input);
            }
        }

        // remove from available letters
        $position = array_search(strtolower($input), $this->remainingAlphabet);
        if ($position !== false){
            array_splice($this->remainingAlphabet, $position, 1, "_");
        }

        //if answer is correct, insert the correct letter to userAnswers
    }

    function checkWin(){


        if(array_search("_", $this->userAnswers) === false) {
            return true;
        } else {
            return false;
        }
    }

    function checkLose(){

        if($this->wrongAnswers == 6){
            return true;
        } else {
            return false;
        }
    }





}
