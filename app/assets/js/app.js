/**
 * PHV Naturo - JavaScript interactif
 */

// Toggle collapse pour les sections du bilan
function toggleCollapse(id) {
    const el = document.getElementById(id);
    const icon = document.getElementById(id + '-icon');
    if (el) {
        if (el.style.display === 'none') {
            el.style.display = 'block';
            if (icon) icon.style.transform = 'rotate(180deg)';
        } else {
            el.style.display = 'none';
            if (icon) icon.style.transform = 'rotate(0deg)';
        }
    }
}

// Mise à jour des valeurs de score en temps réel
document.addEventListener('DOMContentLoaded', function() {
    // Score ranges
    document.querySelectorAll('input[type="range"]').forEach(function(range) {
        range.addEventListener('input', function() {
            const valueEl = this.nextElementSibling;
            if (valueEl && valueEl.classList.contains('score-value')) {
                valueEl.textContent = this.value;
            }
        });
    });

    // Auto-save indication
    const forms = document.querySelectorAll('form');
    forms.forEach(function(form) {
        let changed = false;
        form.addEventListener('change', function() {
            changed = true;
        });
        form.addEventListener('input', function() {
            changed = true;
        });

        // Avertir avant de quitter si modifications non sauvegardées
        window.addEventListener('beforeunload', function(e) {
            if (changed) {
                e.preventDefault();
                e.returnValue = '';
            }
        });

        // Désactiver l'avertissement lors de la soumission
        form.addEventListener('submit', function() {
            changed = false;
        });
    });

    // Animations d'entrée
    document.querySelectorAll('.animate-in').forEach(function(el, i) {
        el.style.animationDelay = (i * 0.1) + 's';
    });

    // Sidebar responsive toggle
    const menuToggle = document.getElementById('menuToggle');
    const sidebar = document.getElementById('sidebar');
    const sidebarOverlay = document.getElementById('sidebarOverlay');
    if (menuToggle && sidebar && sidebarOverlay) {
        menuToggle.addEventListener('click', function() {
            sidebar.classList.toggle('open');
            sidebarOverlay.classList.toggle('open');
        });
        sidebarOverlay.addEventListener('click', function() {
            sidebar.classList.remove('open');
            sidebarOverlay.classList.remove('open');
        });
    }

    // Flash message auto-dismiss
    document.querySelectorAll('.alert').forEach(function(alert) {
        setTimeout(function() {
            alert.style.opacity = '0';
            alert.style.transform = 'translateY(-10px)';
            alert.style.transition = 'all 0.3s ease';
            setTimeout(function() {
                alert.remove();
            }, 300);
        }, 5000);
    });

    // Initialiser le système de suggestions si on est sur la page PHV
    if (document.getElementById('phv-prefill-btn')) {
        initPhvSuggestions();
    }

    // Initialiser la recherche dans la base de connaissances
    if (document.getElementById('knowledge-search')) {
        initKnowledgeSearch();
    }

    // Tableaux responsives (accordéon sur mobile)
    initResponsiveTables();

    // Blocs structurés du PHV (cartes répétables : conseils, menu, ressources...)
    document.querySelectorAll('.block-editor').forEach(initBlockEditor);
});

/**
 * Éditeur générique de "blocs" répétables pour le PHV (conseils alimentaires,
 * menu type par repas, ressources externes...). Un seul composant JS piloté
 * par un schéma déclaré en data-attribute côté PHP : ajouter une nouvelle
 * section structurée ne demande pas de nouveau JS, juste un nouveau schéma.
 *
 * Le conteneur attend :
 *   data-field   : name du <input type="hidden"> qui stocke le JSON
 *   data-schema  : JSON [{key, label, type: "text"|"textarea", placeholder}]
 * et doit contenir un ".block-editor-list" et un bouton ".block-editor-add".
 */
