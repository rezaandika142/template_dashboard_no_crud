<?php
/**
 * View: Analytics
 * Halaman Analytics dengan chart dan grafik
 */
?>

<style>
    .analytics-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 20px;
        margin-bottom: 30px;
    }

    .analytics-card {
        background: white;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
    }

    .analytics-card h3 {
        color: var(--secondary-color);
        margin-bottom: 15px;
        font-size: 0.95rem;
        font-weight: 600;
    }

    .chart-container {
        height: 300px;
        background: linear-gradient(135deg, #f5f7fa 0%, #ecf0f1 100%);
        border-radius: 5px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #7f8c8d;
        font-style: italic;
        text-align: center;
        padding: 20px;
    }

    .metric-value {
        font-size: 2rem;
        font-weight: 700;
        color: var(--primary-color);
        margin: 10px 0;
    }

    .metric-change {
        font-size: 0.9rem;
        padding: 5px 10px;
        border-radius: 5px;
        display: inline-block;
    }

    .metric-up {
        background-color: #d5f4e6;
        color: var(--success-color);
    }

    .metric-down {
        background-color: #fadbd8;
        color: var(--danger-color);
    }

    .table-container {
        background: white;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        overflow-x: auto;
    }

    .table-container table {
        width: 100%;
        border-collapse: collapse;
    }

    .table-container th {
        background-color: var(--secondary-color);
        color: white;
        padding: 12px;
        text-align: left;
        font-weight: 600;
    }

    .table-container td {
        padding: 12px;
        border-bottom: 1px solid #ecf0f1;
    }

    .table-container tr:hover {
        background-color: #f8f9fa;
    }
</style>

<div class="analytics-grid">
    <div class="analytics-card">
        <h3>Page Views</h3>
        <div class="metric-value">45,231</div>
        <div class="metric-change metric-up"><i class="fas fa-arrow-up"></i> +12.5% dari bulan lalu</div>
        <div class="chart-container">Chart: Page Views Trend</div>
    </div>

    <div class="analytics-card">
        <h3>User Engagement</h3>
        <div class="metric-value">3,214</div>
        <div class="metric-change metric-up"><i class="fas fa-arrow-up"></i> +8.2% dari bulan lalu</div>
        <div class="chart-container">Chart: Engagement Rate</div>
    </div>

    <div class="analytics-card">
        <h3>Conversion Rate</h3>
        <div class="metric-value">3.24%</div>
        <div class="metric-change metric-down"><i class="fas fa-arrow-down"></i> -2.1% dari bulan lalu</div>
        <div class="chart-container">Chart: Conversion Trend</div>
    </div>

    <div class="analytics-card">
        <h3>Revenue</h3>
        <div class="metric-value">$45,320</div>
        <div class="metric-change metric-up"><i class="fas fa-arrow-up"></i> +24% dari bulan lalu</div>
        <div class="chart-container">Chart: Revenue Growth</div>
    </div>
</div>

<div class="table-container">
    <h3 style="margin-bottom: 15px; color: var(--secondary-color);">Top Performing Pages</h3>
    <table>
        <thead>
            <tr>
                <th>Page</th>
                <th>Views</th>
                <th>Avg. Time (sec)</th>
                <th>Bounce Rate</th>
                <th>Conversion</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>/dashboard</td>
                <td>12,543</td>
                <td>245</td>
                <td>32.5%</td>
                <td>5.2%</td>
            </tr>
            <tr>
                <td>/products</td>
                <td>8,234</td>
                <td>180</td>
                <td>28.1%</td>
                <td>3.8%</td>
            </tr>
            <tr>
                <td>/pricing</td>
                <td>6,123</td>
                <td>152</td>
                <td>45.2%</td>
                <td>2.1%</td>
            </tr>
            <tr>
                <td>/blog</td>
                <td>4,521</td>
                <td>320</td>
                <td>15.3%</td>
                <td>1.5%</td>
            </tr>
            <tr>
                <td>/contact</td>
                <td>2,810</td>
                <td>98</td>
                <td>62.1%</td>
                <td>8.3%</td>
            </tr>
        </tbody>
    </table>
</div>

