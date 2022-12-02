@extends('layouts.admin')

@section('content')
 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Dashboard v2</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard v2</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div  id="employeesCard" class="card d-none ">
        <div class="card-header">
          <h3 class="card-title">Users</h3>

          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
              <i class="fas fa-minus"></i>
            </button>
            
          </div>
        </div>
        <div class="card-body p-0">
          <table id="employeesTable" class="table table-striped projects">
              <thead>
                  <tr>
                      <!-- <th style="width: 1%" class="text-center">
                          #
                      </th> -->
                      <th style="width: 10%" class="text-center">
                        Id 
                      </th>
                      <th style="width: 20%" class="text-center">
                          Name
                      </th>
                      <th style="width: 30%" class="text-center">
                          Email
                      </th>
                     
                      <th style="width: 20%" class="text-center">
                        Action
                      </th>
                  </tr>
              </thead>
              <tbody>
              
              </tbody>
          </table>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->

      <div  id="positionsCard" class="card d-none">
        <div class="card-header">
          <h3 class="card-title">Positions</h3>

          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
              <i class="fas fa-minus"></i>
            </button>
            
          </div>
        </div>
        <div class="card-body p-0">
          <table id="employeesTable" class="table table-striped projects">
              <thead>
                  <tr>
                      <!-- <th style="width: 1%" class="text-center">
                          #
                      </th> -->
                      <th style="width: 10%" class="text-center">
                        Id 
                      </th>
                      <th style="width: 20%" class="text-center">
                          Session Id
                      </th>
                      <th style="width: 20%" class="text-center">
                          IP
                      </th>
                      <th style="width: 20%" class="text-center">
                        Country
                      </th>
                      <th style="width: 15%" class="text-center">
                        Browser
                      </th>
                     
                      <th style="width: 15%" class="text-center">
                        Status
                      </th>
                  </tr>
              </thead>
              <tbody>
              
              </tbody>
          </table>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  @endsection