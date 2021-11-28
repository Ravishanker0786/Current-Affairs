@extends ('layout')



@section('content')

 <section class="content">

  <!-- /.row -->
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Payment of master</h3>

                <div class="card-tools">
                  <div class="input-group input-group-sm" style="width: 30vw;">
                    <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

                    <div class="input-group-append">
                      <button type="submit" class="btn btn-default">
                        <i class="fas fa-search"></i>
                      </button>
                    </div>
                  </div>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0" style="height: 60vh;">
                <table class="table table-head-fixed text-nowrap">
                  <thead>
                    <tr>
                      <th>Id</th>
                      <th>Name</th>
                      <th>Created at</th>
                      <th>Updated at</th>
                      <th>#</th>
                      <th>#</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>982</td>
                      <td>Rocky Doe</td>
                      <td>11-7-2014</td>
                      <td>13-7-2014</td>
                      <td><i class="fas fa-trash"></i></td>
                      <td><i class="fas fa-edit"></i></td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
              <div class="card-footer">
                  <button type="submit" class="btn btn-primary float-right" data-toggle="modal" data-target="#exampleModalCenter">Add</button>
                </div>
            </div>
            <!-- /.card -->
            
          </div>
        </div>
        <!-- /.row -->
      
    </section>

    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalCenterTitle">Modal title</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="form-group">
              <label for="exampleInputEmail1">Enter name</label>
              <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter name">
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary">Save changes</button>
          </div>
        </div>
      </div>
    </div>

@endsection