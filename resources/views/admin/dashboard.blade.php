@extends('layouts.admin')

@section('content')
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
          <livewire:table :config="App\Tables\EmployeesTable::class"/>
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
          <!-- <table id="positionsTable" class="table table-striped projects">
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
          </table> -->
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  @endsection