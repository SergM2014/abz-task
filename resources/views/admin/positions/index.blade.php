@extends('layouts.admin')

@section('content')
    <!-- Main content -->
    
      <div  id="positionssCard" class="card">
        <div class="card-header">
          <h3 class="card-title">Positions</h3>
          <a href="{{ route('positions.create') }}" class="ml-5 link-success">Create a new Position</a>
          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
              <i class="fas fa-minus"></i>
            </button>
            
          </div>
        </div>
        <div class="card-body p-0">
          <livewire:table :config="App\Tables\PositionsTable::class"/>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </section>
    <!-- /.content -->
  
  <!-- /.content-wrapper -->

  @endsection