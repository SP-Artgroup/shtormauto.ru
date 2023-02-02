<div class="custom-input-number">
    <button
        class="cin-btn cin-btn-1 cin-btn-md cin-decrement"
        type="button"
        id="<?= $itemIds['QUANTITY_DOWN_ID'] ?>"
    >
    -
    </button>

    <input
        class="cin-input basket-quantity"
        type="number"
        step="1"
        value="1"
        min="0"
        max="10"
        id="<?= $itemIds['QUANTITY_ID'] ?>"
    >

    <button
        class="cin-btn cin-btn-1 cin-btn-md cin-increment"
        type="button"
        id="<?= $itemIds['QUANTITY_UP_ID'] ?>"
    >
    +
    </button>
</div>