<table id="example1" class="table table-bordered table-striped">
    <thead>
    <tr>
    <th>Sr</th>
    <th>Date</th>
    <th>Action</th>
    </tr>
    </thead>
    <tbody>
        @forelse($quiz as $key => $values)
        <tr>
            <th>{{ (int)$key + 1 }}</th>
            <th>{{ $values->quiz_timestamp }}</th>
            <th><button type="button" class="btn btn-block news btn-success btn-xs" id="quiz_{{ $values->qno }}">Edit</button></th>
        </tr>
        @endforeach
    </tbody>
    <tfoot>
    <tr>
        <th>Sr</th>
        <th>Date</th>
        <th>Action</th>
    </tr>
    </tfoot>
</table>