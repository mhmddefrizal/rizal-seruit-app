{{-- App Detail Modal --}}
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

        {{-- App Logo & Name Header --}}
        <div class="confirm-modal-header">
            <div class="confirm-modal-icon">
                <img id="confirm-modal-logo" src="" alt="App Logo" class="confirm-modal-app-logo">
            </div>
            <div class="confirm-modal-header-text">
                <h3 id="confirm-modal-app-name" class="confirm-modal-title"></h3>
            </div>
        </div>

        {{-- App Info --}}
        <div class="confirm-modal-info">
            <div class="confirm-modal-info-item">
                <div class="confirm-modal-info-label">
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line></svg>
                    Deskripsi
                </div>
                <p id="confirm-modal-deskripsi" class="confirm-modal-info-value"></p>
            </div>
            <div class="confirm-modal-info-row">
                <div class="confirm-modal-info-item confirm-modal-info-half">
                    <div class="confirm-modal-info-label">
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg>
                        Akses
                    </div>
                    <span id="confirm-modal-akses" class="confirm-modal-badge"></span>
                </div>
                <div class="confirm-modal-info-item confirm-modal-info-half">
                    <div class="confirm-modal-info-label">
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                        Pengguna
                    </div>
                    <p id="confirm-modal-pengguna" class="confirm-modal-info-value"></p>
                </div>
            </div>
        </div>

        {{-- Action Button --}}
        <div class="confirm-modal-actions">
            <button id="confirm-modal-cancel" class="confirm-modal-btn confirm-modal-btn-cancel">
                Batal
            </button>
            <a id="confirm-modal-link" href="#" target="_blank" class="confirm-modal-btn confirm-modal-btn-confirm">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    style="margin-right: 6px;">
                    <path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"></path>
                    <polyline points="15 3 21 3 21 9"></polyline>
                    <line x1="10" y1="14" x2="21" y2="3"></line>
                </svg>
                Kunjungi
            </a>
        </div>
    </div>
</div>
