{{-- Confirm Navigation Modal --}}
<div id="confirm-modal-overlay" class="confirm-modal-overlay" style="display: none;">
    <div class="confirm-modal">
        {{-- Close button --}}
        <button id="confirm-modal-close" class="confirm-modal-close" aria-label="Tutup">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <line x1="18" y1="6" x2="6" y2="18"></line>
                <line x1="6" y1="6" x2="18" y2="18"></line>
            </svg>
        </button>

        {{-- Icon --}}
        <div class="confirm-modal-icon">
            <img id="confirm-modal-logo" src="" alt="App Logo" class="confirm-modal-app-logo">
        </div>

        {{-- Content --}}
        <h3 class="confirm-modal-title">Konfirmasi Kunjungan</h3>
        <p class="confirm-modal-message">
            Anda akan mengunjungi halaman detail aplikasi
            <strong id="confirm-modal-app-name"></strong>.
            Lanjutkan?
        </p>

        {{-- Buttons --}}
        <div class="confirm-modal-actions">
            <button id="confirm-modal-cancel" class="confirm-modal-btn confirm-modal-btn-cancel">
                Batal
            </button>
            <button id="confirm-modal-confirm" class="confirm-modal-btn confirm-modal-btn-confirm">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    style="margin-right: 6px;">
                    <path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"></path>
                    <polyline points="15 3 21 3 21 9"></polyline>
                    <line x1="10" y1="14" x2="21" y2="3"></line>
                </svg>
                Kunjungi
            </button>
        </div>
    </div>
</div>
