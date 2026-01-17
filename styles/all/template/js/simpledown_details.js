function handleDownloadClick(element) {
    const isPrivate = element.getAttribute('data-private') === '1';
    const downloadUrl = element.getAttribute('data-download-url');
    const deniedUrl = element.getAttribute('data-denied-url');

    if (isPrivate && !SIMPLE_DOWN_IS_LOGGED_IN) {
        // Abre o modal de login
        document.getElementById('login-required-modal').style.display = 'flex';
        // Registra acesso negado via AJAX (silencioso)
        if (deniedUrl) {
            fetch(deniedUrl, {
                method: 'GET',
                credentials: 'same-origin',
                cache: 'no-cache'
            })
            .then(() => {})
            .catch(() => {});
        }
        return;
    }
    // Download direto (público ou usuário logado)
    window.location.href = downloadUrl;
}

function openImageModal(src) {
    const modalImage = document.getElementById('modal-image');
    modalImage.src = src + (src.indexOf('?') === -1 ? '?t=' : '&t=') + Date.now();
    document.getElementById('image-modal').style.display = 'flex';
    document.body.style.overflow = 'hidden';
}

function closeImageModal() {
    document.getElementById('image-modal').style.display = 'none';
    document.body.style.overflow = 'auto';
}

// Fechar modais ao clicar no fundo
window.addEventListener('click', function(e) {
    if (e.target.id === 'image-modal') {
        closeImageModal();
    }
    if (e.target.id === 'login-required-modal') {
        e.target.style.display = 'none';
    }
});