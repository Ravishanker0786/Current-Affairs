@extends ('layout')



@section('content')

    <section class="content">

        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>News</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('welcome') }}">Home</a></li>
                            <li class="breadcrumb-item active"><a href="{{ url('/news') }}">News</a></li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <section class="content">
            <div class="container-fluid">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-2 mt-2">
                                <h3 class="card-title">
                                    <button type="button" class="btn btn-primary" id="new_news">
                                        Add News
                                    </button>
                                </h3>
                            </div>
                            <div class="col-md-4 mt-2 offset-md-6 float-right">
                                <input type="text" id="search" class="search form-control">
                            </div>
                        </div>
                        </h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body" id="news-table">

                    </div>
                    <!-- /.card-body -->
                </div>
            </div>

        </section>

        <div class="modal fade" id="modal-news">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">News Modal</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="news_form">
                            @csrf
                            <input type="text" name="type" value="1" style="display: none;">
                            <input type="text" name="id" value="" style="display: none;">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="title">Topic</label>
                                            <select name="tid" class="form-control validate" id="topic">
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4 offset-md-4">
                                        <label for="reservationdate">Date/Time</label>
                                        <div class="input-group date" id="reservationdate" data-target-input="nearest">
                                            <input type="text" name="date"
                                                class="form-control datetimepicker-input validate"
                                                data-target="#reservationdate">
                                            <div class="input-group-append" data-target="#reservationdate"
                                                data-toggle="datetimepicker">
                                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="title">Title</label>
                                            <textarea class="form-control validate" name="title" id="title"
                                                placeholder="Enter title" rows="3"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label for="description">Description</label>
                                            <textarea class="form-control validate" name="description" id="description"
                                                placeholder="Enter description" rows="3"></textarea>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">New Url</label>
                                            <input type="text" class="form-control validate" name="newsurl" id="newsurl"
                                                placeholder="Enter news url">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Image Url</label>
                                            <input type="text" class="form-control validate" name="imageurl" id="imageurl"
                                                placeholder="Enter image url">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer float-right">
                                <button type="button" class="btn btn-primary" id="news_submit">Submit</button>
                            </div>
                        </form>
                    </div>
                    {{-- <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary">Save changes</button>
          </div> --}}
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
        <br>
        <br>
        <br>

    @endsection

    @push('js')
        <script>
            $(document).ready(function() {
                get_news(1);

                $('#reservationdate').datetimepicker();

                $(document).on('click', '#new_news', function() {
                    $('input[name="type"]').val('1');
                    $('#news_form')[0].reset();
                    $('[name="date"]').prop('readonly', false);
                    $('[name="date"]').val(($('#clock').html()));
                    $('#modal-news').modal('show');
                })
            });

            $("#search").on('keyup', function(e) {
                if (e.key === 'Enter' || e.keyCode === 13) {
                    get_news(1);
                }
            });

            function get_news(page) {

                var search_prams = {
                    'search': $('.search').val(),
                    'page': page,
                    "web": "web",
                }

                startLoader();
                $.ajax({
                    url: '{{ route('news') }}',
                    method: 'get',
                    data: search_prams,
                    success: function(response) {
                        $('#news-table').html(response.html);
                        $('#topic').html(response.topic);
                        $('#example1').DataTable({
                            "paging": false,
                            "lengthChange": true,
                            "searching": false,
                            "ordering": false,
                            "info": false,
                            "autoWidth": false,
                            "responsive": true,
                        });
                        stopLoader();
                    },
                    error: function(error) {
                        stopLoader();
                        console.log(error);
                    }
                })
            }


            $(document).on('click', '.pagination a', function(event) {
                event.preventDefault();
                var page = $(this).attr('href').split('page=')[1];
                get_news(page);
            });


            $(document).on('click', '#news_submit', function() {

                if (validation()) {
                    $.ajax({
                        url: "{{ route('news.store') }}",
                        type: "post",
                        data: $('#news_form').serialize(),
                        success: function(response) {
                            if (response.response == "ok") {
                                $('#news_form')[0].reset();
                                $('#modal-news').modal('hide');
                                swal(
                                    'Success',
                                    'You clicked the <b style="color:green;">Success</b> button!',
                                    'success'
                                )
                                $('.page-item').each(function() {
                                    if ($(this).hasClass('active')) {
                                        let page = $(this).find('.page-link').text();
                                        get_news(page);
                                    };

                                })
                            } else {
                                console.log(response);
                            }
                        },
                        error: function(error) {
                            console.log(error);
                        }
                    });
                }

            });

            $(document).on('click', '.news', function() {
                startLoader();
                let id = $(this).attr('id').split('_')[1];
                let date = $(this).closest('tr').find('#date').text();
                let title = $(this).closest('tr').find('#title').text();
                let description = $(this).closest('tr').find('#description').text();
                let newsurl = $(this).closest('tr').find('a').attr('href');
                let imgurl = $(this).closest('tr').find('img').attr('src');
                let tid = $(this).closest('tr').find('#tid').find('span').text();
                $('#news_form')[0].reset();
                $('[name="date"]').prop('readonly', true);
                $('[name="date"]').val(date);
                $('[name="title"]').val(title);
                $('[name="description"]').val(description);
                $('[name="newsurl"]').val(newsurl);
                $('[name="imageurl"]').val(imgurl);
                $('[name="tid"]').val(tid);
                $('[name="id"]').val(id);
                $('#modal-news').modal('show');
                stopLoader();
            });
        </script>

    @endpush
