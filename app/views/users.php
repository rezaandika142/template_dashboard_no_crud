<?php
/**
 * View: Users
 * Halaman Users Management
 */
?>

<style>
    .user-controls {
        display: flex;
        gap: 10px;
        margin-bottom: 20px;
        flex-wrap: wrap;
    }

    .btn-primary, .btn-success, .btn-warning, .btn-danger {
        padding: 10px 15px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        transition: 0.3s;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        font-weight: 600;
    }

    .btn-primary {
        background-color: var(--primary-color);
        color: white;
    }

    .btn-primary:hover {
        background-color: #2980b9;
    }

    .btn-success {
        background-color: var(--success-color);
        color: white;
    }

    .btn-success:hover {
        background-color: #229954;
    }

    .btn-warning {
        background-color: var(--warning-color);
        color: white;
    }

    .btn-warning:hover {
        background-color: #d68910;
    }

    .btn-danger {
        background-color: var(--danger-color);
        color: white;
    }

    .btn-danger:hover {
        background-color: #c0392b;
    }

    .role-badge {
        display: inline-block;
        padding: 5px 10px;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 600;
    }

    .role-admin {
        background-color: #fadbd8;
        color: var(--danger-color);
    }

    .role-manager {
        background-color: #fdebd0;
        color: var(--warning-color);
    }

    .role-user {
        background-color: #d6eaf8;
        color: var(--primary-color);
    }

    .status-active {
        display: inline-block;
        padding: 5px 10px;
        border-radius: 20px;
        background-color: #d5f4e6;
        color: var(--success-color);
        font-size: 0.8rem;
        font-weight: 600;
    }

    .status-inactive {
        display: inline-block;
        padding: 5px 10px;
        border-radius: 20px;
        background-color: #fadbd8;
        color: var(--danger-color);
        font-size: 0.8rem;
        font-weight: 600;
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

    .actions {
        display: flex;
        gap: 8px;
    }

    .actions a, .actions button {
        padding: 5px 10px;
        border: none;
        border-radius: 3px;
        cursor: pointer;
        text-decoration: none;
        font-size: 0.85rem;
        transition: 0.3s;
    }

    .action-edit {
        background-color: var(--primary-color);
        color: white;
    }

    .action-edit:hover {
        background-color: #2980b9;
    }

    .action-delete {
        background-color: var(--danger-color);
        color: white;
    }

    .action-delete:hover {
        background-color: #c0392b;
    }
</style>

<div class="user-controls">
    <button class="btn-primary">
        <i class="fas fa-plus"></i> Add New User
    </button>
    <button class="btn-success">
        <i class="fas fa-download"></i> Export Users
    </button>
    <button class="btn-warning">
        <i class="fas fa-upload"></i> Import Users
    </button>
</div>

<div class="table-container">
    <h3 style="margin-bottom: 15px; color: var(--secondary-color);">User List</h3>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Username</th>
                <th>Email</th>
                <th>Full Name</th>
                <th>Role</th>
                <th>Status</th>
                <th>Joined</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $usr): ?>
                <tr>
                    <td><?php echo $usr['id']; ?></td>
                    <td><?php echo htmlspecialchars($usr['username']); ?></td>
                    <td><?php echo htmlspecialchars($usr['email']); ?></td>
                    <td><?php echo htmlspecialchars($usr['full_name']); ?></td>
                    <td>
                        <span class="role-badge role-<?php echo $usr['role']; ?>">
                            <?php echo ucfirst($usr['role']); ?>
                        </span>
                    </td>
                    <td>
                        <span class="status-active">
                            <i class="fas fa-check-circle"></i> Active
                        </span>
                    </td>
                    <td><?php echo isset($usr['created_at']) ? $usr['created_at'] : '2024-01-15'; ?></td>
                    <td>
                        <div class="actions">
                            <button class="action-edit" title="Edit">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button class="action-delete" title="Delete">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

                    <td><?php echo htmlspecialchars($usr['email']); ?></td>
                    <td><?php echo htmlspecialchars($usr['full_name']); ?></td>
                    <td>
                        <span class="role-badge role-<?php echo $usr['role']; ?>">
                            <?php echo ucfirst($usr['role']); ?>
                        </span>
                    </td>
                    <td><?php echo $usr['created_at']; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
