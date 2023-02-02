<?php

function showField($field)
{
    echo '<' . $field['tag'];

    foreach ($field['attrs'] as $name => $value) {
        echo " $name=\"$value\"";
    }

    echo '>';

    if (isset($field['label'])) {

        $label = $field['label'];
        $text  = $label['text'] ?? '';

        echo '<label for="' . $field['attrs']['name'] . '"';

        if (isset($label['attrs'])) {

            foreach ($label['attrs'] as $name => $value) {
                echo " $name=\"$value\"";
            }
        }

        echo '>' . $text . '</label>';
    }
}
