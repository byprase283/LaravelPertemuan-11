@extends('layouts.app')
@push('css')
<link href="https://cdn.datatables.net/1.13.5/css/jquery.dataTables.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.dataTables.min.css">
@endpush
@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                Laravel 12 Yajra DataTables
            </div>
            <table class="table data-table display responsive nowrap" style="width:100%">
                <thead>
                    <tr>
                        <th class="text-center" width="5%">No</th>
                        <th class="text-center">Nama</th>
                        <th class="text-center">Email</th>
                        <th class="text-center" width="20%">Aksi</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal View -->
<div class="modal fade" id="viewModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Detail User</h5>
            </div>
            <div class="modal-body">
                <p><strong>Nama:</strong> <span id="viewName"></span></p>
                <p><strong>Email:</strong> <span id="viewEmail"></span></p>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
@endsection
@push('js')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
<script type="text/javascript">
    $(function() {
        $('.data-table').DataTable({
            processing: true,
            serverSide: true,
            responsive: true,
            ajax: "{{ route('users.index') }}",
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex'
                },
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'email',
                    name: 'email'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                },
            ],
            columnDefs: [{
                className: "text-center",
                targets: [0, 3]
            }]
        });
    });

    $('body').on('click', '.viewUser', function() {
        var id = $(this).data('id');
        $.get("users/" + id, function(data) {
            $('#viewName').text(data.name);
            $('#viewEmail').text(data.email);
            $('#viewModal').modal('show');
        });
    });
</script>
@endpush