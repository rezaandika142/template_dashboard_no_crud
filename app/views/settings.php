<?php
/**
 * View: Settings
 * Halaman Settings
 */
?>

<style>
    .settings-section {
        margin-bottom: 30px;
    }

    .settings-section h3 {
        color: var(--secondary-color);
        margin-bottom: 20px;
        font-weight: 700;
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-group label {
        display: block;
        margin-bottom: 8px;
        color: var(--secondary-color);
        font-weight: 600;
    }

    .form-group input,
    .form-group select {
        width: 100%;
        max-width: 400px;
        padding: 10px;
        border: 1px solid #ddd;
        border-radius: 5px;
    }

    .btn-save {
        background-color: var(--primary-color);
        color: white;
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        transition: 0.3s;
    }

    .btn-save:hover {
        background-color: #2980b9;
    }
</style>

<div class="content-box">
    <h2>Settings</h2>

    <div class="settings-section">
        <h3>Profile Settings</h3>
        <div class="form-group">
            <label>Full Name</label>
            <input type="text" value="<?php echo htmlspecialchars($user['full_name']); ?>" disabled>
        </div>
        <div class="form-group">
            <label>Email</label>
            <input type="email" value="<?php echo htmlspecialchars($user['email']); ?>" disabled>
        </div>
        <button class="btn-save"><i class="fas fa-save"></i> Update Profile</button>
    </div>

    <div class="settings-section">
        <h3>Security Settings</h3>
        <div class="form-group">
            <label>Change Password</label>
            <input type="password" placeholder="Current Password">
        </div>
        <div class="form-group">
            <label>New Password</label>
            <input type="password" placeholder="New Password">
        </div>
        <div class="form-group">
            <label>Confirm Password</label>
            <input type="password" placeholder="Confirm Password">
        </div>
        <button class="btn-save"><i class="fas fa-lock"></i> Change Password</button>
    </div>

    <div class="settings-section">
        <h3>Application Settings</h3>
        <div class="form-group">
            <label>Language</label>
            <select>
                <option>Indonesia</option>
                <option>English</option>
            </select>
        </div>
        <div class="form-group">
            <label>Theme</label>
            <select>
                <option>Light</option>
                <option>Dark</option>
            </select>
        </div>
        <button class="btn-save"><i class="fas fa-save"></i> Save Settings</button>
    </div>
</div>
