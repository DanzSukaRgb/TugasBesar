@extends('layouts.app')

@section('title', 'Data Supplier')

@section('content')
<div class="container-fluid">
    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4 gap-3">
                <a href="{{ route('supplier.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus-circle me-1"></i>
                </a>

                <form action="{{ route('supplier.index') }}" method="GET" class="w-100" style="max-width: 400px">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Cari supplier..." name="search" value="{{ request('search') }}">
                        <button class="btn btn-outline-secondary" type="submit">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </form>
            </div>

            <div class="table-responsive">
                <table class="table table-hover table-striped">
                    <thead class="table-light">
                        <tr>
                            <th width="5%">No</th>
                            <th>Nama Supplier</th>
                            <th>Alamat</th>
                            <th width="12%">Kode Pos</th>
                            <th width="15%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($suppliers as $index => $supplier)
                        <tr>
                            <td>{{ $suppliers->firstItem() + $index }}</td>
                            <td>{{ $supplier->nama }}</td>
                            <td class="text-truncate" style="max-width: 200px" title="{{ $supplier->alamat }}">
                                {{ $supplier->alamat }}
                            </td>
                            <td>{{ $supplier->kode_pos }}</td>
                            <td>
                                <div class="d-flex gap-2">
                                    <a href="{{ route('supplier.show', $supplier->id) }}" class="btn btn-sm btn-info text-white" title="Detail">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('supplier.edit', $supplier->id) }}" class="btn btn-sm btn-warning text-white" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('supplier.destroy', $supplier->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus supplier ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" title="Hapus">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center py-4">
                                <div class="text-muted">
                                    <i class="fas fa-database fa-2x mb-2"></i>
                                    <p>Data supplier tidak ditemukan</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($suppliers->hasPages())
            <div class="d-flex justify-content-center mt-3">
                {{ $suppliers->withQueryString()->links() }}
            </div>
            @endif
        </div>
    </div>
</div>
@endsection