function initBlockEditor(container) {
    let schema;
    try {
        schema = JSON.parse(container.dataset.schema || '[]');
    } catch (e) {
        schema = [];
    }
    const hidden = document.querySelector('input[type="hidden"][name="' + container.dataset.field + '"]');
    const list = container.querySelector('.block-editor-list');
    const addBtn = container.querySelector('.block-editor-add');
    if (!hidden || !list || !addBtn) return;

    let items;
    try {
        items = JSON.parse(hidden.value || '[]');
    } catch (e) {
        items = [];
    }
    if (!Array.isArray(items)) items = [];

    function sync() {
        hidden.value = JSON.stringify(items);
    }

    function render() {
        list.innerHTML = '';
        items.forEach(function(item, idx) {
            const card = document.createElement('div');
            card.className = 'block-editor-card';

            const fieldsWrap = document.createElement('div');
            fieldsWrap.className = 'block-editor-card-fields';
            schema.forEach(function(f) {
                const label = document.createElement('label');
                label.className = 'block-editor-label';
                label.textContent = f.label;
                fieldsWrap.appendChild(label);

                const input = f.type === 'textarea' ? document.createElement('textarea') : document.createElement('input');
                if (f.type === 'textarea') {
                    input.rows = 2;
                } else {
                    input.type = 'text';
                }
                input.className = 'form-control';
                input.value = item[f.key] || '';
                if (f.placeholder) input.placeholder = f.placeholder;
                input.addEventListener('input', function() {
                    items[idx][f.key] = input.value;
                    sync();
                });
                fieldsWrap.appendChild(input);
            });
            card.appendChild(fieldsWrap);

            const actions = document.createElement('div');
            actions.className = 'block-editor-card-actions';

            const upBtn = document.createElement('button');
            upBtn.type = 'button';
            upBtn.textContent = '↑';
            upBtn.title = 'Monter';
            upBtn.disabled = idx === 0;
            upBtn.addEventListener('click', function() {
                if (idx > 0) {
                    const tmp = items[idx - 1];
                    items[idx - 1] = items[idx];
                    items[idx] = tmp;
                    render();
                    sync();
                }
            });

            const downBtn = document.createElement('button');
            downBtn.type = 'button';
            downBtn.textContent = '↓';
            downBtn.title = 'Descendre';
            downBtn.disabled = idx === items.length - 1;
            downBtn.addEventListener('click', function() {
                if (idx < items.length - 1) {
                    const tmp = items[idx + 1];
                    items[idx + 1] = items[idx];
                    items[idx] = tmp;
                    render();
                    sync();
                }
            });

            const removeBtn = document.createElement('button');
            removeBtn.type = 'button';
            removeBtn.textContent = '✕';
            removeBtn.title = 'Supprimer';
            removeBtn.addEventListener('click', function() {
                items.splice(idx, 1);
                render();
                sync();
            });

            actions.appendChild(upBtn);
            actions.appendChild(downBtn);
            actions.appendChild(removeBtn);
            card.appendChild(actions);

            list.appendChild(card);
        });
    }

    addBtn.addEventListener('click', function() {
        const blank = {};
        schema.forEach(function(f) { blank[f.key] = ''; });
        items.push(blank);
        render();
        sync();
    });

    render();

    // Accessible depuis l'extérieur (ex: clic sur une suggestion) pour
    // ajouter une carte pré-remplie sans dupliquer la logique d'affichage.
    window.blockEditors = window.blockEditors || {};
    window.blockEditors[container.dataset.field] = {
        addItem: function(partial) {
            const blank = {};
            schema.forEach(function(f) { blank[f.key] = ''; });
            items.push(Object.assign(blank, partial));
            render();
            sync();
        }
    };
}

/**
 * Ajoute une suggestion comme nouvelle carte dans un block-editor (au lieu
 * de l'insérer dans un textarea). `field` = data-field du block-editor,
 * `targetKey` = clé du schéma qui reçoit le texte de la suggestion,
 * `titleKey` (optionnel) = clé du schéma qui reçoit le titre de la
 * suggestion (ex : "titre" pour pré-remplir le titre du conseil).
 */
function insertSuggestionAsCard(field, targetKey, element, titleKey) {
    const content = element.getAttribute('data-content');
    const editor = window.blockEditors && window.blockEditors[field];
    if (!content || !editor) return;
    const partial = {};
    partial[targetKey] = content;
    if (titleKey) {
        const titreEl = element.querySelector('.suggestion-titre');
        if (titreEl) partial[titleKey] = titreEl.textContent.trim();
    }
    editor.addItem(partial);
    element.classList.add('inserted');
}

/**
 * Rend les tableaux .table utilisables sur mobile : seule la 1re colonne
 * reste visible, un tap sur la ligne déplie les autres colonnes (avec leur
 * libellé récupéré depuis <thead>) et referme la ligne précédemment ouverte.
 * L'affichage réel (une seule colonne / défilement normal) est piloté par le
 * CSS (@media max-width:768px) ; ce script prépare la structure et le clic
 * dans tous les cas, sans impact visuel en desktop.
 */
