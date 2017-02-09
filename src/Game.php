<?php

class Game
{
    private $questions;
    private $correctAnswer;
    private $userAnswers;
    private $wrongAnswers;

    function __construct()
    {
        $this->questions = array("Beatles", "Monkees", "Bob Dylan", "The Rolling Stones", "The Ramones");

        $this->correctAnswer = array();

        $this->userAnswers = array();

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
        var_dump($this->correctAnswer);
    }



}
