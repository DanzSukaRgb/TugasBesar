@extends('layouts.app')

@section('title', 'Data Pembeli')

@section('content')
<div class="container-fluid">
    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4 gap-3">
                <a href="{{ route('pembeli.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus-circle me-1"></i>
                </a>

                <form action="{{ route('pembeli.index') }}" method="GET" class="w-100" style="max-width: 400px">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Cari pembeli..." name="search" value="{{ request('search') }}">
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
                            <th>Nama</th>
                            <th width="15%">Jenis Kelamin</th>
                            <th>Alamat</th>
                            <th width="15%">No HP</th>
                            <th width="15%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($pembelis as $index => $pembeli)
                        <tr>
                            <td>{{ $pembelis->firstItem() + $index }}</td>
                            <td>{{ $pembeli->nama }}</td>
                            <td>{{ ucfirst($pembeli->jenis_kelamin) }}</td>
                            <td class="text-truncate" style="max-width: 200px" title="{{ $pembeli->alamat }}">
                                {{ $pembeli->alamat }}
                            </td>
                            <td>{{ $pembeli->no_hp }}</td>
                            <td>
                                <div class="d-flex gap-2">
                                    <a href="{{ route('pembeli.show', $pembeli->id) }}" class="btn btn-sm btn-info text-white" title="Lihat">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('pembeli.edit', $pembeli->id) }}" class="btn btn-sm btn-warning text-white" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('pembeli.destroy', $pembeli->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus pembeli ini?')">
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
                            <td colspan="6" class="text-center py-4">
                                <div class="text-muted">
                                    <i class="fas fa-database fa-2x mb-2"></i>
                                    <p>Data pembeli tidak ditemukan</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($pembelis->hasPages())
            <div class="d-flex justify-content-center mt-3">
                {{ $pembelis->withQueryString()->links() }}
            </div>
            @endif
        </div>
    </div>
</div>
@endsection
