@extends('layouts.template')

@section('content')
    <div class="card card-outline card-primary">
        <div class="card-header">
            <h3 class="card-title">Profil Saya</h3>
        </div>
        <div class="card-body text-center">
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            @php
                $user = Auth::user();
            @endphp

            <div class="mb-4">
                @if ($user->photo_profile)
                    <img src="{{ asset('storage/photo/' . $user->photo_profile) }}" alt="Profile Photo" class="img-thumbnail"
                        width="150">
                @else
                    <img src="{{ asset('images/default-profile.png') }}" alt="Default Photo" class="img-thumbnail"
                        width="150">
                @endif
            </div>

            <h4>{{ $user->nama }}</h4>

            <div class="mt-3">
                <button onclick="openEditModal()" class="btn btn-primary">Edit Profil</button>
            </div>
        </div>
        <div id="modalEditProfile" class="modal fade" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-md" role="document">
                <div class="modal-content"></div>
            </div>
        </div>

    </div>
@endsection
@push('js')
    <script>
        function openEditModal() {
            $.ajax({
                url: "{{ route('profile.create.ajax') }}",
                type: "GET",
                success: function(response) {
                    $('#modalEditProfile .modal-content').html(response);
                    $('#modalEditProfile').modal('show');
                },
                error: function() {
                    alert('Gagal memuat form edit.');
                }
            });
        }
    </script>
@endpush
