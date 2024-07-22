@extends('layouts.main')

@section('title', '| Event')

@prepend('css')
<link rel="stylesheet" href="{{ asset('css/dataTables.css') }}">
@endprepend

@section('main-content')

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
  <h1 class="h3 mb-0 text-gray-800">Event</h1>
</div>

<!-- Content Row -->

<div class="card">
  <div class="card-body">
    <form action="{{ route('event.update', $event->id) }}" method="POST" enctype="multipart/form-data">
      @method('PUT')
      @csrf
      <div class="form-group">
        <label for="event" class="col-form-label">Event</label>
        <input type="hidden" name="id" value="{{ $event->id }}">
        <input type="text" class="form-control" id="event" name="event" value="{{ $event->event_name }}">
        <span class="text-danger">
          @error('event')
          {{ $message }}
          @enderror
        </span>
      </div>
      <div class="form-group">
        <label for="lokasi" class="col-form-label">Lokasi</label>
        <textarea class="form-control" id="lokasi" name="lokasi">{{ $event->location }}</textarea></textarea>
        <span class="text-danger">
          @error('lokasi')
          {{ $message }}
          @enderror
        </span>
      </div>
      <div class="row">
        <div class="col">
          <div class="form-group">
            <label for="provinsi">Provinsi</label>
            <select class="form-control" id="provinsi" name="provinsi">
              <option selected disabled>-- Pilih Provinsi --</option>
              @foreach ($provinces as $province)
              <option value="{{ $province->id }}" {{ old('provinsi', $event->province_id) == $province->id ? 'selected' : '' }}>{{ $province->province_name }}</option>
              @endforeach
            </select>
            <span class="text-danger">
              @error('provinsi')
              {{ $message }}
              @enderror
            </span>
          </div>
        </div>
        <div class="col">
          <div class="form-group">
            <label for="kategori">Kategori</label>
            <select class="form-control disabled" id="kategori" name="kategori">
              <option selected disabled>-- Pilih Kategori --</option>
              @foreach ($categories as $category)
              <option value="{{ $category->id }}" {{ old('kategori', $event->category_id) == $category->id ? 'selected' : '' }}>{{ $category->category_name }}</option>
              @endforeach
              <option class="text-primary" value="0">Tambah Kategori</option>
            </select>
            <span class="text-danger">
              @error('kategori')
              {{ $message }}
              @enderror
            </span>
          </div>
        </div>
      </div>
      <div class="form-group d-none" id="new-kategori-input">
        <label for="new_kategori" class="col-form-label">Kategori Baru</label>
        <input type="text" class="form-control" id="new_kategori" name="new_kategori">
        <span class="text-danger">
          @error('new_kategori')
          {{ $message }}
          @enderror
        </span>
      </div>
      <div class="form-group">
        <label for="deskripsi" class="col-form-label">Deskripsi</label>
        <textarea class="form-control" id="deskripsi" name="deskripsi">{{ $event->description }}</textarea>
        <span class="text-danger">
          @error('deskripsi')
          {{ $message }}
          @enderror
        </span>
      </div>
      <div class="form-group">
        <label for="informasi" class="col-form-label">Informasi</label>
        <textarea class="form-control" id="informasi" name="informasi">{{ $event->information }}</textarea>
        <span class="text-danger">
          @error('informasi')
          {{ $message }}
          @enderror
        </span>
      </div>
      <div class="form-group">
        <label for="gambar" class="col-form-label">Gambar</label>
        <input type="hidden" name="old_image" value="{{ $event->image }}">
        <input type="file" class="form-control-file" id="gambar" name="gambar">
        <span class="text-danger">
          @error('gambar')
          {{ $message }}
          @enderror
        </span>
      </div>
      @if ($event->image)
      <div class="img-holder mb-3" id="img-hold"><img src="{{ asset('storage/' . $event->image) }}" style="width: 150px;"></div>
      @else
      <div class="img-holder" id="img-hold"></div>
      @endif
      <div class="row">
        <div class="col">
          <div class="form-group">
            <label for="mulai">Waktu Mulai</label>
            <input type="datetime-local" class="form-control" id="mulai" name="mulai" value="{{ $event->start_date }}">
            <span class="text-danger">
              @error('mulai')
              {{ $message }}
              @enderror
            </span>
          </div>
        </div>
        <div class="col">
          <div class="form-group">
            <label for="selesai">Waktu Selesai</label>
            <input type="datetime-local" class="form-control" id="selesai" name="selesai" value="{{ $event->end_date }}">
            <span class="text-danger">
              @error('selesai')
              {{ $message }}
              @enderror
            </span>
          </div>
        </div>
      </div>
      <a href="{{ route('event') }}" class="btn btn-danger"><i class="fas fa-backspace"></i> Cancel</a>
      <button type="submit" class="btn btn-primary">Update</button>
    </form>
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

  //reset input file
  $('input[type="file"][name="gambar"]').val('');
  //image preview
  $('input[type="file"][name="gambar"]').on('change', function() {
    var img_path = $(this)[0].value;
    var img_holder = $('.img-holder');
    var extension = img_path.substring(img_path.lastIndexOf('.') + 1).toLowerCase();

    if (extension == 'jpeg' || extension == 'jpg' || extension == 'png') {
      if (typeof(FileReader) != 'undefined') {
        img_holder.empty();
        var reader = new FileReader();
        reader.onload = function(e) {
          $('<img/>', {
            'src': e.target.result
            , 'class': 'img-fluid center'
            , 'style': 'width:150px;length:150px;margin-bottom:25px;'
          }).appendTo(img_holder);
        }
        img_holder.show();
        reader.readAsDataURL($(this)[0].files[0]);
      } else {
        $(img_holder).html('Maaf browser anda tidak support FileReader');
      }
    } else {
      $(img_holder).html('Maaf file yang anda masukkan tidak mendukung');
    }
  })

</script>
@endpush

@endsection