function initResponsiveTables() {
    document.querySelectorAll('table.table:not(.table-editable)').forEach(function(table) {
        if (table.dataset.responsiveReady) return;
        table.dataset.responsiveReady = '1';

        const headers = Array.from(table.querySelectorAll('thead th')).map(function(th) {
            return th.textContent.trim();
        });
        const rows = table.querySelectorAll('tbody tr');

        rows.forEach(function(tr) {
            Array.from(tr.children).forEach(function(td, i) {
                if (i === 0) return;
                td.classList.add('row-hidden');
                const label = headers[i];
                if (label) {
                    const labelEl = document.createElement('span');
                    labelEl.className = 'row-detail-label';
                    labelEl.textContent = label;
                    td.insertBefore(labelEl, td.firstChild);
                }
            });

            tr.addEventListener('click', function(e) {
                if (e.target.closest('a, button, input, select, textarea, form, label')) {
                    return;
                }
                const wasExpanded = tr.classList.contains('row-expanded');
                rows.forEach(function(otherTr) {
                    otherTr.classList.remove('row-expanded');
                });
                if (!wasExpanded) {
                    tr.classList.add('row-expanded');
                }
            });
        });
    });
}

/**
 * Système de suggestions intelligentes pour le PHV
 */
function initPhvSuggestions() {
    const prefillBtn = document.getElementById('phv-prefill-btn');
    const consultId = prefillBtn?.dataset.consultationId;

    if (!prefillBtn || !consultId) return;

    prefillBtn.addEventListener('click', async function() {
        const btn = this;
        const originalText = btn.innerHTML;

        // État de chargement
        btn.disabled = true;
        btn.innerHTML = '<span class="spinner"></span> Génération en cours...';

        try {
            const response = await fetch(`?page=suggestions-api&action=phv-prefill&consultation_id=${consultId}`);
            const data = await response.json();

            if (data.error) {
                throw new Error(data.error);
            }

            // Remplir les champs avec confirmation
            if (confirm('Voulez-vous pré-remplir le PHV avec les suggestions basées sur le profil du client ?\n\nLes champs existants seront remplacés.')) {
                fillPhvFields(data.prefill);
                showNotification('PHV pré-rempli avec succès ! Pensez à personnaliser les conseils.', 'success');
            }
        } catch (error) {
            console.error('Erreur:', error);
            showNotification('Erreur lors de la génération des suggestions', 'error');
        } finally {
            btn.disabled = false;
            btn.innerHTML = originalText;
        }
    });
}

/**
 * Remplit les champs du formulaire PHV
 */
function fillPhvFields(prefill) {
    // Champs texte simples
    const fieldMap = {
        'alimentation': 'alimentation',
        'alimentation_eviter': 'alimentation_eviter',
        'alimentation_privilegier': 'alimentation_privilegier',
        'menu_type': 'menu_type',
        'gestion_stress': 'gestion_stress',
        'activite_physique': 'activite_physique',
        'routine_matin': 'routine_matin',
        'routine_soir': 'routine_soir',
        'soins_naturels': 'soins_naturels',
        'recommandations_complementaires': 'recommandations_complementaires'
    };

    for (const [prefillKey, fieldName] of Object.entries(fieldMap)) {
        const field = document.querySelector(`[name="${fieldName}"]`);
        if (field && prefill[prefillKey]) {
            field.value = prefill[prefillKey];
            // Déclencher l'événement change pour le suivi des modifications
            field.dispatchEvent(new Event('change', { bubbles: true }));
        }
    }

    // Compléments (champs multiples)
    if (prefill.complements && Array.isArray(prefill.complements)) {
        const nomFields = document.querySelectorAll('[name="complement_nom[]"]');
        const posoFields = document.querySelectorAll('[name="complement_posologie[]"]');
        const dureeFields = document.querySelectorAll('[name="complement_duree[]"]');

        prefill.complements.forEach((comp, i) => {
            if (nomFields[i]) nomFields[i].value = comp.nom || '';
            if (posoFields[i]) posoFields[i].value = comp.posologie || '';
            if (dureeFields[i]) dureeFields[i].value = comp.duree || '';
        });
    }
}

/**
 * Recherche dans la base de connaissances
 */
