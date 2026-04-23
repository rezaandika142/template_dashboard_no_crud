<?php
/**
 * View: Users
 * Halaman Users Management
 */
?>

<style>
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
</style>

<div class="content-box">
    <h2>User Management</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Username</th>
                <th>Email</th>
                <th>Full Name</th>
                <th>Role</th>
                <th>Joined</th>
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
                    <td><?php echo $usr['created_at']; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
