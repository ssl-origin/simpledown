// === VARIÁVEIS GLOBAIS ===
let currentPage = 1;
let itemsPerPage = 6; // ajuste se quiser (ex: 9 no grid)
let totalVisible = 0;
let currentView = 'grid'; // rastreia o modo atual

// === FUNÇÃO PRINCIPAL DE FILTROS + ORDENAÇÃO + PAGINAÇÃO ===
function applyFilters() {
    const categoryValue = document.getElementById('category-filter').value || 'all';
    const searchValue = document.getElementById('search-input').value.trim().toLowerCase();
    // Mudamos o fallback para 'date-desc' (Mais recente) como padrão
    const sortValue = document.getElementById('sort-filter').value || 'date-desc';

    if (sortValue) {
        document.cookie = "simpledown_sort=" + sortValue + "; path=/; max-age=" + (30*24*60*60);
    }

    const gridContainer = document.getElementById('view-grid-container');
    const listContainer = document.getElementById('view-list-container');
    const activeContainer = currentView === 'list' ? listContainer : gridContainer;

    const selector = currentView === 'list' ? '.list-item' : '.simpledown-card';
    const items = Array.from(activeContainer.querySelectorAll(selector));

    // === Filtragem ===
    items.forEach(item => {
        const catId = item.getAttribute('data-cat-id') || '0';
        const title = item.querySelector(currentView === 'list' ? '.list-title' : '.file-title')?.textContent.toLowerCase() || '';
        const desc = item.querySelector(currentView === 'list' ? '.list-description' : '.file-description')?.textContent.toLowerCase() || '';
        const matchesCategory = categoryValue === 'all' || catId === categoryValue;
        const matchesSearch = searchValue === '' || title.includes(searchValue) || desc.includes(searchValue);
        item.style.display = matchesCategory && matchesSearch ? '' : 'none';
    });

    // === Coleta visíveis e ocultos + Ordenação ===
    let visibleItems = items.filter(item => item.style.display !== 'none');
    let hiddenItems = items.filter(item => item.style.display === 'none');

    visibleItems.sort((a, b) => {
        let cmp = 0;
        const titleSelector = currentView === 'list' ? '.list-title' : '.file-title';

        if (sortValue === 'name-asc' || sortValue === 'name-desc') {
            const nameA = a.querySelector(titleSelector)?.textContent.trim().toLowerCase() || '';
            const nameB = b.querySelector(titleSelector)?.textContent.trim().toLowerCase() || '';
            cmp = nameA.localeCompare(nameB);
            if (sortValue === 'name-desc') cmp = -cmp;

        } else if (sortValue.includes('downloads')) {
            const dlSelector = currentView === 'list' ? '.info-downloads' : '.file-info-row span:first-child';
            const dlA = parseInt(a.querySelector(dlSelector)?.textContent.replace(/\D/g, '') || '0');
            const dlB = parseInt(b.querySelector(dlSelector)?.textContent.replace(/\D/g, '') || '0');
            cmp = dlB - dlA;
            if (sortValue === 'downloads-asc') cmp = -cmp;

        } else if (sortValue.includes('size')) {
            const sizeSelector = currentView === 'list' ? '.info-size' : '.file-info-row span:last-child';
            const sizeA = parseSize(a.querySelector(sizeSelector)?.textContent.trim() || '0');
            const sizeB = parseSize(b.querySelector(sizeSelector)?.textContent.trim() || '0');
            cmp = sizeB - sizeA;
            if (sortValue === 'size-asc') cmp = -cmp;

        } else if (sortValue === 'date-desc' || sortValue === 'date-asc') {
            const dateA = parseInt(a.getAttribute('data-date') || '0', 10);
            const dateB = parseInt(b.getAttribute('data-date') || '0', 10);
            cmp = dateB - dateA; // maior timestamp = mais recente
            if (sortValue === 'date-asc') cmp = -cmp;
        }

        return cmp;
    });

    // === Reordenação correta no DOM (visíveis primeiro, depois ocultos) ===
    while (activeContainer.firstChild) {
        activeContainer.removeChild(activeContainer.firstChild);
    }
    visibleItems.forEach(item => activeContainer.appendChild(item));
    hiddenItems.forEach(item => activeContainer.appendChild(item));

    totalVisible = visibleItems.length;
    currentPage = 1;
    paginate();

    // Mensagem vazia
    const emptyMessage = document.getElementById('search-empty-message');
    if (emptyMessage) {
        emptyMessage.style.display = totalVisible === 0 ? 'block' : 'none';
    }
}

