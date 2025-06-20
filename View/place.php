<div class="form-container-header">
    <h1>Ajouter une place</h1>
</div>
<div class="form-container">
    <form action="Controller/place.php" method="post" class="form">
            <label for="place-label">Numéro de la place</label>
            <input type="text" name="place" placeholder="Numéro de la place" class="input" id="place-number" value="<?php echo isset($place) ? $place['number'] : ''; ?>">
            <label for="place-label">Type de place</label>
            <select name="place-type" class="input" id="place-type">
                <option disabled selected>Choisissez un type de place</option>
                <option <?php echo isset($place) ? ($place['type'] == 'standard' ? 'selected' : '') : ''; ?> value="standard">Standard</option>
                <option <?php echo isset($place) ? ($place['type'] == 'handicap' ? 'selected' : '') : ''; ?> value="handicap">Handicapée</option>
            </select>
        <button type="button" class="button-primary" id="<?php echo isset($place) ? 'edit-place-button' : 'add-place-button'; ?>"><?php echo isset($place) ? 'Modifier' : 'Ajouter'; ?></button>
    </form>
</div>

<script type="module" src="./Assets/JS/Services/place.js"></script>
<script type="module">
    import { editPlace, addPlace } from './Assets/JS/Services/place.js';
    document.addEventListener('DOMContentLoaded', async () => {
        <?php if (isset($place)) { ?>
            const placeId = <?php echo $place['id']; ?>;
        <?php } ?>
        const editPlaceButton = document.getElementById('edit-place-button');
        const addPlaceButton = document.getElementById('add-place-button');
        const placeNumber = document.getElementById('place-number');
        const placeType = document.getElementById('place-type');
        if (editPlaceButton) {
            editPlaceButton.addEventListener('click', async () => {
                const result = await editPlace(placeId, placeNumber.value, placeType.value);
                if (result) {
                    alert('Place modifiée avec succès');
                    window.location.href = 'index.php?component=dashboard';
                } else {
                    alert('Erreur lors de la modification de la place');
                }
            });
        }
        if (addPlaceButton) {
            addPlaceButton.addEventListener('click', async () => {
                const result = await addPlace(placeNumber.value, placeType.value);
                if (result.success) {
                    alert('Place ajoutée avec succès');
                    window.location.href = 'index.php?component=dashboard';
                } else {
                    alert('Erreur lors de l\'ajout de la place');
                }
            });
        }
    });
</script>