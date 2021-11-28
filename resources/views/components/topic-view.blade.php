<table id="example1" class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>Id</th>
            <th>Title</th>
            <th>Image</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($topic as $key => $value) { ?>
        <tr>
            <th>{{ $key + 1 }}</th>
            <th id="tname">{{ $value->tname }}</th>
            <th><img src="{{ $value->url }}" width="100" height="100"></th>
            <th><button type="button" class="btn btn-block btn-success topic btn-xs"
                    id="topic_{{ $value->tid }}">Edit</button>
                <br>

            </th>
        </tr>
        <?php } ?>

    </tbody>
    <tfoot>
        <tr>
            <th>Id</th>
            <th>Title</th>
            <th>Image</th>
            <th>Action</th>
        </tr>
    </tfoot>
</table>
