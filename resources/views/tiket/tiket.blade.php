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

@if (session('success'))
<div class="alert alert-success">
  {{ session('success') }}
</div>
@endif

<div class="card shadow">
  <div class="card-header">
    <div class="d-flex justify-content-between">
      <h6 class="m-0 font-weight-bold text-primary">Ticket List</h6>
      <a href="{{ route('ticket.create') }}" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm">
        <i class="fas fa-plus-circle fa-sm text-white-50"></i> Add Ticket</a>
    </div>
  </div>
  <div class="card-body">
    <table id="tiketTables" class="table table-striped table-bordered" style="width:100%">
      <thead>
        <tr>
          <th>No</th>
          <th>Event</th>
          <th>Nama</th>
          <th>Harga</th>
          <th>Kuota</th>
          <th>Keterangan</th>
        </tr>
      </thead>
      <tfoot>
        <tr>
          <th>No</th>
          <th>Event</th>
          <th>Nama</th>
          <th>Harga</th>
          <th>Kuota</th>
          <th>Keterangan</th>
        </tr>
      </tfoot>
    </table>
  </div>
</div>

@include('partials.check-event-modal')



@push('js')
<script src="{{ asset('js/dataTables.js') }}"></script>

<script>
  $(document).ready(function() {
    tiketTable();

    $('#btn-add').on('click', function() {
      $('#eventModal').modal('show');
      $('#modalLabel').text('Add Event');

      //get value from selected province

      $('#kategori').off('change').on('change', function() {
        if ($(this).val() == '0') {
          $('#new-kategori-input').removeClass('d-none');
        } else {
          $('#new-kategori-input').addClass('d-none');
        }
      });
    })
  });

  $(document).on('click', '.btn-check', function() {
    var table = $('#eventTables').DataTable();
    var view_id = $(this).data('id');

    $.ajax({
      url: '/events/' + view_id + '/show'
      , dataType: "json"
      , success: function(html) {
        $('#viewModal').modal('show');
        console.log(html.province.province_name);
        $('#modalLabel').text('Detail Event');
        //munculkan gambar
        $("#event-img").attr("src", "storage/" + html.event.image);
        $("#event").text(html.event.event_name);
        $("#lokasi").text(html.event.location);
        $("#provinsi").text(html.province.province_name);
        $("#kategori").text(html.category.category_name);
        $("#deskripsi").text(html.event.description);
        $("#informasi").text(html.event.information);
        $("#mulai").text(html.event.start_date);
        $("#akhir").text(html.event.end_date);
      }
    })
  });

  $(document).on('click', '.btn-hapus', function() {
    let table = $('#eventTables').DataTable();
    let id = $(this).data('id');
    var token = $("meta[name='csrf-token']").attr("content");

    Swal.fire({
      title: 'Anda yakin?'
      , text: "Data akan dihapus secara permanen loh..."
      , icon: 'warning'
      , showCancelButton: true
      , confirmButtonColor: '#3085d6'
      , cancelButtonColor: '#d33'
      , cancelButtonText: 'Batal'
      , confirmButtonText: 'Ya, hapus!'
    }).then((result) => {
      if (result.isConfirmed) {
        $.ajax({
          type: "delete"
          , url: "/events/destroy/" + id
          , data: {
            "id": id
            , "_token": token
          , }
          , success: function(response) {
            Swal.fire(
              'Berhasil!'
              , 'Data berhasil dihapus.'
              , 'success'
            )
            table.ajax.reload();
          }
        });
      }
    })
  });

  function tiketTable() {
    $("#tiketTables").DataTable({
      lengthChange: true
      , autoWidth: false
      , serverside: true
      , responsive: true
      , ajax: {
        url: "{{ route('ticket.datatables') }}"
      }
      , columns: [{
          "data": null
          , "sortable": false
          , render: function(data, type, row, meta) {
            return meta.row + meta.settings._iDisplayStart + 1
          }
        }
        , {
          data: 'event'
          , name: 'event'
        }
        , {
          data: 'nama'
          , name: 'nama'
        }
        , {
          data: 'harga'
          , name: 'harga'
        }
        , {
          data: 'kuota'
          , name: 'kuota'
        }
        , {
          data: 'keterangan'
          , name: 'keterangan'
        }
      , ]
    })
  }

</script>
@endpush

@endsection
