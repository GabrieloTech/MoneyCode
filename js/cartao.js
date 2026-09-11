document.addEventListener('DOMContentLoaded', () => {
    // Referências do Modal de Notícias
    const modal = document.getElementById('modal');
    const modalTitle = document.getElementById('modal-title');
    const modalText = document.getElementById('modal-text');
    const modalImg = document.getElementById('modal-img');
    const modalTag = document.getElementById('modal-tag');
    const closeModalBtn = document.getElementById('close-modal');

    // Referências dos Cards e Filtros
    const filterPills = document.querySelectorAll('.cat-pill');
    const newsCards = document.querySelectorAll('.card-noticia');

    // ==========================================
    // 1. FILTRAGEM DINÂMICA DE CATEGORIAS
    // ==========================================
    filterPills.forEach(pill => {
        pill.addEventListener('click', () => {
            filterPills.forEach(p => p.classList.remove('active'));
            pill.classList.add('active');

            const selectedCategory = pill.getAttribute('data-category');

            newsCards.forEach(card => {
                const cardCategory = card.getAttribute('data-categoria') || '';

                if (selectedCategory === 'all' || cardCategory.includes(selectedCategory)) {
                    card.style.display = 'flex';
                    card.style.animation = 'fadeIn 0.4s ease forwards';
                } else {
                    card.style.display = 'none';
                }
            });
        });
    });

    // ==========================================
    // 2. LÓGICA DO MODAL DE NOTÍCIAS
    // ==========================================
    function abrirModal(titulo, conteudoHTML, tag = 'NOTÍCIA', imagem = '') {
        if (!modal) return;

        modalTitle.innerText = titulo;
        modalText.innerHTML = conteudoHTML; 
        modalTag.innerText = tag.toUpperCase();

        if (imagem && imagem.trim() !== '') {
            modalImg.src = imagem;
            modalImg.parentElement.style.display = 'block';
        } else {
            modalImg.parentElement.style.display = 'none';
        }

        modal.classList.add('is-active');
        modal.setAttribute('aria-hidden', 'false');
        document.body.style.overflow = 'hidden';
    }

    function fecharModal() {
        if (!modal) return;

        modal.classList.remove('is-active');
        modal.setAttribute('aria-hidden', 'true');
        // Só restaura o scroll se nenhum modal legal estiver aberto
        if (!document.querySelector('.modal-legal-overlay.active')) {
            document.body.style.overflow = 'auto';
        }
    }

    // Eventos de clique nos cards
    newsCards.forEach(card => {
        const dispararModal = () => {
            const titulo = card.getAttribute('data-titulo');
            const tag = card.getAttribute('data-tag');
            const imagem = card.getAttribute('data-imagem');
            
            // BUSCANDO O HTML ESCONDIDO DENTRO DA DIV
            const materiaCompleta = card.querySelector('.materia-completa');
            const conteudoHTML = materiaCompleta ? materiaCompleta.innerHTML : '';
            
            abrirModal(titulo, conteudoHTML, tag, imagem);
        };

        card.addEventListener('click', dispararModal);

        card.addEventListener('keydown', (e) => {
            if (e.key === 'Enter' || e.key === ' ') {
                e.preventDefault();
                dispararModal();
            }
        });
    });

    if (closeModalBtn) {
        closeModalBtn.addEventListener('click', fecharModal);
    }

    window.addEventListener('click', (event) => {
        if (event.target === modal) fecharModal();
    });

    window.addEventListener('keydown', (event) => {
        if (event.key === 'Escape' && modal && modal.classList.contains('is-active')) {
            fecharModal();
        }
    });

   
    // ==========================================
    // 4. LÓGICA DOS MODAIS LEGAIS (Termos e Privacidade)
    // ==========================================
    const modalTermos = document.getElementById('modal-termos');
    const modalPrivacidade = document.getElementById('modal-privacidade');
    
    const btnOpenTermos = document.getElementById('open-termos');
    const btnOpenPrivacidade = document.getElementById('open-privacidade');
    
    const btnsCloseLegais = document.querySelectorAll('.modal-legal-close');

    function abrirModalLegal(modalElement) {
        if (!modalElement) return;
        modalElement.classList.add('active');
        document.body.style.overflow = 'hidden';
    }

    function fecharModaisLegais() {
        if (modalTermos) modalTermos.classList.remove('active');
        if (modalPrivacidade) modalPrivacidade.classList.remove('active');
        
        if (modal && !modal.classList.contains('is-active')) {
            document.body.style.overflow = 'auto';
        }
    }

    if (btnOpenTermos) {
        btnOpenTermos.addEventListener('click', (e) => {
            e.preventDefault();
            abrirModalLegal(modalTermos);
        });
    }

    if (btnOpenPrivacidade) {
        btnOpenPrivacidade.addEventListener('click', (e) => {
            e.preventDefault();
            abrirModalLegal(modalPrivacidade);
        });
    }

    btnsCloseLegais.forEach(btn => {
        btn.addEventListener('click', fecharModaisLegais);
    });

    window.addEventListener('click', (event) => {
        if (event.target === modalTermos || event.target === modalPrivacidade) {
            fecharModaisLegais();
        }
    });

    window.addEventListener('keydown', (event) => {
        if (event.key === 'Escape') {
            fecharModaisLegais();
        }
    });
});