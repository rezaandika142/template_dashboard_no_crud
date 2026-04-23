/**
 * Custom JavaScript untuk Dashboard
 * Handling interaksi dan utility functions
 */

document.addEventListener('DOMContentLoaded', function() {
    // Initialize tooltips (jika menggunakan Bootstrap)
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });

    // Initialize popovers (jika menggunakan Bootstrap)
    var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'));
    var popoverList = popoverTriggerList.map(function (popoverTriggerEl) {
        return new bootstrap.Popover(popoverTriggerEl);
    });

    // Add event listeners
    setupEventListeners();
});

/**
 * Setup event listeners
 */
function setupEventListeners() {
    // Example: form submission
    const forms = document.querySelectorAll('form');
    forms.forEach(form => {
        form.addEventListener('submit', function(e) {
            // Add loading state jika perlu
            const submitBtn = this.querySelector('[type="submit"]');
            if (submitBtn) {
                // submitBtn.disabled = true;
            }
        });
    });

    // Confirm before logout
    const logoutLinks = document.querySelectorAll('a[href*="action=logout"]');
    logoutLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            if (!confirm('Apakah Anda yakin ingin logout?')) {
                e.preventDefault();
            }
        });
    });
}

/**
 * Format currency (untuk dashboard stats)
 */
function formatCurrency(amount) {
    return new Intl.NumberFormat('id-ID', {
        style: 'currency',
        currency: 'IDR',
        minimumFractionDigits: 0
    }).format(amount);
}

/**
 * Format date (untuk aktivitas)
 */
function formatDate(dateString) {
    return new Intl.DateTimeFormat('id-ID', {
        year: 'numeric',
        month: 'long',
        day: 'numeric',
        hour: '2-digit',
        minute: '2-digit'
    }).format(new Date(dateString));
}

/**
 * Show notification
 */
function showNotification(message, type = 'info') {
    const alertClass = {
        'success': 'alert-success',
        'error': 'alert-danger',
        'warning': 'alert-warning',
        'info': 'alert-info'
    }[type] || 'alert-info';

    const alertHtml = `
        <div class="alert ${alertClass} alert-dismissible fade show" role="alert">
            ${message}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    `;

    const alertContainer = document.createElement('div');
    alertContainer.innerHTML = alertHtml;
    
    const mainContent = document.querySelector('.main-content') || document.body;
    mainContent.insertBefore(alertContainer.firstElementChild, mainContent.firstChild);
}

/**
 * Confirm dialog
 */
function confirmAction(message) {
    return confirm(message);
}

/**
 * Toggle sidebar di mobile
 */
function toggleSidebar() {
    const sidebar = document.querySelector('.sidebar');
    if (sidebar) {
        sidebar.classList.toggle('show');
    }
}

/**
 * Export table to CSV
 */
function exportTableToCSV(filename) {
    const table = document.querySelector('table');
    if (!table) {
        alert('Tabel tidak ditemukan');
        return;
    }

    let csv = [];
    let rows = table.querySelectorAll('tr');

    for (let i = 0; i < rows.length; i++) {
        let row = [];
        let cols = rows[i].querySelectorAll('td, th');

        for (let j = 0; j < cols.length; j++) {
            row.push('"' + cols[j].innerText + '"');
        }

        csv.push(row.join(','));
    }

    downloadCSV(csv.join('\n'), filename);
}

/**
 * Download CSV file
 */
function downloadCSV(csv, filename) {
    let csvFile;
    let downloadLink;

    csvFile = new Blob([csv], {type: 'text/csv'});
    downloadLink = document.createElement('a');
    downloadLink.setAttribute('href', URL.createObjectURL(csvFile));
    downloadLink.setAttribute('download', filename);
    downloadLink.style.display = 'none';
    document.body.appendChild(downloadLink);
    downloadLink.click();
    document.body.removeChild(downloadLink);
}

/**
 * Print page
 */
function printPage() {
    window.print();
}

// Export functions untuk digunakan di HTML
window.formatCurrency = formatCurrency;
window.formatDate = formatDate;
window.showNotification = showNotification;
window.confirmAction = confirmAction;
window.toggleSidebar = toggleSidebar;
window.exportTableToCSV = exportTableToCSV;
window.printPage = printPage;