// === PAGINAÇÃO ===
function paginate() {
    const activeContainer = currentView === 'list' ? document.getElementById('view-list-container') : document.getElementById('view-grid-container');
    const selector = currentView === 'list' ? '.list-item' : '.simpledown-card';
    const items = Array.from(activeContainer.querySelectorAll(selector));

    // Oculta todos
    items.forEach(item => item.style.display = 'none');

    // Mostra apenas a página atual (respeitando totalVisible)
    const startIndex = (currentPage - 1) * itemsPerPage;
    const endIndex = startIndex + itemsPerPage;
    for (let i = startIndex; i < endIndex && i < totalVisible; i++) {
        items[i].style.display = '';
    }

    const totalPages = Math.ceil(totalVisible / itemsPerPage);
    const paginationWrapper = document.getElementById('pagination-wrapper');
    const pageInfo = document.getElementById('page-info');
    const prevBtn = document.getElementById('prev-page');
    const nextBtn = document.getElementById('next-page');
    const itemsStart = document.getElementById('items-start');
    const itemsEnd = document.getElementById('items-end');
    const itemsTotal = document.getElementById('items-total');

    if (totalVisible === 0 || totalPages <= 1) {
        paginationWrapper.style.display = 'none';
    } else {
        paginationWrapper.style.display = 'block';
	pageInfo.textContent = `${PAGE_LABEL} ${currentPage} ${OF_LABEL} ${totalPages}`;
        itemsStart.textContent = totalVisible > 0 ? startIndex + 1 : 0;
        itemsEnd.textContent = Math.min(endIndex, totalVisible);
        itemsTotal.textContent = totalVisible;
        prevBtn.disabled = currentPage === 1;
        nextBtn.disabled = currentPage === totalPages;
    }
}

// === AUXILIARES ===
function parseSize(sizeStr) {
    const matches = sizeStr.match(/([\d.]+)\s*(bytes|KB|MB|GB)/i);
    if (!matches) return 0;
    const value = parseFloat(matches[1]);
    const unit = matches[2].toLowerCase();
    switch (unit) {
        case 'gb': return value * 1073741824;
        case 'mb': return value * 1048576;
        case 'kb': return value * 1024;
        case 'bytes': return value;
        default: return 0;
    }
}

function handleDownloadClick(element) {
    const isPrivate = element.getAttribute('data-private') === '1';
    const downloadUrl = element.getAttribute('data-download-url');
    const deniedUrl = element.getAttribute('data-denied-url');

    if (isPrivate && !SIMPLE_DOWN_IS_LOGGED_IN) {
        document.getElementById('login-required-modal').style.display = 'flex';
        if (deniedUrl) {
            fetch(deniedUrl, { method: 'GET', credentials: 'same-origin' }).catch(() => {});
        }
        return;
    }
    window.location.href = downloadUrl;
}

function openImageModal(param) {
    let src = (typeof param === 'string') ? param : param.getAttribute('data-preview-route');
    if (!src) return;
    const modal = document.getElementById('image-modal');
    const img = document.getElementById('modal-image');
    img.src = src + (src.indexOf('?') === -1 ? '?t=' : '&t=') + Date.now();
    modal.style.display = 'flex';
    document.body.style.overflow = 'hidden';
}

function closeImageModal() {
    document.getElementById('image-modal').style.display = 'none';
    document.body.style.overflow = 'auto';
}

// === TOGGLE GRID / LIST ===
const viewToggle = document.querySelector('.view-mode-toggle');
if (viewToggle) {
    const gridBtn = document.getElementById('view-grid');
    const listBtn = document.getElementById('view-list');
    const gridContainer = document.getElementById('view-grid-container');
    const listContainer = document.getElementById('view-list-container');

    const setView = (mode) => {
        currentView = mode;

        if (mode === 'list') {
            gridContainer.style.display = 'none';
            listContainer.style.display = '';
            gridBtn.classList.remove('active');
            listBtn.classList.add('active');
        } else {
            gridContainer.style.display = '';
            listContainer.style.display = 'none';
            gridBtn.classList.add('active');
            listBtn.classList.remove('active');
        }

        document.cookie = `simpledown_view_mode=${mode}; path=/; max-age=${365*24*60*60}`;
        applyFilters();
    };

    gridBtn.addEventListener('click', () => setView('grid'));
    listBtn.addEventListener('click', () => setView('list'));

    let savedMode = 'grid';
    document.cookie.split('; ').forEach(cookie => {
        const [name, value] = cookie.split('=');
        if (name === 'simpledown_view_mode' && (value === 'grid' || value === 'list')) {
            savedMode = value;
        }
    });

    setView(savedMode);
}

// === EVENTOS DOM ===
document.addEventListener('DOMContentLoaded', () => {
    const searchInput = document.getElementById('search-input');
    const clearBtn = document.getElementById('search-clear-btn');
    const searchOuter = document.querySelector('.search-box-outer');

    const updateClearButton = () => {
        const hasValue = searchInput.value.trim().length > 0;
        clearBtn.style.display = hasValue ? 'flex' : 'none';
        searchOuter.classList.toggle('has-value', hasValue);
    };

    searchInput.addEventListener('input', applyFilters);
    document.getElementById('category-filter')?.addEventListener('change', applyFilters);
    document.getElementById('sort-filter')?.addEventListener('change', applyFilters);

    clearBtn.addEventListener('click', () => {
        searchInput.value = '';
        searchInput.focus();
        updateClearButton();
        applyFilters();
    });

    document.getElementById('prev-page')?.addEventListener('click', () => {
        if (currentPage > 1) {
            currentPage--;
            paginate();
        }
    });

    document.getElementById('next-page')?.addEventListener('click', () => {
        const totalPages = Math.ceil(totalVisible / itemsPerPage);
        if (currentPage < totalPages) {
            currentPage++;
            paginate();
        }
    });

    window.addEventListener('click', (event) => {
        if (event.target.id === 'image-modal') closeImageModal();
        if (event.target.id === 'login-required-modal') document.getElementById('login-required-modal').style.display = 'none';
    });

    updateClearButton();
});