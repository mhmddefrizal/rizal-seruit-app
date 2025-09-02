@extends('layouts.auth')

@section('content')
  <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
    <div class="p-6 bg-white border-b border-gray-200">
      <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-semibold text-gray-800">Manajemen Aplikasi</h2>
        <a href="{{ route('listapp.create') }}"
          class="px-4 py-2 bg-blue-600 text-white font-semibold rounded-lg shadow-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-75">
          <i class="fa fa-plus mr-2"></i>Tambah Aplikasi
        </a>
      </div>

      <!-- Tabel Data -->
      <div class="overflow-x-auto">
        <table id="applications-table" class="min-w-full divide-y divide-gray-200">
          <thead class="bg-gray-50">
            <tr>
              <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No
              </th>
              <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                Nama Aplikasi</th>
              <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                Pengguna</th>
              <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                Pembuat</th>
              <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                Akses</th>
              <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                Hits</th>
              <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                Aksi</th>
            </tr>
          </thead>
          <tbody class="bg-white divide-y divide-gray-200">
            @php
              $idx = 1;
            @endphp
            @foreach ($list_apps as $app)
              <tr>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $idx }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                  <a href="{{ $app['link'] }}" class="text-indigo-500" target="_blank">{{ $app['nama'] }}</a>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                  {{ $app['pengguna'] }}
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                  {{ $app['pembuat'] }}
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                  {{ $app['akses'] }}
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                  {{ $app['hits'] }}
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                  <button data-modal-toggle="show-modal" class="text-green-600 hover:text-green-900 mx-2"><i
                      class="fa fa-eye"></i></button>
                  <button data-modal-toggle="edit-modal" class="text-indigo-600 hover:text-indigo-900 mx-2"><i
                      class="fa fa-edit"></i></button>
                  <button data-modal-toggle="delete-modal" class="text-red-600 hover:text-red-900 mx-2"><i
                      class="fa fa-trash"></i></button>
                </td>
              </tr>
              @php
                $idx++;
              @endphp
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <!-- Modal Tambah Aplikasi -->
  <div id="add-modal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
    <div class="relative top-20 mx-auto p-5 border w-full max-w-2xl shadow-lg rounded-md bg-white">
      <div class="flex justify-between items-center pb-3 border-b">
        <p class="text-2xl font-bold">Tambah Aplikasi Baru</p>
        <div class="cursor-pointer z-50" data-modal-hide="add-modal">
          <i class="fa fa-times text-gray-500 hover:text-gray-800"></i>
        </div>
      </div>
      <div class="mt-5">
        <form action="{{ route('listapp.store') }}" method="POST" enctype="multipart/form-data">
          <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
              <label class="block text-gray-700">Nama</label>
              <input type="text"
                class="w-full mt-1 p-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            <div>
              <label class="block text-gray-700">Link</label>
              <input type="url"
                class="w-full mt-1 p-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            <div>
              <label class="block text-gray-700">Akses</label>
              <input type="text"
                class="w-full mt-1 p-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            <div>
              <label class="block text-gray-700">Pengguna</label>
              <input type="text"
                class="w-full mt-1 p-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            <div>
              <label class="block text-gray-700">Pembuat</label>
              <input type="text"
                class="w-full mt-1 p-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            <div>
              <label class="block text-gray-700">Hits</label>
              <input type="number"
                class="w-full mt-1 p-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            <div class="md:col-span-2">
              <label class="block text-gray-700">Deskripsi</label>
              <textarea class="w-full mt-1 p-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" rows="3"></textarea>
            </div>
            <div class="md:col-span-2">
              <label class="block text-gray-700">Logo (Default: logo_bps.png)</label>
              <input type="file"
                class="w-full mt-1 p-2 border rounded-md file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
            </div>
          </div>
          <div class="flex justify-end pt-4 mt-4 border-t">
            <button type="button" class="px-4 py-2 bg-gray-200 text-gray-800 rounded-lg hover:bg-gray-300 mr-2"
              data-modal-hide="add-modal">Batal</button>
            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">Simpan</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- Modal Edit Aplikasi (Struktur sama dengan Tambah) -->
  <div id="edit-modal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
    <div class="relative top-20 mx-auto p-5 border w-full max-w-2xl shadow-lg rounded-md bg-white">
      <div class="flex justify-between items-center pb-3 border-b">
        <p class="text-2xl font-bold">Edit Aplikasi</p>
        <div class="cursor-pointer z-50" data-modal-hide="edit-modal">
          <i class="fa fa-times text-gray-500 hover:text-gray-800"></i>
        </div>
      </div>
      <div class="mt-5">
        <form action="#" method="POST" enctype="multipart/form-data">
          <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
              <label class="block text-gray-700">Nama</label>
              <input type="text" value="Aplikasi A"
                class="w-full mt-1 p-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            <div>
              <label class="block text-gray-700">Link</label>
              <input type="url" value="https://example.com"
                class="w-full mt-1 p-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            <div>
              <label class="block text-gray-700">Akses</label>
              <input type="text" value="Publik"
                class="w-full mt-1 p-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            <div>
              <label class="block text-gray-700">Pengguna</label>
              <input type="text" value="Semua"
                class="w-full mt-1 p-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            <div>
              <label class="block text-gray-700">Pembuat</label>
              <input type="text" value="Tim IT"
                class="w-full mt-1 p-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            <div>
              <label class="block text-gray-700">Hits</label>
              <input type="number" value="120"
                class="w-full mt-1 p-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            <div class="md:col-span-2">
              <label class="block text-gray-700">Deskripsi</label>
              <textarea class="w-full mt-1 p-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                rows="3">Deskripsi singkat aplikasi A.</textarea>
            </div>
            <div class="md:col-span-2">
              <label class="block text-gray-700">Logo (Default: logo_bps.png)</label>
              <input type="file"
                class="w-full mt-1 p-2 border rounded-md file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
            </div>
          </div>
          <div class="flex justify-end pt-4 mt-4 border-t">
            <button type="button" class="px-4 py-2 bg-gray-200 text-gray-800 rounded-lg hover:bg-gray-300 mr-2"
              data-modal-hide="edit-modal">Batal</button>
            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">Update</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- Modal Tampil Detail -->
  <div id="show-modal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
    <div class="relative top-20 mx-auto p-5 border w-full max-w-lg shadow-lg rounded-md bg-white">
      <div class="flex justify-between items-center pb-3 border-b">
        <p class="text-2xl font-bold">Detail Aplikasi</p>
        <div class="cursor-pointer z-50" data-modal-hide="show-modal">
          <i class="fa fa-times text-gray-500 hover:text-gray-800"></i>
        </div>
      </div>
      <div class="mt-5 space-y-3">
        <div class="flex justify-center">
          <img src="https://via.placeholder.com/150" alt="Logo Aplikasi" class="w-32 h-32 object-cover rounded-lg">
        </div>
        <p><strong>Nama:</strong> Aplikasi A</p>
        <p><strong>Link:</strong> <a href="#" class="text-blue-600">https://example.com</a></p>
        <p><strong>Akses:</strong> Publik</p>
        <p><strong>Deskripsi:</strong> Deskripsi lengkap mengenai aplikasi A ada di sini.</p>
        <p><strong>Pengguna:</strong> Semua</p>
        <p><strong>Pembuat:</strong> Tim IT</p>
        <p><strong>Hits:</strong> 120</p>
        <div class="flex justify-end pt-4 mt-4 border-t">
          <button class="px-4 py-2 bg-gray-200 text-gray-800 rounded-lg hover:bg-gray-300"
            data-modal-hide="show-modal">Tutup</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal Konfirmasi Hapus -->
  <div id="delete-modal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
    <div class="relative top-1/3 mx-auto p-5 border w-full max-w-md shadow-lg rounded-md bg-white">
      <div class="mt-3 text-center">
        <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-red-100">
          <i class="fa fa-exclamation-triangle text-red-600 fa-lg"></i>
        </div>
        <h3 class="text-lg leading-6 font-medium text-gray-900 mt-5">Hapus Aplikasi</h3>
        <div class="mt-2 px-7 py-3">
          <p class="text-sm text-gray-500">
            Apakah Anda yakin ingin menghapus data aplikasi ini? Tindakan ini tidak dapat dibatalkan.
          </p>
        </div>
        <div class="items-center px-4 py-3">
          <button id="cancel-delete-button"
            class="px-4 py-2 bg-gray-200 text-gray-800 rounded-md hover:bg-gray-300 w-full sm:w-auto mb-2 sm:mb-0 sm:mr-2"
            data-modal-hide="delete-modal">
            Batal
          </button>
          <button id="confirm-delete-button"
            class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700 w-full sm:w-auto">
            Ya, Hapus
          </button>
        </div>
      </div>
    </div>
  </div>
@endsection

@push('scripts')
  <script>
    $(document).ready(function() {
      // Inisialisasi DataTables
      $('#applications-table').DataTable();

      // --- Logika untuk membuka dan menutup modal ---

      // Fungsi untuk membuka modal
      function openModal(modalId) {
        $('#' + modalId).removeClass('hidden');
      }

      // Fungsi untuk menutup modal
      function closeModal(modalId) {
        $('#' + modalId).addClass('hidden');
      }

      // Event listener untuk tombol yang membuka modal
      $('[data-modal-toggle]').on('click', function() {
        const modalId = $(this).data('modal-toggle');
        openModal(modalId);
      });

      // Event listener untuk elemen yang menutup modal
      $('[data-modal-hide]').on('click', function() {
        const modalId = $(this).data('modal-hide');
        closeModal(modalId);
      });

      // Menutup modal jika user mengklik di luar area modal
      $('.fixed.inset-0').on('click', function(e) {
        if ($(e.target).is($(this))) {
          $(this).addClass('hidden');
        }
      });

      // Tambah aplikasi

    });
  </script>
@endpush
