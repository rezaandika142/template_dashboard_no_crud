<?php
/**
 * View: Dashboard
 * Halaman dashboard utama
 */
?>

<style>
    .dashboard-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 20px;
        margin-bottom: 30px;
    }

    .card-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 15px;
    }

    .card-header h3 {
        margin: 0;
        color: var(--secondary-color);
        font-size: 1.1rem;
    }

    .card-icon {
        width: 50px;
        height: 50px;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
    }

    .card-icon.blue {
        background-color: #d6eaf8;
        color: var(--primary-color);
    }

    .card-icon.green {
        background-color: #d5f4e6;
        color: var(--success-color);
    }

    .card-icon.orange {
        background-color: #fdebd0;
        color: var(--warning-color);
    }

    .card-icon.red {
        background-color: #fadbd8;
        color: var(--danger-color);
    }

    .card-value {
        font-size: 2rem;
        font-weight: 700;
        color: var(--secondary-color);
        margin: 10px 0;
    }

    .card-subtitle {
        color: #7f8c8d;
        font-size: 0.9rem;
    }

    .badge {
        display: inline-block;
        padding: 5px 10px;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 600;
    }

    .badge.success {
        background-color: #d5f4e6;
        color: var(--success-color);
    }

    .badge.warning {
        background-color: #fdebd0;
        color: var(--warning-color);
    }

    .badge.danger {
        background-color: #fadbd8;
        color: var(--danger-color);
    }

    .badge.failed {
        background-color: #fadbd8;
        color: var(--danger-color);
    }
</style>

<!-- Stats Cards -->
<div class="dashboard-grid">
    <div class="card-box">
        <div class="card-header">
            <h3>Total Users</h3>
            <div class="card-icon blue">
                <i class="fas fa-users"></i>
            </div>
        </div>
        <div class="card-value"><?php echo number_format($stats['total_users']); ?></div>
        <div class="card-subtitle">Pengguna aktif bulan ini</div>
    </div>

    <div class="card-box">
        <div class="card-header">
            <h3>Revenue</h3>
            <div class="card-icon green">
                <i class="fas fa-dollar-sign"></i>
            </div>
        </div>
        <div class="card-value">$<?php echo number_format($stats['revenue']); ?></div>
        <div class="card-subtitle">Total pendapatan</div>
    </div>

    <div class="card-box">
        <div class="card-header">
            <h3>Orders</h3>
            <div class="card-icon orange">
                <i class="fas fa-shopping-cart"></i>
            </div>
        </div>
        <div class="card-value"><?php echo number_format($stats['orders']); ?></div>
        <div class="card-subtitle">Pesanan bulan ini</div>
    </div>

    <div class="card-box">
        <div class="card-header">
            <h3>Growth</h3>
            <div class="card-icon red">
                <i class="fas fa-chart-line"></i>
            </div>
        </div>
        <div class="card-value">+<?php echo $stats['growth']; ?>%</div>
        <div class="card-subtitle">Pertumbuhan YoY</div>
    </div>
</div>

<!-- Recent Activity Table -->
<div class="content-box">
    <h2>Aktivitas Terbaru</h2>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>User</th>
                <th>Aktivitas</th>
                <th>Tanggal</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $no = 1;
            foreach ($activities as $activity): 
            ?>
                <tr>
                    <td><?php echo $no++; ?></td>
                    <td><?php echo htmlspecialchars($activity['user']); ?></td>
                    <td><?php echo htmlspecialchars($activity['activity']); ?></td>
                    <td><?php echo date('d M Y, H:i', strtotime($activity['timestamp'])); ?></td>
                    <td>
                        <span class="badge <?php echo $activity['status']; ?>">
                            <?php 
                            $status_map = [
                                'success' => 'Berhasil',
                                'pending' => 'Pending',
                                'failed' => 'Gagal'
                            ];
                            echo $status_map[$activity['status']] ?? ucfirst($activity['status']);
                            ?>
                        </span>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
