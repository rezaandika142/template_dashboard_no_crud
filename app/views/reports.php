<?php
/**
 * View: Reports
 * Halaman Reports dengan berbagai jenis laporan
 */
?>

<style>
    .report-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 20px;
        margin-bottom: 30px;
    }

    .report-card {
        background: white;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        border-left: 4px solid var(--primary-color);
    }

    .report-card h3 {
        color: var(--secondary-color);
        margin: 0 0 10px 0;
        font-size: 1rem;
        font-weight: 600;
    }

    .report-card p {
        color: #7f8c8d;
        margin: 0 0 15px 0;
        font-size: 0.9rem;
    }

    .report-date {
        font-size: 0.85rem;
        color: #95a5a6;
        margin-bottom: 15px;
    }

    .report-actions {
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
    }

    .btn-report {
        padding: 8px 12px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        text-decoration: none;
        font-size: 0.85rem;
        transition: 0.3s;
        display: inline-flex;
        align-items: center;
        gap: 5px;
        font-weight: 600;
    }

    .btn-view {
        background-color: var(--primary-color);
        color: white;
    }

    .btn-view:hover {
        background-color: #2980b9;
    }

    .btn-download {
        background-color: var(--success-color);
        color: white;
    }

    .btn-download:hover {
        background-color: #229954;
    }

    .btn-print {
        background-color: var(--warning-color);
        color: white;
    }

    .btn-print:hover {
        background-color: #d68910;
    }

    .generate-report-section {
        background: white;
        padding: 25px;
        border-radius: 8px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        margin-top: 30px;
    }

    .generate-report-section h3 {
        color: var(--secondary-color);
        margin-bottom: 20px;
        font-weight: 600;
    }

    .form-row {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 15px;
        margin-bottom: 20px;
    }

    .form-group {
        display: flex;
        flex-direction: column;
    }

    .form-group label {
        margin-bottom: 8px;
        color: var(--secondary-color);
        font-weight: 600;
        font-size: 0.9rem;
    }

    .form-group input,
    .form-group select {
        padding: 10px;
        border: 1px solid #ddd;
        border-radius: 5px;
        font-size: 0.9rem;
    }

    .btn-generate {
        background-color: var(--primary-color);
        color: white;
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-weight: 600;
        transition: 0.3s;
    }

    .btn-generate:hover {
        background-color: #2980b9;
    }
</style>

<h2>Available Reports</h2>

<div class="report-grid">
    <div class="report-card">
        <h3><i class="fas fa-chart-line"></i> Sales Report</h3>
        <p>Laporan penjualan berdasarkan periode dan kategori produk.</p>
        <div class="report-date">Last generated: 2024-04-20</div>
        <div class="report-actions">
            <button class="btn-report btn-view"><i class="fas fa-eye"></i> View</button>
            <button class="btn-report btn-download"><i class="fas fa-download"></i> PDF</button>
            <button class="btn-report btn-download"><i class="fas fa-download"></i> Excel</button>
        </div>
    </div>

    <div class="report-card" style="border-left-color: #27ae60;">
        <h3><i class="fas fa-users"></i> User Activity Report</h3>
        <p>Laporan aktivitas pengguna dan engagement rate.</p>
        <div class="report-date">Last generated: 2024-04-19</div>
        <div class="report-actions">
            <button class="btn-report btn-view"><i class="fas fa-eye"></i> View</button>
            <button class="btn-report btn-download"><i class="fas fa-download"></i> PDF</button>
            <button class="btn-report btn-download"><i class="fas fa-download"></i> Excel</button>
        </div>
    </div>

    <div class="report-card" style="border-left-color: #f39c12;">
        <h3><i class="fas fa-money-bill-wave"></i> Revenue Report</h3>
        <p>Laporan pendapatan dan profitabilitas per bulan.</p>
        <div class="report-date">Last generated: 2024-04-20</div>
        <div class="report-actions">
            <button class="btn-report btn-view"><i class="fas fa-eye"></i> View</button>
            <button class="btn-report btn-download"><i class="fas fa-download"></i> PDF</button>
            <button class="btn-report btn-download"><i class="fas fa-download"></i> Excel</button>
        </div>
    </div>

    <div class="report-card" style="border-left-color: #e74c3c;">
        <h3><i class="fas fa-exclamation-triangle"></i> Error & Issues Report</h3>
        <p>Laporan error sistem dan issue yang perlu ditangani.</p>
        <div class="report-date">Last generated: 2024-04-21</div>
        <div class="report-actions">
            <button class="btn-report btn-view"><i class="fas fa-eye"></i> View</button>
            <button class="btn-report btn-download"><i class="fas fa-download"></i> PDF</button>
            <button class="btn-report btn-download"><i class="fas fa-download"></i> Excel</button>
        </div>
    </div>

    <div class="report-card" style="border-left-color: #9b59b6;">
        <h3><i class="fas fa-tasks"></i> Performance Report</h3>
        <p>Laporan performa sistem dan server health.</p>
        <div class="report-date">Last generated: 2024-04-21</div>
        <div class="report-actions">
            <button class="btn-report btn-view"><i class="fas fa-eye"></i> View</button>
            <button class="btn-report btn-download"><i class="fas fa-download"></i> PDF</button>
            <button class="btn-report btn-download"><i class="fas fa-download"></i> Excel</button>
        </div>
    </div>

    <div class="report-card" style="border-left-color: #1abc9c;">
        <h3><i class="fas fa-shopping-cart"></i> Inventory Report</h3>
        <p>Laporan stok barang dan manajemen inventory.</p>
        <div class="report-date">Last generated: 2024-04-20</div>
        <div class="report-actions">
            <button class="btn-report btn-view"><i class="fas fa-eye"></i> View</button>
            <button class="btn-report btn-download"><i class="fas fa-download"></i> PDF</button>
            <button class="btn-report btn-download"><i class="fas fa-download"></i> Excel</button>
        </div>
    </div>
</div>

<div class="generate-report-section">
    <h3><i class="fas fa-cog"></i> Generate Custom Report</h3>
    
    <div class="form-row">
        <div class="form-group">
            <label>Report Type</label>
            <select>
                <option>-- Select Report Type --</option>
                <option>Sales Report</option>
                <option>User Activity Report</option>
                <option>Revenue Report</option>
                <option>Error & Issues Report</option>
                <option>Performance Report</option>
                <option>Inventory Report</option>
            </select>
        </div>

        <div class="form-group">
            <label>Date Range Start</label>
            <input type="date" value="2024-01-01">
        </div>

        <div class="form-group">
            <label>Date Range End</label>
            <input type="date" value="2024-04-21">
        </div>

        <div class="form-group">
            <label>Format</label>
            <select>
                <option>PDF</option>
                <option>Excel</option>
                <option>CSV</option>
                <option>HTML</option>
            </select>
        </div>
    </div>

    <button class="btn-generate">
        <i class="fas fa-cog"></i> Generate Report
    </button>
</div>

