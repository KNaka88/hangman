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
        $this->questions = array("Beatles", "Monkees", "Bob Dylan", "The Rolling Stones", "The Ramones");

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





}
