<form method="post">
    <div class="mb-3">
        <label for="username" class="form-label">Identifiant</label>
        <input type="text" name="username" id="username" class="form-control"
               value="<?php echo isset($user['username']) ? $user['username'] : ""; ?>" required>
    </div>
    <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" name="email" id="email" class="form-control"
               value="<?php echo isset($user['email']) ? $user['email'] : ""; ?>" required>
    </div>
    <div class="mb-3">
        <label for="pass" class="form-label">Mot de passe</label>
        <input type="password" name="pass" id="pass"
               class="form-control" <?php echo isset($id) ? "" : "required"; ?>>
    </div>
    <div class="mb-3">
        <label for="confirmation" class="form-label">Confirmation du mot de passe</label>
        <input type="password" name="confirmation" id="confirmation"
               class="form-control" <?php echo isset($id) ? "" : "required"; ?>>
    </div>
    <div class="mb-3 form-check">
        <input
                type="checkbox" class="form-check-input" id="enabled"
                name="enabled"
            <?php echo isset($user['enabled']) && $user['enabled'] ? "checked" : ""; ?>
                <?php echo ($user['id'] === $_SESSION['user_id']) ? "disabled" : ""?>

        >
        <label class="form-check-label" for="enabled">Actif</label>
    </div>
    <div class="mb-3 d-flex justify-content-end">
        <button type="submit"  class="btn <?php echo isset($id) ? "btn-success" : "btn-primary" ?>"
                name="<?php echo isset($id) ? "edit_button" : "valid_button"; ?>"> <?php echo isset($id) ? "Modifier" : "Enregistrer"; ?></button>
    </div>
</form>
