@extends('layouts.main')

@section('title', '| Ticket')

@prepend('css')
<link rel="stylesheet" href="{{ asset('css/dataTables.css') }}">
@endprepend

@section('main-content')

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
  <h1 class="h3 mb-0 text-gray-800">Ticket</h1>
</div>

<!-- Content Row -->

<div class="row">
  <div class="col-lg-6">
    <div class="card">
      <div class="card-body">
        <form action="{{ route('ticket.store') }}" method="POST">
          @csrf
          <div class="form-group">
            <label for="event">Event</label>
            <select class="form-control" id="event" name="event">
              <option selected disabled>-- Pilih Event --</option>
              @foreach ($events as $event)
              <option value="{{ $event->id }}">{{ $event->event_name }}</option>
              @endforeach
            </select>
            <span class="text-danger">
              @error('event')
              {{ $message }}
              @enderror
            </span>
          </div>
          <div class="form-group">
            <label for="nama" class="col-form-label">Nama Tiket</label>
            <input type="text" class="form-control" id="nama" name="nama">
            <span class="text-danger">
              @error('nama')
              {{ $message }}
              @enderror
            </span>
          </div>
          <div class="form-group">
            <label for="harga" class="col-form-label">Harga</label>
            <input type="number" class="form-control" id="harga" name="harga">
            <span class="text-danger">
              @error('harga')
              {{ $message }}
              @enderror
            </span>
          </div>
          <div class="form-group">
            <label for="kuota" class="col-form-label">Kuota</label>
            <input type="number" class="form-control" id="kuota" name="kuota">
            <span class="text-danger">
              @error('kuota')
              {{ $message }}
              @enderror
            </span>
          </div>
          <div class="form-group">
            <label for="keterangan" class="col-form-label">Keterangan</label>
            <textarea class="form-control" id="keterangan" name="keterangan"></textarea>
            <span class="text-danger">
              @error('keterangan')
              {{ $message }}
              @enderror
            </span>
          </div>
          <a href="{{ route('ticket') }}" class="btn btn-danger"><i class="fas fa-backspace"></i> Cancel</a>
          <button type="submit" class="btn btn-primary">Save</button>
        </form>
      </div>
    </div>
  </div>
</div>

@push('js')
<script>
  $(document).ready(function() {
    $('#kategori').off('change').on('change', function() {
      if ($(this).val() == '0') {
        $('#new-kategori-input').removeClass('d-none');
      } else {
        $('#new-kategori-input').addClass('d-none');
      }
    });
  })

</script>
@endpush

@endsection
