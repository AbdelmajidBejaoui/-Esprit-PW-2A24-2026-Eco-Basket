            </div>
        </div>
    </div>
    
    <footer class="main-footer">
        <strong>&copy; <?php echo date('Y'); ?> Sport Nutrition Store - All Rights Reserved.</strong>
    </footer>
</div>

<script src="/AdminLTE3/plugins/jquery/jquery.min.js"></script>
<script src="/AdminLTE3/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="/AdminLTE3/dist/js/adminlte.min.js"></script>

<script>
// Fonction pour afficher des notifications toast
function showToast(message, type) {
    const toast = document.createElement('div');
    toast.className = `toast-notification ${type}`;
    toast.innerHTML = message;
    document.body.appendChild(toast);
    
    setTimeout(() => {
        toast.style.animation = 'slideOutRight 0.5s ease-out';
        setTimeout(() => {
            toast.remove();
        }, 500);
    }, 3000);
}

// Animation au chargement de la page
document.addEventListener('DOMContentLoaded', function() {
    console.log("Animations chargées !");
    
    // Vérifier les paramètres URL pour les notifications
    const urlParams = new URLSearchParams(window.location.search);
    if(urlParams.get('success') === '1') {
        showToast('✅ Opération réussie !', 'success');
    } else if(urlParams.get('deleted') === '1') {
        showToast('🗑️ Suppression effectuée !', 'info');
    } else if(urlParams.get('updated') === '1') {
        showToast('✏️ Modification réussie !', 'success');
    } else if(urlParams.get('error') === '1') {
        showToast('❌ Une erreur est survenue', 'error');
    }
    
    // Animation pour les messages d'erreur
    const errorMessages = document.querySelectorAll('.error-message');
    errorMessages.forEach(msg => {
        if(msg.textContent !== '') {
            const input = msg.previousElementSibling;
            if(input) {
                input.classList.add('input-error');
                setTimeout(() => {
                    input.classList.remove('input-error');
                }, 500);
            }
        }
    });
});

// Animation de confirmation pour les formulaires
document.querySelectorAll('form').forEach(form => {
    form.addEventListener('submit', function(e) {
        const btn = this.querySelector('button[type="submit"]');
        if(btn) {
            const originalText = btn.innerHTML;
            btn.innerHTML = '<span class="loading-spinner"></span> Chargement...';
            btn.disabled = true;
        }
    });
});

// Animation au survol des lignes du tableau
document.querySelectorAll('table tbody tr').forEach(row => {
    row.addEventListener('mouseenter', function() {
        this.style.transition = 'all 0.2s ease';
        this.style.backgroundColor = '#f5f5f5';
    });
    row.addEventListener('mouseleave', function() {
        this.style.backgroundColor = '';
    });
});
</script>

<style>
/* Animation hover pour les lignes du tableau */
table tbody tr {
    transition: all 0.2s ease;
}
</style>

</body>
</html>