@extends ('layout')



@section('content')

    <section class="content">

        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Quiz</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('welcome') }}">Home</a></li>
                            <li class="breadcrumb-item active"><a href="{{ url('/quiz') }}">Quiz</a></li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <section class="content">
            <div class="container-fluid">
                <div class="card">
                    <div class="card-header" >
                        <h3 class="card-title">
                            <button type="button" class="btn btn-block bg-gradient-primary add">Add Quiz</button>
                        </h3>
                    </div>
                    <!-- /.card-header -->

                    <div class="card-body" id="quiz-table">

                    </div>
                    </form>
                    <!-- /.card-body -->
                </div>
            </div>

        </section>

        <div class="modal fade" id="quiz-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
            aria-hidden="true">
            <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalCenterTitle">Quiz Edit</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="quiz-form">
                            @csrf
                            <div id="quiz-data"></div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" id="submit_quiz">Save changes</button>
                    </div>
                </div>
            </div>
        </div>

    @endsection

    @push('js')
        <script>
            $(document).ready(function() {
                get_quiz();

                $(document).on('click','.add',function(){

                    $.ajax({
                    url: '{{ route('quiz.create') }}',
                    method: 'get',
                    success: function(response) {
                        $('#quiz-data').html(response);
                        $('#quiz-modal').modal('show');
                        stopLoader();
                    },
                    error: function(error) {
                        stopLoader();
                        console.log(error);
                    }
                })

                    
                });
            });



            function get_quiz() {
                startLoader();
                $.ajax({
                    url: '{{ route('quiz') }}',
                    method: 'get',
                    data: {
                        'web': 'web'
                    },
                    success: function(response) {
                        $('#quiz-table').html(response.html);
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
                        stopLoader();
                        console.log(error);
                    }
                })
            }


            $(document).on('click', '.news', function() {
                startLoader();
                let qno = $(this).attr('id').split('_')[1];
                $.ajax({
                    url: '{{ route('quiz') }}',
                    method: 'get',
                    data: {
                        'web': 'web',
                        'qno': qno
                    },
                    success: function(response) {
                        stopLoader();
                        $('#quiz-data').html(response.html);
                        $('#quiz-modal').modal('show');
                        // console.log(response);
                    },
                    error: function(error) {
                        stopLoader();
                    }
                });
            });

            $(document).on('click', '.fa-window-close', function() {
                $(this).parent().parent().parent().parent().remove();
                $('.fa-plus-square').each(function() {
                    $(this).parent().parent().remove();
                });
                let div = '<div class="col-md-1"><div class="form-group"><i class="fa fa-plus-square"></i></div></div>';
                $('.quiz_rem').last().children().eq(1).append(div);
            });


            $(document).on('click', '.fa-plus-square', function() {
                let div = $(this).parent().parent().parent().parent().clone();
                div.find('input').val('');
                $('#quiz-data').append(div);
                $('.fa-plus-square').each(function() {
                    $(this).parent().parent().remove();
                });

                let div_add =
                    '<div class="col-md-1"><div class="form-group"><i class="fa fa-plus-square"></i></div></div>';
                $('.quiz_rem').last().children().eq(1).append(div_add);
            });


            $(document).on('click', '#submit_quiz', function() {
                if (validation()) {
                    $.ajax({
                        url: "{{ route('quiz.store') }}",
                        type: "post",
                        data: $('#quiz-form').serialize(),
                        success: function(response) {
                            if (response.response == "ok") {
                                $('#quiz-modal').modal('hide');
                                swal(
                                    'Success',
                                    'You clicked the <b style="color:green;">Success</b> button!',
                                    'success'
                                )
                            }
                        },
                        error: function(error) {
                            console.log(error);
                        }
                    });
                }
            });
        </script>

    @endpush
