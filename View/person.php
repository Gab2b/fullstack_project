<form method="post" id="person-form">
    <div class="mb-3">
        <label for="last-name" class="form-label">Nom</label>
        <input type="text" name="last-name" id="last-name" class="form-control"
               value="<?php echo isset($person['last_name']) ? $person['last_name'] : ""; ?>" required>
    </div>
    <div class="mb-3">
        <label for="first-name" class="form-label">Prénom</label>
        <input type="text" name="first-name" id="first-name" class="form-control"
               value="<?php echo isset($person['first_name']) ? $person['first_name'] : ""; ?>" required>
    </div>
    <div class="mb-3">
        <label for="address" class="form-label">Adresse</label>
        <input type="text" name="address" id="address" class="form-control"
               value="<?php echo isset($person['address']) ? $person['address'] : ""; ?>" required>
    </div>
    <div class="mb-3">
        <label for="zipcode" class="form-label">Zipcode</label>
        <input type="text" name="zipcode" id="zipcode" class="form-control"
               value="<?php echo isset($person['zipcode']) ? $person['zipcode'] : ""; ?>" required>
    </div>
    <div class="mb-3">
        <label for="city" class="form-label">Ville</label>
        <input type="text" name="city" id="city" class="form-control"
               value="<?php echo isset($person['city']) ? $person['city'] : ""; ?>" required>
    </div>
    <div class="mb-3">
        <label for="phone" class="form-label">Numéro de téléphone</label>
        <input type="text" name="phone" id="phone" class="form-control"
               value="<?php echo isset($person['phone']) ? $person['phone'] : ""; ?>" required>
    </div>
    <div class="form-check">
        <input class="form-check-input" type="radio" name="type" id="flexRadioDefault1" value=2 <?php echo isset($user['type']) && $user['type'] ? "checked" : ""; ?>>
        <label class="form-check-label" for="flexRadioDefault1">
            Enseignant
        </label>
    </div>
    <div class="form-check">
        <input class="form-check-input" type="radio" name="type" id="flexRadioDefault2" value=1 <?php echo isset($user['type']) && $user['type'] ? "checked" : ""; ?>>
        <label class="form-check-label" for="flexRadioDefault2">
            Élève
        </label>
    </div>

    <div class="mb-3 d-flex justify-content-end">
        <button type="submit"  id="valid-form-person" class="btn <?php echo isset($id) ? "btn-success" : "btn-primary" ?>"
                name="<?php echo isset($id) ? "edit_button" : "valid_button"; ?>" 
                data-id="<?php echo isset($person['id']) ? $person['id'] : null?>"> <?php echo isset($id) ? "Modifier" : "Enregistrer"; ?>
                </button>
    </div>
</form>

<script src="./Assets/JavaScript/Components/person.js" type="module"></script>
<script type="module">
    import { handlePersonForm } from './Assets/JavaScript/Components/person.js'

    document.addEventListener("DOMContentLoaded", async () => {
        handlePersonForm()
    })
</script>
