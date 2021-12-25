<?php

require_once "vadersentiment.php";

$textToTest = "VADER is smart, handsome, and funny.";

function textToSentient($inputText)
{
    $sentimenter = new SentimentIntensityAnalyzer();
    $result = $sentimenter->getSentiment($inputText);
    return $result;

}


textToSentient($textToTest)


?>