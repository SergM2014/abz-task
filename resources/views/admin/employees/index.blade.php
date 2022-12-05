@extends('layouts.admin')

@section('content')
    <!-- Main content -->
    
      <div  id="employeesCard" class="card">
        <div class="card-header">
          <h3 class="card-title">Users</h3>
          <a href="{{ route('employees.create') }}" class="ml-5 link-success">Create a new Emloyee</a>
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
    </section>
    <!-- /.content -->
  
  <!-- /.content-wrapper -->
  @endsection