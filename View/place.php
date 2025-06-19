<div class="form-container-header">
    <h1>Ajouter une place</h1>
</div>
<div class="form-container">
    <form action="Controller/place.php" method="post" class="form">
            <label for="place-label">Place</label>
            <input type="text" name="place" placeholder="Place" class="input">
            <select name="place-type" class="input">
                <option selected disabled>Choisissez un type de place</option>
                <option value="standard">Standard</option>
                <option value="handicapped">Handicapée</option>
            </select>
        <button type="button" class="button-primary">Ajouter</button>
    </form>
</div>