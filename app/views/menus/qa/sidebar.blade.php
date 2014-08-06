<div class="sidebar-module search-bar">
    <form>
        <input type="search" placeholder="Search">
    </form>
</div>
<div class="clearfix"></div>
<div class="sidebar-module">
    <h4 id="sidebar-header">Latest Questions</h4>
        <ul>
        @foreach($recentQuestions as $question )
            <li>{{ HTML::linkRoute('question.show', $question->title, array($question->id)) }}</li>
        @endforeach
        </ul>
</div>
<div class="clearfix"></div>
<div class="sidebar-module">
    <h4 id="sidebar-header">Latest Comments</h4>
        <ul>
        @foreach($recentAnswers as $answer )
            <?php
                $a = null;
                if(strlen($answer->answer) >= 40) {
                    $a = substr($answer->answer, 0, 40) . '...';
                }  else {
                    $a = $answer->answer;
                }
            ?>
            <li>{{ HTML::linkRoute('question.show', $a, array($answer->question_id)) }}</li>
        @endforeach
        </ul>
</div>