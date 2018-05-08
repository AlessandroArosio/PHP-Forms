<?php
session_start();
session_regenerate_id();
?>
<!DOCTYPE html>
<!--
Student name: Alessandro Arosio
Student ID: (to be filled out)
Module: Web Programming using PHP (P1)
Module leader: Ian Hollender
Year: 2017/2018
This is the Final Marked Assessment (FMA)
Deadline for the submission: 10.04.2018
-->
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<?php
require_once "include/functions.php";
include "include/head.php";
?>
<body>
<?php
include "include/header.php";
include "include/dcs-nav.php";
?>

<p>The Department of Computer Science and Information Systems at Birkbeck is one of the first computing departments
    established in the UK, celebrating our 60th anniversary in 2017. We provide a stimulating teaching and research
    environment for both part-time and full-time students, and a friendly, inclusive space for learning, working and
    collaborating.
</p>

<br />

<section>
    <h2>Research in the department</h2>
    <article>

        <h3>Search Query Semantics</h3>
        <!--        This article has been taken from the DCS website, all right reserved.-->
        <p>Search engine queries are more than just a sequence of words. Discovering the structure of a query can help
            search engines to identify users' search intent. As a result, search engines apply techniques such as query
            segmentation and word sense disambiguation in order to reveal and meet users' search requirements.
            A technique that has recently been applied to uncover the semantics of a query is that of named entity
            recognition, that is the task of extracting from text instances of different categories such as person,
            location, or company.

            In this project, we propose a framework for the detection and classification of named entities in search
            queries. Typically, a web search query consists of only few words and does not provide enough context nor
            surface clues, such as capitalisation, to accurately detect named entities. Our framework overcomes these
            challenges by applying two-stage approach.

            The first stage involves the recognition of candidate named entities by grammatically annotating
            query tokens, and sets the boundaries of named entitiess using query segmentation. The second stage
            involves the classification of extracted candidate named entities using the vector space model.</p>
    </article>
</section>
</body>
</html>







