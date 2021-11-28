<table id="example1" class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>Date</th>
            <th>Title</th>
            <th>Description</th>
            <th>Image</th>
            <th>Newsurl</th>
            <th>Topic</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php

        foreach ($news as $key => $value) { ?>
        <tr>
            <th id="date">{{ $value->rdate }}</th>
            <th id="title">{{ $value->title }}</th>
            <th id="description">{{ $value->description }}</th>
            <th id="imgurl"><img src="{{ $value->imageurl }}" width="100" height="100"></th>
            <th id="newsurl"><a href="{{ $value->newsurl }}" target="_blank">Link</a></th>
            <th id="tid">{{ $value->tname }}<span style="display: none">{{ $value->tid }}</span></th>
            <th><button type="button" class="btn btn-block news btn-success btn-xs"
                    id="news_{{ $value->id }}">Edit</button></th>
        </tr>
        <?php }
        

        ?>

    </tbody>
    <tfoot>
        <tr>
            <th>Date</th>
            <th>Title</th>
            <th>description</th>
            <th>Image</th>
            <th>newsurl</th>
            <th>Topic</th>
            <th>Action</th>
        </tr>
    </tfoot>
</table>
<div class="mt-2 float-left text-center">
    Showing {{ ($news->currentpage() - 1) * $news->perpage() + 1 }} to
    {{ $news->currentpage() * $news->perpage() }}
    of {{ $news->total() }} entries
</div>
<div class="pagination-sm clearfix mt-2 float-right text-center">
    {{ $news->links() }}
</div>
