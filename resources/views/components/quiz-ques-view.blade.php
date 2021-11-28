<input type="hidden" class="form-control" name="qno" value="{{ $qno ?? '' }}">
<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            Question
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-2">
        <div class="form-group">
            Option1
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group">
            Option2
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group">
            Option3
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group">
            Option4
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group">
            Answer
        </div>
    </div>
</div>
@php
$count = count($quiz);
@endphp
@forelse ($quiz as $key => $item)
    <div class="quiz_rem">
        <div class="row">
            <input type="hidden" class="form-control" name="qid[]" value="{{ $item->qid }}">
            <div class="col-md-12">
                <div class="form-group">
                    <input type="text" class="form-control validate" name="ques[]" value="{{ $item->ques }}">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-2">
                <div class="form-group">
                    <input type="text" class="form-control is-warning validate" name="option1[]"
                        value="{{ $item->option1 }}">
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <input type="text" class="form-control is-warning validate" name="option2[]"
                        value="{{ $item->option2 }}">
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <input type="text" class="form-control is-warning validate" name="option3[]"
                        value="{{ $item->option3 }}">
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <input type="text" class="form-control is-warning validate" name="option4[]"
                        value="{{ $item->option4 }}">
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <input type="text" class="form-control is-valid validate" name="ans[]" value="{{ $item->ans }}">
                </div>
            </div>
            <div class="col-md-1">
                <div class="form-group">
                    <i class="fas fa-window-close"></i>
                </div>
            </div>
            @if ($key + 1 == $count)
                <div class="col-md-1">
                    <div class="form-group">
                        <i class="fa fa-plus-square"></i>
                    </div>
                </div>
            @endif
        </div>
    </div>
@empty
    <div class="quiz_rem">
        <div class="row">
            <input type="hidden" class="form-control" name="qid[]" value="">
            <div class="col-md-12">
                <div class="form-group">
                    <input type="text" class="form-control validate" name="ques[]" value="">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-2">
                <div class="form-group">
                    <input type="text" class="form-control is-warning validate" name="option1[]" value="">
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <input type="text" class="form-control is-warning validate" name="option2[]" value="">
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <input type="text" class="form-control is-warning validate" name="option3[]" value="">
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <input type="text" class="form-control is-warning validate" name="option4[]" value="">
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <input type="text" class="form-control is-valid validate" name="ans[]" value="">
                </div>
            </div>
            <div class="col-md-1">
                <div class="form-group">
                    <i class="fas fa-window-close"></i>
                </div>
            </div>

            <div class="col-md-1">
                <div class="form-group"><i class="fa fa-plus-square"></i></div>
            </div>
        </div>
    </div>
@endforelse
