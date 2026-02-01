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
    if (menuToggle && sidebar) {
        menuToggle.addEventListener('click', function() {
            sidebar.classList.toggle('open');
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
});
