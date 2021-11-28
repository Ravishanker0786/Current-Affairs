@extends ('layout')

@section('content')

    <section class="content">

        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Topics</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('welcome') }}">Home</a></li>
                            <li class="breadcrumb-item active"><a href="{{ url('/topics') }}">Topics</a></li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <section class="content">
            <div class="container-fluid">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            <button type="button" class="btn btn-block bg-gradient-primary" id="add_topic">Add
                                Topic</button>
                        </h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body" id="topic-table">

                    </div>
                    <!-- /.card-body -->
                </div>
            </div>

        </section>

        <div class="modal fade" id="topic_modal" tabindex="-1" role="dialog" aria-labelledby="topic_modalTitle"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="topic_modalTitle">Topics</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="topic_form">
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Enter title</label>
                                        <input type="text" class="form-control" name="tname" id="tname"
                                            placeholder="Enter title">
                                        <input type="hidden" name="tid" id="tid" class="hidden">
                                        <input type="hidden" name="type" id="type" class="hidden">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Enter Image url</label>
                                        <input type="text" class="form-control" name="url" id="url" placeholder="Enter url">
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" id="topic_submit">Save changes</button>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <br>
        <br>

    @endsection

    @push('js')
        <script>
            $(document).ready(function() {
                get_topics();
            });



            function get_topics() {
                startLoader();
                $.ajax({
                    url: '{{ route('topic') }}',
                    method: 'get',
                    data: {
                        'web': 'web'
                    },
                    success: function(response) {
                        $('#topic-table').html(response.html);
                        $('#example1').DataTable({
                            "paging": true,
                            "lengthChange": true,
                            "searching": true,
                            "pageLength": 5,
                            "lengthMenu": [
                                [10, 25, 50, -1],
                                [5, 10, 20, "All"]
                            ],
                            "ordering": true,
                            "info": true,
                            "autoWidth": false,
                            "responsive": true,
                        });
                        stopLoader();
                    },
                    error: function(error) {
                        console.log(error);
                    }
                })
            }

            $(document).on('click', '#add_topic', function() {
                $(document).find('.hidden').val('');
                $('#topic_form')[0].reset();
                $('#topic_modal').modal('show');
            });

            $(document).on('click', '.topic', function() {
                startLoader();
                let id = $(this).attr('id').split('_')[1];
                let tname = $(this).closest('tr').find('#tname').text();
                let imgurl = $(this).closest('tr').find('img').attr('src');
                $(document).find('.hidden').val('');
                $('#topic_form')[0].reset();
                $('[name="url"]').val(imgurl);
                $('[name="tname"]').val(tname);
                $('[name="tid"]').val(id);
                $('#topic_modal').modal('show');
                stopLoader();
            });


            $(document).on('click', '#topic_submit', function() {
                startLoader();
                const formData = $('#topic_form').serialize();
                $.ajax({
                    url: "{{ route('topic.store') }}",
                    method: 'POST',
                    data: formData,
                    success: function(response) {
                        stopLoader();
                        if (response.response == "ok") {
                            $('#topic_form')[0].reset();
                            $('#topic_modal').modal('hide');
                            swal(
                                'Success',
                                'You clicked the <b style="color:green;">Success</b> button!',
                                'success'
                            )
                        }
                    },
                    error: function(error) {
                        stopLoader();
                        console.log(error);
                    }
                });
            });
        </script>

    @endpush
