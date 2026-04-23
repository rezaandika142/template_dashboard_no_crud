<?php
/**
 * View: Settings
 * Halaman Settings lengkap
 */
?>

<style>
    .settings-container {
        max-width: 800px;
    }

    .settings-section {
        background: white;
        padding: 25px;
        margin-bottom: 25px;
        border-radius: 8px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        border-left: 4px solid var(--primary-color);
    }

    .settings-section.security {
        border-left-color: #e74c3c;
    }

    .settings-section.notifications {
        border-left-color: #f39c12;
    }

    .settings-section.privacy {
        border-left-color: #9b59b6;
    }

    .settings-section.danger {
        border-left-color: #e74c3c;
    }

    .settings-section h3 {
        color: var(--secondary-color);
        margin: 0 0 20px 0;
        font-weight: 700;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-group label {
        display: block;
        margin-bottom: 8px;
        color: var(--secondary-color);
        font-weight: 600;
        font-size: 0.95rem;
    }

    .form-group input,
    .form-group select,
    .form-group textarea {
        width: 100%;
        padding: 10px;
        border: 1px solid #ddd;
        border-radius: 5px;
        font-size: 0.9rem;
        font-family: inherit;
    }

    .form-group textarea {
        resize: vertical;
        min-height: 80px;
    }

    .form-group input:focus,
    .form-group select:focus,
    .form-group textarea:focus {
        outline: none;
        border-color: var(--primary-color);
        box-shadow: 0 0 0 3px rgba(52, 152, 219, 0.1);
    }

    .form-group small {
        display: block;
        margin-top: 5px;
        color: #7f8c8d;
        font-size: 0.85rem;
    }

    .form-row {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 20px;
    }

    .checkbox-group {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 15px;
    }

    .checkbox-group input[type="checkbox"] {
        width: auto;
        margin: 0;
    }

    .checkbox-group label {
        margin: 0;
        font-weight: 600;
        color: var(--secondary-color);
    }

    .button-group {
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
        margin-top: 25px;
    }

    .btn-save, .btn-cancel, .btn-danger-btn {
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-weight: 600;
        transition: 0.3s;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }

    .btn-save {
        background-color: var(--primary-color);
        color: white;
    }

    .btn-save:hover {
        background-color: #2980b9;
    }

    .btn-cancel {
        background-color: #95a5a6;
        color: white;
    }

    .btn-cancel:hover {
        background-color: #7f8c8d;
    }

    .btn-danger-btn {
        background-color: var(--danger-color);
        color: white;
    }

    .btn-danger-btn:hover {
        background-color: #c0392b;
    }

    .info-box {
        background-color: #d6eaf8;
        border-left: 4px solid var(--primary-color);
        padding: 15px;
        border-radius: 5px;
        margin-bottom: 20px;
    }

    .info-box p {
        margin: 0;
        color: var(--secondary-color);
        font-size: 0.9rem;
    }
</style>

<div class="settings-container">
    <h2 style="color: var(--secondary-color); margin-bottom: 25px;">Settings</h2>

    <!-- Profile Settings -->
    <div class="settings-section">
        <h3><i class="fas fa-user"></i> Profile Settings</h3>
        <div class="form-row">
            <div class="form-group">
                <label>Username</label>
                <input type="text" value="<?php echo htmlspecialchars($user['username']); ?>" disabled>
                <small>Username tidak bisa diubah</small>
            </div>
            <div class="form-group">
                <label>Role</label>
                <input type="text" value="<?php echo htmlspecialchars(ucfirst($user['role'])); ?>" disabled>
                <small>Role merupakan akses level Anda</small>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label>Full Name</label>
                <input type="text" value="<?php echo htmlspecialchars($user['full_name']); ?>" placeholder="Nama Lengkap">
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="email" value="<?php echo htmlspecialchars($user['email']); ?>" placeholder="email@example.com">
            </div>
        </div>

        <div class="form-group">
            <label>Phone Number</label>
            <input type="tel" placeholder="Nomor Telepon Anda" value="+62 (812) 3456-7890">
        </div>

        <div class="form-group">
            <label>Bio</label>
            <textarea placeholder="Tuliskan bio singkat Anda">Seorang developer yang bersemangat tentang web development.</textarea>
        </div>

        <div class="button-group">
            <button class="btn-save"><i class="fas fa-save"></i> Save Changes</button>
            <button class="btn-cancel"><i class="fas fa-times"></i> Cancel</button>
        </div>
    </div>

    <!-- Security Settings -->
    <div class="settings-section security">
        <h3><i class="fas fa-lock"></i> Security Settings</h3>
        
        <div class="info-box">
            <p><strong>Password Terakhir Diubah:</strong> 2024-02-15</p>
        </div>

        <div class="form-group">
            <label>Password Saat Ini</label>
            <input type="password" placeholder="Masukkan password saat ini">
        </div>

        <div class="form-row">
            <div class="form-group">
                <label>Password Baru</label>
                <input type="password" placeholder="Minimal 8 karakter">
            </div>
            <div class="form-group">
                <label>Konfirmasi Password</label>
                <input type="password" placeholder="Ulangi password baru">
            </div>
        </div>

        <div class="checkbox-group">
            <input type="checkbox" id="two-factor" checked>
            <label for="two-factor">Aktifkan Two-Factor Authentication (2FA)</label>
        </div>

        <div class="button-group">
            <button class="btn-save"><i class="fas fa-lock"></i> Update Password</button>
            <button class="btn-cancel"><i class="fas fa-times"></i> Cancel</button>
        </div>
    </div>

    <!-- Notifications Settings -->
    <div class="settings-section notifications">
        <h3><i class="fas fa-bell"></i> Notification Settings</h3>

        <div class="checkbox-group">
            <input type="checkbox" id="email-login" checked>
            <label for="email-login">Notifikasi login baru melalui email</label>
        </div>

        <div class="checkbox-group">
            <input type="checkbox" id="email-activity" checked>
            <label for="email-activity">Notifikasi aktivitas akun</label>
        </div>

        <div class="checkbox-group">
            <input type="checkbox" id="email-security" checked>
            <label for="email-security">Notifikasi keamanan dan peringatan</label>
        </div>

        <div class="checkbox-group">
            <input type="checkbox" id="email-updates">
            <label for="email-updates">Notifikasi update dan fitur baru</label>
        </div>

        <div class="checkbox-group">
            <input type="checkbox" id="email-newsletter" checked>
            <label for="email-newsletter">Subscribe newsletter mingguan</label>
        </div>

        <div class="button-group">
            <button class="btn-save"><i class="fas fa-save"></i> Save Preferences</button>
        </div>
    </div>

    <!-- Privacy Settings -->
    <div class="settings-section privacy">
        <h3><i class="fas fa-shield-alt"></i> Privacy Settings</h3>

        <div class="form-group">
            <label>Profile Visibility</label>
            <select>
                <option selected>Public</option>
                <option>Friends Only</option>
                <option>Private</option>
            </select>
            <small>Kontrol siapa yang bisa melihat profil Anda</small>
        </div>

        <div class="checkbox-group">
            <input type="checkbox" id="show-email" checked>
            <label for="show-email">Tampilkan email di profil</label>
        </div>

        <div class="checkbox-group">
            <input type="checkbox" id="search-engine" checked>
            <label for="search-engine">Izinkan search engine mengindex profil saya</label>
        </div>

        <div class="button-group">
            <button class="btn-save"><i class="fas fa-save"></i> Update Privacy</button>
        </div>
    </div>

    <!-- Application Settings -->
    <div class="settings-section">
        <h3><i class="fas fa-cog"></i> Application Settings</h3>

        <div class="form-row">
            <div class="form-group">
                <label>Language / Bahasa</label>
                <select>
                    <option selected>Bahasa Indonesia</option>
                    <option>English (US)</option>
                    <option>English (UK)</option>
                </select>
            </div>
            <div class="form-group">
                <label>Theme</label>
                <select>
                    <option selected>Light</option>
                    <option>Dark</option>
                    <option>Auto (Sesuai Sistem)</option>
                </select>
            </div>
        </div>

        <div class="form-group">
            <label>Timezone</label>
            <select>
                <option selected>Asia/Jakarta (UTC+7)</option>
                <option>Asia/Bangkok (UTC+7)</option>
                <option>Asia/Manila (UTC+8)</option>
            </select>
        </div>

        <div class="form-group">
            <label>Date Format</label>
            <select>
                <option selected>DD/MM/YYYY</option>
                <option>MM/DD/YYYY</option>
                <option>YYYY-MM-DD</option>
            </select>
        </div>

        <div class="button-group">
            <button class="btn-save"><i class="fas fa-save"></i> Save Settings</button>
        </div>
    </div>

    <!-- Danger Zone -->
    <div class="settings-section danger">
        <h3><i class="fas fa-exclamation-triangle"></i> Danger Zone</h3>

        <div class="info-box" style="background-color: #fadbd8; border-left-color: var(--danger-color);">
            <p><strong>⚠️ Perhatian:</strong> Aksi di bagian ini tidak bisa dibatalkan. Lakukan dengan hati-hati!</p>
        </div>

        <div class="form-group">
            <label style="font-weight: 700; color: var(--danger-color);">Logout Dari Semua Device</label>
            <p style="color: #7f8c8d; margin-bottom: 15px;">Logout dari semua sesi aktif di device lain</p>
            <button class="btn-danger-btn"><i class="fas fa-sign-out-alt"></i> Logout All Devices</button>
        </div>

        <div class="form-group" style="margin-top: 25px; padding-top: 25px; border-top: 1px solid #ecf0f1;">
            <label style="font-weight: 700; color: var(--danger-color);">Delete Account</label>
            <p style="color: #7f8c8d; margin-bottom: 15px;">Menghapus akun akan menghapus semua data Anda secara permanent</p>
            <button class="btn-danger-btn"><i class="fas fa-trash"></i> Delete My Account</button>
        </div>
    </div>
</div>

            </select>
        </div>
        <button class="btn-save"><i class="fas fa-save"></i> Save Settings</button>
    </div>
</div>