function initKnowledgeSearch() {
    const searchInput = document.getElementById('knowledge-search');
    const resultsContainer = document.getElementById('knowledge-results');
    let debounceTimer;

    if (!searchInput || !resultsContainer) return;

    searchInput.addEventListener('input', function() {
        const query = this.value.trim();

        clearTimeout(debounceTimer);

        if (query.length < 2) {
            resultsContainer.innerHTML = '';
            resultsContainer.style.display = 'none';
            return;
        }

        debounceTimer = setTimeout(async () => {
            try {
                const response = await fetch(`?page=suggestions-api&action=search&q=${encodeURIComponent(query)}`);
                const data = await response.json();

                displaySearchResults(data.results, resultsContainer);
            } catch (error) {
                console.error('Erreur recherche:', error);
            }
        }, 300);
    });

    // Fermer les résultats en cliquant ailleurs
    document.addEventListener('click', function(e) {
        if (!searchInput.contains(e.target) && !resultsContainer.contains(e.target)) {
            resultsContainer.style.display = 'none';
        }
    });
}

/**
 * Affiche les résultats de recherche
 */
function displaySearchResults(results, container) {
    if (!results || results.length === 0) {
        container.innerHTML = '<div class="search-no-results">Aucun résultat trouvé</div>';
        container.style.display = 'block';
        return;
    }

    const sectionLabels = {
        'alimentation': 'Alimentation',
        'stress': 'Gestion du stress',
        'activite_physique': 'Activité physique',
        'phytotherapie': 'Phytothérapie',
        'aromatherapie': 'Aromathérapie',
        'routines': 'Routines',
        'complements': 'Compléments'
    };

    let html = '<div class="search-results-list">';

    results.forEach(result => {
        const sectionLabel = sectionLabels[result.section] || result.section;
        const content = result.content || (result.data ? formatResultData(result.data) : '');

        html += `
            <div class="search-result-item" data-content="${escapeHtml(content)}">
                <div class="search-result-header">
                    <span class="search-result-section">${sectionLabel}</span>
                    <span class="search-result-path">${result.path}</span>
                </div>
                <div class="search-result-content">${truncate(content, 150)}</div>
                <button type="button" class="btn btn-sm btn-outline copy-suggestion" onclick="copySuggestion(this)">
                    Copier
                </button>
            </div>
        `;
    });

    html += '</div>';
    container.innerHTML = html;
    container.style.display = 'block';
}

/**
 * Formate les données d'un résultat structuré
 */
function formatResultData(data) {
    if (typeof data === 'string') return data;

    let parts = [];
    if (data.nom) parts.push(data.nom);
    if (data.description) parts.push(data.description);
    if (data.proprietes) parts.push(data.proprietes);
    if (data.usages) parts.push('Usages: ' + data.usages);
    if (data.posologie) parts.push('Posologie: ' + data.posologie);
    if (data.ci) parts.push('CI: ' + data.ci);

    return parts.join('\n');
}

/**
 * Copie une suggestion dans le presse-papier et le champ actif
 */
function copySuggestion(btn) {
    const item = btn.closest('.search-result-item');
    const content = item.dataset.content;

    // Copier dans le presse-papier
    navigator.clipboard.writeText(content).then(() => {
        btn.textContent = 'Copié !';
        setTimeout(() => {
            btn.textContent = 'Copier';
        }, 2000);
    });

    // Si un textarea est actif, y insérer le texte
    const activeEl = document.activeElement;
    if (activeEl && activeEl.tagName === 'TEXTAREA') {
        const start = activeEl.selectionStart;
        const end = activeEl.selectionEnd;
        const text = activeEl.value;
        activeEl.value = text.substring(0, start) + content + text.substring(end);
        activeEl.selectionStart = activeEl.selectionEnd = start + content.length;
        activeEl.focus();
    }
}

/**
 * Affiche une notification temporaire
 */
function showNotification(message, type = 'info') {
    const notification = document.createElement('div');
    notification.className = `notification notification-${type}`;
    notification.innerHTML = `
        <span>${message}</span>
        <button onclick="this.parentElement.remove()" class="notification-close">&times;</button>
    `;

    document.body.appendChild(notification);

    // Animation d'entrée
    setTimeout(() => notification.classList.add('show'), 10);

    // Auto-dismiss
    setTimeout(() => {
        notification.classList.remove('show');
        setTimeout(() => notification.remove(), 300);
    }, 5000);
}

/**
 * Utilitaires
 */
function escapeHtml(text) {
    const div = document.createElement('div');
    div.textContent = text;
    return div.innerHTML;
}

function truncate(text, length) {
    if (!text) return '';
    return text.length > length ? text.substring(0, length) + '...' : text;
}
